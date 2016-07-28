<?php

class SellosModel
{

    public function getSellosList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM sello WHERE HABILITADO='1'");
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

}