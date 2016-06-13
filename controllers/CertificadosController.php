<?php
/*Incluimos el fichero de la clase*/
require_once 'connections/db.php';
require_once 'helpers/CommonHelper.php';
require "lib/phpmailer/class.phpmailer.php";

class CertificadosController {

    public $model;

    public function asignacionBarras(){
        require_once('views/certificados/asignacionBarras.php');
    }

    public function sellosBarras(){
        require_once('views/certificados/sellosBarras.php');
    }

    public function error() {
        require_once('views/error/error.php');
    }

}
?>