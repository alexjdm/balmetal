<?php

class AutosModel
{

    public function getAutosList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM auto WHERE HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll();
    }

    public function getAuto($idAuto){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM auto WHERE ID_AUTO=$idAuto AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

    public function editAuto($idAuto, $marca, $modelo){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE auto set MARCA_AUTO =:MARCA_AUTO, MODELO_AUTO =:MODELO_AUTO WHERE ID_AUTO=:ID_AUTO");

        if ($sql->execute(array('MARCA_AUTO' => trim($marca), 'MODELO_AUTO' => trim($modelo), 'ID_AUTO' => $idAuto ))) {
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

    public function deleteAuto($idAuto){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE auto set HABILITADO =:HABILITADO WHERE ID_AUTO=:ID_AUTO");

        if ($sql->execute(array('HABILITADO' => 0, 'ID_AUTO' => $idAuto ))) {
            $status  = "success";
            $message = "El auto ha sido eliminado.";
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

    public function newAuto($marca, $modelo){

        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("INSERT INTO `auto`(`MARCA_AUTO`, `MODELO_AUTO`, `HABILITADO`) VALUES (:MARCA_AUTO, :MODELO_AUTO, '1')");
        $sql->execute(array('MARCA_AUTO' => trim($marca), 'MODELO_AUTO' => trim($modelo)));
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