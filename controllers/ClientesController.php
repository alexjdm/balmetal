<?php
/*Incluimos el fichero de la clase*/
require_once 'connections/db.php';
require_once 'helpers/CommonHelper.php';
require_once 'models/ClientesModel.php';
require_once 'models/BancosModel.php';
require_once 'models/RegionesModel.php';

class ClientesController {

    public $modelP;
    public $modelB;
    public $modelR;

    public function __construct()
    {
        $this-> modelP = new ClientesModel();
        $this-> modelB = new BancosModel();
        $this-> modelR = new RegionesModel();
    }

    public function clientes(){
        $clientes = $this->modelP->getClientesList();
        require_once('views/clientes/clientes.php');
    }

    public function newCliente() {
        $bancos = $this->modelB->getBancosList();
        $regiones = $this->modelR->getRegionesList();
        require_once('views/clientes/newCliente.php');
    }

    public function createNewCliente() {
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;
        $rut = isset($_GET['rut']) ? $_GET['rut'] : null;
        $direccion = isset($_GET['direccion']) ? $_GET['direccion'] : null;
        $comuna = isset($_GET['comuna']) ? $_GET['comuna'] : null;
        $idRegion = isset($_GET['region']) ? $_GET['region'] : null;
        $codigoPostal = isset($_GET['codigoPostal']) ? $_GET['codigoPostal'] : null;
        $telefono = isset($_GET['telefono']) ? $_GET['telefono'] : null;
        $movil = isset($_GET['movil']) ? $_GET['movil'] : null;
        $correo = isset($_GET['correo']) ? $_GET['correo'] : null;
        $sitioWeb = isset($_GET['sitioWeb']) ? $_GET['sitioWeb'] : null;
        $formaPago = isset($_GET['formaPago']) ? $_GET['formaPago'] : null;
        $banco = isset($_GET['banco']) ? $_GET['banco'] : null;
        $cuentaBancaria = isset($_GET['cuentaBancaria']) ? $_GET['cuentaBancaria'] : null;

        return $this->modelP->newCliente($nombre, $rut,  $direccion, $comuna, $idRegion, $codigoPostal, $telefono, $movil,
            $correo, $sitioWeb, $formaPago, $banco, $cuentaBancaria);
    }

    public function clienteView() {
        $idCliente = isset($_GET['idCliente']) ? $_GET['idCliente'] : null;
        $cliente = $this->modelP->getCliente($idCliente);
        $bancos = $this->modelB->getBancosList();
        $regiones = $this->modelR->getRegionesList();
        require_once('views/clientes/clienteView.php');
    }

    public function clienteEdit() {
        $idCliente = isset($_GET['idCliente']) ? $_GET['idCliente'] : null;
        $cliente = $this->modelP->getCliente($idCliente);
        $bancos = $this->modelB->getBancosList();
        $regiones = $this->modelR->getRegionesList();
        require_once('views/clientes/clienteEdit.php');
    }

    //Guardar en BD los datos del usuario
    public function editCliente() {
        $idCliente = isset($_GET['idCliente']) ? $_GET['idCliente'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;
        $rut = isset($_GET['rut']) ? $_GET['rut'] : null;
        $direccion = isset($_GET['direccion']) ? $_GET['direccion'] : null;
        $comuna = isset($_GET['comuna']) ? $_GET['comuna'] : null;
        $idRegion = isset($_GET['region']) ? $_GET['region'] : null;
        $codigoPostal = isset($_GET['codigoPostal']) ? $_GET['codigoPostal'] : null;
        $telefono = isset($_GET['telefono']) ? $_GET['telefono'] : null;
        $movil = isset($_GET['movil']) ? $_GET['movil'] : null;
        $correo = isset($_GET['correo']) ? $_GET['correo'] : null;
        $sitioWeb = isset($_GET['sitioWeb']) ? $_GET['sitioWeb'] : null;
        $formaPago = isset($_GET['formaPago']) ? $_GET['formaPago'] : null;
        $banco = isset($_GET['banco']) ? $_GET['banco'] : null;
        $cuentaBancaria = isset($_GET['cuentaBancaria']) ? $_GET['cuentaBancaria'] : null;

        return $this->modelP->editCliente($idCliente, $nombre, $rut,  $direccion, $comuna, $idRegion, $codigoPostal, $telefono, $movil,
            $correo, $sitioWeb, $formaPago, $banco, $cuentaBancaria);
    }

    public function deleteCliente() {
        $idCliente = isset($_GET['idCliente']) ? $_GET['idCliente'] : null;

        return $this->modelP->deleteCliente($idCliente);
    }

    public function error() {
        require_once('views/error/error.php');
    }

}
?>