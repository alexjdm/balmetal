<?php
/*Incluimos el fichero de la clase*/
require_once 'connections/db.php';
require_once 'helpers/CommonHelper.php';
require_once 'models/AutosModel.php';
require_once 'models/ImpuestosModel.php';
require_once 'models/BancosModel.php';
require_once 'models/UbicacionesModel.php';
require_once 'models/FormasPagoModel.php';

class MantenimientoController {

    public $modelA;
    public $modelI;
    public $modelB;
    public $modelU;
    public $modelFP;

    public function __construct()
    {
        $this-> modelA = new AutosModel();
        $this-> modelI = new ImpuestosModel();
        $this-> modelB = new BancosModel();
        $this-> modelU = new UbicacionesModel();
        $this-> modelFP = new FormasPagoModel();
    }

    //************** IMPUESTOS *********************
    public function impuestos(){
        $impuestos = $this->modelI->getImpuestosList();

        require_once('views/impuestos/impuestos.php');
    }

    public function createNewImpuesto() {
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;
        $valor = isset($_GET['valor']) ? $_GET['valor'] : null;

        return $this->modelI->newImpuesto($nombre, $valor);
    }

    public function impuestoEdit() {
        $idImpuesto = isset($_GET['idImpuesto']) ? $_GET['idImpuesto'] : null;
        $impuesto = $this->modelI->getImpuesto($idImpuesto);

        require_once('views/impuestos/impuestoEdit.php');
    }

    public function editImpuesto() {
        $idImpuesto = isset($_GET['idImpuesto']) ? $_GET['idImpuesto'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;
        $valor = isset($_GET['valor']) ? $_GET['valor'] : null;

        return $this->modelI->editImpuesto($idImpuesto, $nombre, $valor);
    }

    public function deleteImpuesto() {
        $idImpuesto = isset($_GET['idImpuesto']) ? $_GET['idImpuesto'] : null;

        return $this->modelI->deleteImpuesto($idImpuesto);
    }

    //************** BANCOS *********************
    public function bancos(){
        $bancos = $this->modelB->getBancosList();

        require_once('views/bancos/bancos.php');
    }

    public function createNewBanco() {
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelB->newBanco($nombre);
    }

    public function bancoEdit() {
        $idBanco = isset($_GET['idBanco']) ? $_GET['idBanco'] : null;
        $banco = $this->modelB->getBanco($idBanco);

        require_once('views/bancos/bancoEdit.php');
    }

    public function editBanco() {
        $idBanco = isset($_GET['idBanco']) ? $_GET['idBanco'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelB->editBanco($idBanco, $nombre);
    }

    public function deleteBanco() {
        $idBanco = isset($_GET['idBanco']) ? $_GET['idBanco'] : null;

        return $this->modelB->deleteBanco($idBanco);
    }

    //************** UBICACIONES *********************
    public function ubicaciones(){
        $ubicaciones = $this->modelU->getUbicacionesList();

        require_once('views/ubicaciones/ubicaciones.php');
    }

    public function createNewUbicacion() {
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelU->newUbicacion($nombre);
    }

    public function ubicacionEdit() {
        $idUbicacion = isset($_GET['idUbicacion']) ? $_GET['idUbicacion'] : null;
        $ubicacion = $this->modelU->getUbicacion($idUbicacion);

        require_once('views/ubicaciones/ubicacionEdit.php');
    }

    public function editUbicacion() {
        $idUbicacion = isset($_GET['idUbicacion']) ? $_GET['idUbicacion'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelU->editUbicacion($idUbicacion, $nombre);
    }

    public function deleteUbicacion() {
        $idUbicacion = isset($_GET['idUbicacion']) ? $_GET['idUbicacion'] : null;

        return $this->modelU->deleteUbicacion($idUbicacion);
    }

    //************** FORMAS DE PAGO *********************
    public function formasPago(){
        $formasPago = $this->modelFP->getFormasPagoList();

        require_once('views/formasPago/formasPago.php');
    }

    public function createNewFormaPago() {
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelFP->newFormaPago($nombre);
    }

    public function formaPagoEdit() {
        $idFormaPago = isset($_GET['idFormaPago']) ? $_GET['idFormaPago'] : null;
        $formaPago = $this->modelFP->getFormaPago($idFormaPago);

        require_once('views/formasPago/formaPagoEdit.php');
    }

    public function editFormaPago() {
        $idFormaPago = isset($_GET['idFormaPago']) ? $_GET['idFormaPago'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelFP->editFormaPago($idFormaPago, $nombre);
    }

    public function deleteFormaPago() {
        $idFormaPago = isset($_GET['idFormaPago']) ? $_GET['idFormaPago'] : null;

        return $this->modelFP->deleteFormaPago($idFormaPago);
    }


    //************** AUTOS *********************
    public function autos(){
        $autos = $this->modelA->getAutosList();

        require_once('views/autos/autos.php');
    }

    public function createNewAuto() {
        $marca = isset($_GET['marca']) ? $_GET['marca'] : null;
        $modelo = isset($_GET['modelo']) ? $_GET['modelo'] : null;

        return $this->modelA->newAuto($marca, $modelo);
    }

    public function autoEdit() {
        $idAuto = isset($_GET['idAuto']) ? $_GET['idAuto'] : null;
        $auto = $this->modelA->getAuto($idAuto);

        require_once('views/autos/autoEdit.php');
    }

    public function editAuto() {
        $idAuto = isset($_GET['idAuto']) ? $_GET['idAuto'] : null;
        $marca = isset($_GET['marca']) ? $_GET['marca'] : null;
        $modelo = isset($_GET['modelo']) ? $_GET['modelo'] : null;

        return $this->modelA->editAuto($idAuto, $marca, $modelo);
    }

    public function deleteAuto() {
        $idAuto = isset($_GET['idAuto']) ? $_GET['idAuto'] : null;

        return $this->modelA->deleteAuto($idAuto);
    }

    public function error() {
        require_once('views/error/error.php');
    }

}
?>