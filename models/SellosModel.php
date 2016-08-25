<?php

class SellosModel
{

    public function getSellosList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM sello WHERE HABILITADO='1' ORDER BY ID_SELLO DESC");
        $sql->execute();

        return $sql->fetchAll();
    }

    public function getSello($idSello){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM sello WHERE ID_SELLO=$idSello AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

    public function editSello($idSello, $sello, $idArticulo, $otro){

        $otro = $otro != '' ?  $otro  : null;

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE sello set SELLO =:SELLO, ID_ARTICULO =:ID_ARTICULO, OTRO =:OTRO WHERE ID_SELLO=:ID_SELLO");

        if ($sql->execute(array('SELLO' => $sello, 'ID_ARTICULO' => $idArticulo, 'OTRO' => trim($otro), 'ID_SELLO' => $idSello))) {
            $status  = "success";
            $message = "Los datos han sido actualizados.";
        }
        else
        {
            $status  = "error";
            $message = "Ha ocurrido un problema con la actualización de los datos.";
        }

        $data = array(
            'status'  => $status,
            'message' => $message
        );

        echo json_encode($data);

        Database::disconnect();
    }

    public function deleteSello($idSello){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE sello set HABILITADO =:HABILITADO WHERE ID_SELLO=:ID_SELLO");

        if ($sql->execute(array('HABILITADO' => 0, 'ID_SELLO' => $idSello ))) {
            $status  = "success";
            $message = "El sello ha sido eliminado.";
        }
        else
        {
            $status  = "error";
            $message = "Ha ocurrido un problema, por favor intenta nuevamente.";
        }

        $data = array(
            'status'  => $status,
            'message' => $message
        );

        echo json_encode($data);

        Database::disconnect();
    }

    public function imprimirSello($idSello){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT IMPRIMIR FROM sello where ID_SELLO=:ID_SELLO");
        $sql->execute(array('ID_SELLO' => $idSello));
        $impresionesSello = $sql->fetchAll()[0];
        $impresionesSello = $impresionesSello[0] + 1;

        $sql = $pdo->prepare("UPDATE sello set IMPRIMIR =:IMPRIMIR WHERE ID_SELLO=:ID_SELLO");

        if ($sql->execute(array('IMPRIMIR' => $impresionesSello, 'ID_SELLO' => $idSello ))) {
            $status  = "success";
            $message = "El boton imprimir ha sido presionado.";
        }
        else
        {
            $status  = "error";
            $message = "Ha ocurrido un problema, por favor intenta nuevamente.";
        }

        $data = array(
            'status'  => $status,
            'message' => $message
        );

        echo json_encode($data);

        Database::disconnect();
    }

    public function createNewCertificado ($idSello, $idCliente, $idAuto, $patente, $chasis, $obs, $folio, $url, $urlprimer){
        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("INSERT INTO `certificado`(`ID_SELLO`, `ID_CLIENTE`, `ID_AUTO`, `PATENTE`, `CHASIS`, `OBSERVACIONES`, `FOLIO`, `URL_CERTIFICADO`, `URL_PRIMER_CERTIFICADO`, `HABILITADO`) VALUES (:ID_SELLO,:ID_CLIENTE,:ID_AUTO,:PATENTE,:CHASIS,:OBSERVACIONES,:FOLIO,:URL_CERTIFICADO,:URL_PRIMER_CERTIFICADO,'1')");
        $sql->execute(array('ID_SELLO' => $idSello, 'ID_CLIENTE' => $idCliente, 'ID_AUTO' => $idAuto, 'PATENTE' => trim($patente), 'CHASIS' => trim($chasis), 'OBSERVACIONES' => $obs, 'FOLIO' => $folio, 'URL_CERTIFICADO' => $url, 'URL_PRIMER_CERTIFICADO' => $urlprimer));
        $id = $pdo->lastInsertId();

        if(!empty($id)) {
            $status  = "success";
            $message = "Creación exitosa.";
        }
        else{
            $status  = "error";
            $message = "Error con la base de datos, por favor intente nuevamente.";
        }

        $data = array(
            'status'  => $status,
            'message' => $message
        );

        echo json_encode($data);

        Database::disconnect();
    }

}