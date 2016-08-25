<?php

/**
 * Created by PhpStorm.
 * User: alexj
 * Date: 12-04-2016
 * Time: 20:03
 */
class CertificadosModel
{
    public function getCertificadosList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM certificado WHERE HABILITADO='1' ORDER BY ID_CERTIFICADO DESC");
        $sql->execute();

        return $sql->fetchAll();
    }

    public function getCertificado($idCertificado){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM certificado WHERE ID_CERTIFICADO=$idCertificado AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

    public function deleteCertificado($idCertificado){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE certificado set HABILITADO =:HABILITADO WHERE ID_CERTIFICADO=:ID_CERTIFICADO");

        if ($sql->execute(array('HABILITADO' => 0, 'ID_CERTIFICADO' => $idCertificado ))) {
            $status  = "success";
            $message = "El certificado ha sido eliminado.";
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

    public function imprimirCertificado($idCertificado){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT IMPRIMIR FROM certificado where ID_CERTIFICADO=:ID_CERTIFICADO");
        $sql->execute(array('ID_CERTIFICADO' => $idCertificado));
        $impresionesCertificado = $sql->fetchAll()[0];
        $impresionesCertificado = $impresionesCertificado[0] + 1;

        $sql = $pdo->prepare("UPDATE certificado set IMPRIMIR =:IMPRIMIR WHERE ID_CERTIFICADO=:ID_CERTIFICADO");

        if ($sql->execute(array('IMPRIMIR' => $impresionesCertificado, 'ID_CERTIFICADO' => $idCertificado ))) {
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

    public function getLastFolio(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT FOLIO FROM certificado ORDER BY FOLIO DESC");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

}