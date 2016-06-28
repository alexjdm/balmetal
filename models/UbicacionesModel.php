<?php

class UbicacionesModel
{

    public function getUbicacionesList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM ubicacion WHERE HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll();
    }

    public function getUbicacion($idUbicacion){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM ubicacion WHERE ID_UBICACION=$idUbicacion AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

    public function editUbicacion($idUbicacion, $nombre){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE ubicacion set NOMBRE_UBICACION =:NOMBRE_UBICACION WHERE ID_UBICACION=:ID_UBICACION");

        if ($sql->execute(array('NOMBRE_UBICACION' => trim($nombre), 'ID_UBICACION' => $idUbicacion ))) {
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

    public function deleteUbicacion($idUbicacion){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE ubicacion set HABILITADO =:HABILITADO WHERE ID_UBICACION=:ID_UBICACION");

        if ($sql->execute(array('HABILITADO' => 0, 'ID_UBICACION' => $idUbicacion ))) {
            $status  = "success";
            $message = "El ubicacion ha sido eliminado.";
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

    public function newUbicacion($nombre){

        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("INSERT INTO `ubicacion`(`NOMBRE_UBICACION`, `HABILITADO`) VALUES (:NOMBRE_UBICACION, '1')");
        $sql->execute(array('NOMBRE_UBICACION' => trim($nombre)));
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