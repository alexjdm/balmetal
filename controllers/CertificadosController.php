<?php
/*Incluimos el fichero de la clase*/
require_once 'connections/db.php';
require_once 'helpers/CommonHelper.php';
require_once 'models/CertificadosModel.php';
require_once 'models/ClientesModel.php';
require_once 'models/SellosModel.php';
require_once 'models/AutosModel.php';

class CertificadosController {

    public $modelCer;
    public $modelA;
    public $modelC;
    public $modelS;

    public function __construct()
    {
        $this-> modelCer = new CertificadosModel();
        $this-> modelA = new AutosModel();
        $this-> modelC = new ClientesModel();
        $this-> modelS = new SellosModel();
    }

    public function certificados(){
        $certificados = $this->modelCer->getCertificadosList();
        $clientes = $this->modelC->getClientesList();
        $sellos = $this->modelS->getSellosList();
        $autos = $this->modelA->getAutosList();
        require_once('views/certificados/certificados.php');
    }

    public function deleteCertificado() {
        $idCertificado = isset($_GET['idCertificado']) ? $_GET['idCertificado'] : null;
        return $this->modelCer->deleteCertificado($idCertificado);
    }

    public function imprimirCertificado() {
        $idCertificado = isset($_GET['idCertificado']) ? $_GET['idCertificado'] : null;
        return $this->modelCer->imprimirCertificado($idCertificado);
    }

    public function error() {
        require_once('views/error/error.php');
    }

}
?>