<?php
/*Incluimos el fichero de la clase*/
require_once 'connections/db.php';
require_once 'helpers/CommonHelper.php';
require_once 'lib/barcode/barcode.inc.php';
require_once 'lib/fpdf/fpdf.php';
require_once 'lib/fpdf/pdf.php';
//require_once 'lib/dompdf/autoload.inc.php';
require_once 'models/AutosModel.php';
require_once 'models/ProductosModel.php';
require_once 'models/ImpuestosModel.php';
require_once 'models/ProveedoresModel.php';
require_once 'models/UbicacionesModel.php';

// reference the Dompdf namespace
//use Dompdf\Dompdf;

class ProductosController {

    public $modelA;
    public $modelP;
    public $modelI;
    public $modelPr;

    public function __construct()
    {
        $this-> modelA = new AutosModel();
        $this-> modelP = new ProductosModel();
        $this-> modelI = new ImpuestosModel();
        $this-> modelPr = new ProveedoresModel();
        $this-> modelU = new UbicacionesModel();
    }

    //************** FAMILIA *********************
    public function familias(){
        $familias = $this->modelP->getFamiliasList();
        require_once('views/productos/familias.php');
    }

    public function createNewFamilia() {
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelP->newFamilia($codigo, $nombre);
    }

    public function familiaEdit() {
        $idFamilia = isset($_GET['idFamilia']) ? $_GET['idFamilia'] : null;
        $familia = $this->modelP->getFamilia($idFamilia);
        require_once('views/productos/familiaEdit.php');
    }

    //Guardar en BD los datos del usuario
    public function editFamilia() {
        $idFamilia = isset($_GET['idFamilia']) ? $_GET['idFamilia'] : null;
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelP->editFamilia($idFamilia, $codigo, $nombre);
    }

    public function deleteFamilia() {
        $idFamilia = isset($_GET['idFamilia']) ? $_GET['idFamilia'] : null;

        return $this->modelP->deleteFamilia($idFamilia);
    }

    //************** ARTICULOS *********************
    public function articulos(){
        $articulos = $this->modelP->getArticulosList();
        $familias = $this->modelP->getFamiliasList();
        require_once('views/productos/articulos.php');
    }

    public function getArticulos(){
        $idFamilia = isset($_POST['idFamilia']) ? $_POST['idFamilia'] : null;
        $articulos = $this->modelP->getArticulos($idFamilia);

        $asaa = json_encode($articulos);

        return $asaa;
    }

    public function createNewArticulo() {
        $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;
        $idFamilia = isset($_POST['idFamilia']) ? $_POST['idFamilia'] : null;
        $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : null;
        $idImpuesto = isset($_POST['idImpuesto']) ? $_POST['idImpuesto'] : null;
        $proveedor1 = isset($_POST['proveedor1']) ? $_POST['proveedor1'] : null;
        $proveedor2 = isset($_POST['proveedor2']) ? $_POST['proveedor2'] : null;
        $descripcionCorta = isset($_POST['descripcionCorta']) ? $_POST['descripcionCorta'] : null;
        $ubicacion = isset($_POST['ubicacion']) ? $_POST['ubicacion'] : null;
        $stock = isset($_POST['stock']) ? $_POST['stock'] : null;
        $stockMin = isset($_POST['stockMin']) ? $_POST['stockMin'] : null;
        $avisoStockMin = isset($_POST['avisoStockMin']) ? $_POST['avisoStockMin'] : null;
        $datosProducto = isset($_POST['datosProducto']) ? $_POST['datosProducto'] : null;
        $fechaAlta = isset($_POST['fechaAlta']) ? $_POST['fechaAlta'] : null;
        if(isset($_GET['fecha'])){
            list($dia, $mes, $año) = split('[/.-]', $fechaAlta);
            $fechaAlta = $año . "-" . $mes . "-" . $dia;
        }
        $embalaje = isset($_POST['embalaje']) ? $_POST['embalaje'] : null;
        $unidadesPorCaja = isset($_POST['unidadesPorCaja']) ? $_POST['unidadesPorCaja'] : null;
        $preguntarPrecioTicket = isset($_POST['preguntarPrecioTicket']) ? $_POST['preguntarPrecioTicket'] : null;
        $editarDescripcionTicket = isset($_POST['editarDescripcionTicket']) ? $_POST['editarDescripcionTicket'] : null;
        $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : null;
        $precioCompra = isset($_POST['precioCompra']) ? $_POST['precioCompra'] : null;
        $precioInterno = isset($_POST['precioInterno']) ? $_POST['precioInterno'] : null;
        $precioVenta = isset($_POST['precioVenta']) ? $_POST['precioVenta'] : null;
        $precioIVA = isset($_POST['precioIVA']) ? $_POST['precioIVA'] : null;

        $aleatorio = rand(1111111111111111111, 111111111111111111111);
        $codigoBarra = 'upload/barcode/barcode_' . $aleatorio . '_110x20.gif';
        new barCodeGenrator($aleatorio, 1, $codigoBarra, 110, 20, false);
        $codigoBarra = 'upload/barcode/barcode_' . $aleatorio . '.gif';
        $show_codebar = true;
        new barCodeGenrator($aleatorio, 1, $codigoBarra, 110, 65, $show_codebar);

        $imagenArticulo = null;
        if(is_array($_FILES) && count($_FILES)>0) {
            if(is_uploaded_file($_FILES['imagenArticulo']['tmp_name'])) {
                $dirpath = realpath(dirname(getcwd()));
                $sourcePath = $_FILES['imagenArticulo']['tmp_name'];
                $targetPath = "upload/".$_FILES['imagenArticulo']['name'];
                $imagenArticulo = $targetPath;

                if(move_uploaded_file($sourcePath, $dirpath . '/' . $targetPath)) {
                    return $this->modelP->newArticulo($codigo, $idFamilia, $descripcion, $idImpuesto, $proveedor1, $proveedor2,
                        $descripcionCorta, $ubicacion, $stock, $stockMin, $avisoStockMin, $datosProducto, $fechaAlta, $embalaje,
                        $unidadesPorCaja, $preguntarPrecioTicket, $editarDescripcionTicket, $observaciones, $precioCompra,
                        $precioInterno, $precioVenta, $precioIVA, $codigoBarra, $imagenArticulo);
                }
                else {
                    $data = array(
                        'status'  => "error",
                        'message' => "La imagen no pudo ser almacenada, por favor inténtalo nuevamente."
                    );
                    return json_encode($data);
                }
            }
        }
        else {
            return $this->modelP->newArticulo($codigo, $idFamilia, $descripcion, $idImpuesto, $proveedor1, $proveedor2,
                $descripcionCorta, $ubicacion, $stock, $stockMin, $avisoStockMin, $datosProducto, $fechaAlta, $embalaje,
                $unidadesPorCaja, $preguntarPrecioTicket, $editarDescripcionTicket, $observaciones, $precioCompra,
                $precioInterno, $precioVenta, $precioIVA, $codigoBarra, $imagenArticulo);
        }
    }

    public function newArticulo() {
        $familias = $this->modelP->getFamiliasList();
        $impuestos = $this->modelI->getImpuestosList();
        $proveedores = $this->modelPr->getProveedoresList();
        $ubicaciones = $this->modelU->getUbicacionesList();
        require_once('views/productos/newArticulo.php');
    }

    public function articuloEdit() {
        $idArticulo = isset($_GET['idArticulo']) ? $_GET['idArticulo'] : null;
        $articulo = $this->modelP->getArticulo($idArticulo);
        require_once('views/productos/articuloEdit.php');
    }

    //Guardar en BD los datos del usuario
    public function editArticulo() {
        $idArticulo = isset($_GET['idArticulo']) ? $_GET['idArticulo'] : null;
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelP->editArticulo($idArticulo, $codigo, $nombre);
    }

    public function articuloCodigo() {
        $idArticulo = isset($_GET['idArticulo']) ? $_GET['idArticulo'] : null;
        $articulo = $this->modelP->getArticulo($idArticulo);
        require_once('views/productos/articuloCodigo.php');
    }

    public function asignarSelloArticulo() {
        $idArticulo = isset($_GET['idArticulo']) ? $_GET['idArticulo'] : null;
        $articulo = $this->modelP->getArticulo($idArticulo);
        $familias = $this->modelP->getFamiliasList();
        $autos = $this->modelA->getAutosList();
        require_once('views/productos/asignarSelloArticulo.php');
    }

    public function articuloAsignarSello() {
        $idArticulo = isset($_GET['idArticulo']) ? $_GET['idArticulo'] : null;
        $idAuto = isset($_GET['idAuto']) ? $_GET['idAuto'] : null;
        $chasis = isset($_GET['chasis']) ? $_GET['chasis'] : null;
        $patente = isset($_GET['patente']) ? $_GET['patente'] : null;
        $cantidad = isset($_GET['cantidad']) ? $_GET['cantidad'] : null;

        return $this->modelP->articuloAsignarSello($idArticulo, $idAuto, $chasis, $patente, $cantidad);
    }

    public function deleteArticulo() {
        $idArticulo = isset($_GET['idArticulo']) ? $_GET['idArticulo'] : null;

        return $this->modelP->deleteArticulo($idArticulo);
    }

    public function error() {
        require_once('views/error/error.php');
    }

}
?>