<?php

class BancosModel
{

    public function getBancosList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM banco WHERE HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll();
    }

    public function getBanco($idBanco){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM banco WHERE ID_BANCO=$idBanco AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

    public function editBanco($idBanco, $nombre){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE banco set NOMBRE_BANCO =:NOMBRE_BANCO WHERE ID_BANCO=:ID_BANCO");

        if ($sql->execute(array('NOMBRE_BANCO' => trim($nombre), 'ID_BANCO' => $idBanco ))) {
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

    public function deleteBanco($idBanco){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE banco set HABILITADO =:HABILITADO WHERE ID_BANCO=:ID_BANCO");

        if ($sql->execute(array('HABILITADO' => 0, 'ID_BANCO' => $idBanco ))) {
            $status  = "success";
            $message = "El banco ha sido eliminado.";
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

    public function newBanco($nombre){

        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("INSERT INTO `banco`(`NOMBRE_BANCO`, `HABILITADO`) VALUES (:NOMBRE_BANCO, '1')");
        $sql->execute(array('NOMBRE_BANCO' => trim($nombre)));
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