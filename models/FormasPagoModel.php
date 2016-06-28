<?php

class FormasPagoModel
{

    public function getFormasPagoList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM formapago WHERE HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll();
    }

    public function getFormaPago($idFormaPago){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM formapago WHERE ID_FORMAPAGO=$idFormaPago AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

    public function editFormaPago($idFormaPago, $nombre){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE formapago set NOMBRE_FORMAPAGO =:NOMBRE_FORMAPAGO WHERE ID_FORMAPAGO=:ID_FORMAPAGO");

        if ($sql->execute(array('NOMBRE_FORMAPAGO' => trim($nombre), 'ID_FORMAPAGO' => $idFormaPago ))) {
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

    public function deleteFormaPago($idFormaPago){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE formapago set HABILITADO =:HABILITADO WHERE ID_FORMAPAGO=:ID_FORMAPAGO");

        if ($sql->execute(array('HABILITADO' => 0, 'ID_FORMAPAGO' => $idFormaPago ))) {
            $status  = "success";
            $message = "La forma de pago ha sido eliminada.";
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

    public function newFormaPago($nombre){

        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("INSERT INTO `formapago`(`NOMBRE_FORMAPAGO`, `HABILITADO`) VALUES (:NOMBRE_FORMAPAGO, '1')");
        $sql->execute(array('NOMBRE_FORMAPAGO' => trim($nombre)));
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