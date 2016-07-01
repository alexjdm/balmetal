<?php
/*Incluimos el fichero de la clase*/
require_once 'connections/db.php';
require_once 'helpers/CommonHelper.php';
require_once 'models/ProveedoresModel.php';
require_once 'models/BancosModel.php';
require_once 'models/RegionesModel.php';

class ProveedoresController {

    public $modelP;
    public $modelB;
    public $modelR;

    public function __construct()
    {
        $this-> modelP = new ProveedoresModel();
        $this-> modelB = new BancosModel();
        $this-> modelR = new RegionesModel();
    }

    public function proveedores(){
        $proveedores = $this->modelP->getProveedoresList();
        require_once('views/proveedores/proveedores.php');
    }

    public function newProveedor() {
        $bancos = $this->modelB->getBancosList();
        $regiones = $this->modelR->getRegionesList();
        require_once('views/proveedores/newProveedor.php');
    }

    public function createNewProveedor() {
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;
        $rut = isset($_GET['rut']) ? $_GET['rut'] : null;
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : null;
        $direccion = isset($_GET['direccion']) ? $_GET['direccion'] : null;
        $idRegion = isset($_GET['region']) ? $_GET['region'] : null;
        $comuna = isset($_GET['comuna']) ? $_GET['comuna'] : null;
        $banco = isset($_GET['banco']) ? $_GET['banco'] : null;
        $cuentaBancaria = isset($_GET['cuentaBancaria']) ? $_GET['cuentaBancaria'] : null;
        $codigoPostal = isset($_GET['codigoPostal']) ? $_GET['codigoPostal'] : null;
        $telefono = isset($_GET['telefono']) ? $_GET['telefono'] : null;
        $movil = isset($_GET['movil']) ? $_GET['movil'] : null;
        $correo = isset($_GET['correo']) ? $_GET['correo'] : null;
        $sitioWeb = isset($_GET['sitioWeb']) ? $_GET['sitioWeb'] : null;

        return $this->modelP->newProveedor($nombre, $rut, $tipo, $direccion, $idRegion, $comuna, $banco, $cuentaBancaria,
                    $codigoPostal, $telefono, $movil, $correo, $sitioWeb);
    }

    public function proveedorView() {
        $idProveedor = isset($_GET['idProveedor']) ? $_GET['idProveedor'] : null;
        $proveedor = $this->modelP->getProveedor($idProveedor);
        $bancos = $this->modelB->getBancosList();
        $regiones = $this->modelR->getRegionesList();
        require_once('views/proveedores/proveedorView.php');
    }

    public function proveedorEdit() {
        $idProveedor = isset($_GET['idProveedor']) ? $_GET['idProveedor'] : null;
        $proveedor = $this->modelP->getProveedor($idProveedor);
        $bancos = $this->modelB->getBancosList();
        $regiones = $this->modelR->getRegionesList();
        require_once('views/proveedores/proveedorEdit.php');
    }

    //Guardar en BD los datos del usuario
    public function editProveedor() {
        $idProveedor = isset($_GET['idProveedor']) ? $_GET['idProveedor'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;
        $rut = isset($_GET['rut']) ? $_GET['rut'] : null;
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : null;
        $direccion = isset($_GET['direccion']) ? $_GET['direccion'] : null;
        $idRegion = isset($_GET['region']) ? $_GET['region'] : null;
        $comuna = isset($_GET['comuna']) ? $_GET['comuna'] : null;
        $banco = isset($_GET['banco']) ? $_GET['banco'] : null;
        $cuentaBancaria = isset($_GET['cuentaBancaria']) ? $_GET['cuentaBancaria'] : null;
        $codigoPostal = isset($_GET['codigoPostal']) ? $_GET['codigoPostal'] : null;
        $telefono = isset($_GET['telefono']) ? $_GET['telefono'] : null;
        $movil = isset($_GET['movil']) ? $_GET['movil'] : null;
        $correo = isset($_GET['correo']) ? $_GET['correo'] : null;
        $sitioWeb = isset($_GET['sitioWeb']) ? $_GET['sitioWeb'] : null;

        return $this->modelP->editProveedor($idProveedor, $nombre, $rut, $tipo, $direccion, $idRegion, $comuna, $banco, $cuentaBancaria,
            $codigoPostal, $telefono, $movil, $correo, $sitioWeb);
    }

    public function deleteProveedor() {
        $idProveedor = isset($_GET['idProveedor']) ? $_GET['idProveedor'] : null;

        return $this->modelP->deleteProveedor($idProveedor);
    }

    public function error() {
        require_once('views/error/error.php');
    }

}
?>