<?php
/*Incluimos el fichero de la clase*/
require_once 'connections/db.php';
require_once 'helpers/CommonHelper.php';
require_once 'models/AutosModel.php';
require_once 'models/ClientesModel.php';
require_once 'models/SellosModel.php';
require_once 'models/ProductosModel.php';

class SellosController {

    public $modelA;
    public $modelC;
    public $modelS;
    public $modelP;

    public function __construct()
    {
        $this-> modelA = new AutosModel();
        $this-> modelC = new ClientesModel();
        $this-> modelS = new SellosModel();
        $this-> modelP = new ProductosModel();
    }

    public function sellos(){
        $sellos = $this->modelS->getSellosList();
        $articulos = $this->modelP->getArticulosList();
        $familias = $this->modelP->getFamiliasList();
        $autos = $this->modelA->getAutosList();
        require_once('views/sellos/sellos.php');
    }

    public function selloView() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        $sello = $this->modelS->getSello($idSello);
        require_once('views/sellos/selloView.php');
    }

    public function selloEdit() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        $sello = $this->modelS->getSello($idSello);
        $articulos = $this->modelP->getArticulosList();
        require_once('views/sellos/selloEdit.php');
    }

    //Guardar en BD los datos del usuario
    public function editSello() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        $sello = isset($_GET['sello']) ? $_GET['sello'] : null;
        $idArticulo = isset($_GET['idArticulo']) ? $_GET['idArticulo'] : null;
        $otro = isset($_GET['otro']) ? $_GET['otro'] : null;

        return $this->modelP->editSello($idSello, $sello, $idArticulo, $otro);
    }

    public function deleteSello() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        return $this->modelP->deleteSello($idSello);
    }

    public function imprimirSello() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        return $this->modelS->imprimirSello($idSello);
    }

    public function newSello() {
        $familias = $this->modelP->getFamiliasList();
        $articulos = $this->modelP->getArticulosList();
        $autos = $this->modelA->getAutosList();

        $articulosJson = json_encode($articulos);

        require_once('views/sellos/newSello.php');
    }

    public function createSello() {
        $idArticulo = isset($_GET['idArticulo']) ? $_GET['idArticulo'] : null;
        $idAuto = isset($_GET['idAuto']) ? $_GET['idAuto'] : null;
        $chasis = isset($_GET['chasis']) ? $_GET['chasis'] : null;
        $patente = isset($_GET['patente']) ? $_GET['patente'] : null;
        $cantidad = isset($_GET['cantidad']) ? $_GET['cantidad'] : null;

        return $this->modelP->articuloAsignarSello($idArticulo, $idAuto, $chasis, $patente, $cantidad);
    }

    public function newCertificado() {
        $idSello = isset($_GET['idSello']) ? $_GET['idSello'] : null;
        $familias = $this->modelP->getFamiliasList();
        $articulos = $this->modelP->getArticulosList();
        $autos = $this->modelA->getAutosList();
        $clientes = $this->modelC->getClientesList();

        require_once('views/sellos/newCertificado.php');
    }

    public function error() {
        require_once('views/error/error.php');
    }

}
?>