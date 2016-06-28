<?php
/*Incluimos el fichero de la clase*/
require_once 'connections/db.php';
require_once 'helpers/CommonHelper.php';
require_once 'models/ProductosModel.php';
require_once 'models/ImpuestosModel.php';

class ProductosController {

    public $modelP;
    public $modelI;

    public function __construct()
    {
        $this-> modelP = new ProductosModel();
        $this-> modelI = new ImpuestosModel();
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
        require_once('views/productos/articulos.php');
    }

    public function createNewArticulo() {
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelP->newArticulo($codigo, $nombre);
    }

    public function newArticulo() {
        $familias = $this->modelP->getFamiliasList();
        $impuestos = $this->modelI->getImpuestosList();
        require_once('views/productos/newArticulo.php');
    }

    public function articuloEdit() {
        $idArticulo = isset($_GET['idArticulo']) ? $_GET['idArticulo'] : null;
        $familia = $this->modelP->getArticulo($idArticulo);
        require_once('views/productos/familiaEdit.php');
    }

    //Guardar en BD los datos del usuario
    public function editArticulo() {
        $idArticulo = isset($_GET['idArticulo']) ? $_GET['idArticulo'] : null;
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelP->editArticulo($idArticulo, $codigo, $nombre);
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