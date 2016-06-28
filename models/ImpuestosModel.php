<?php

class ImpuestosModel
{

    public function getImpuestosList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM impuesto WHERE HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll();
    }

    public function getImpuesto($idImpuesto){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM impuesto WHERE ID_IMPUESTO=$idImpuesto AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

    public function editImpuesto($idImpuesto, $nombre, $valor){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE impuesto set NOMBRE_IMPUESTO =:NOMBRE_IMPUESTO, VALOR_IMPUESTO =:VALOR_IMPUESTO WHERE ID_IMPUESTO=:ID_IMPUESTO");

        if ($sql->execute(array('NOMBRE_IMPUESTO' => trim($nombre), 'VALOR_IMPUESTO' => trim($valor), 'ID_IMPUESTO' => $idImpuesto ))) {
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

    public function deleteImpuesto($idImpuesto){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE impuesto set HABILITADO =:HABILITADO WHERE ID_IMPUESTO=:ID_IMPUESTO");

        if ($sql->execute(array('HABILITADO' => 0, 'ID_IMPUESTO' => $idImpuesto ))) {
            $status  = "success";
            $message = "El impuesto ha sido eliminado.";
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

    public function newImpuesto($nombre, $valor){

        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("INSERT INTO `impuesto`(`NOMBRE_IMPUESTO`, `VALOR_IMPUESTO`, `HABILITADO`) VALUES (:NOMBRE_IMPUESTO, :VALOR_IMPUESTO, '1')");
        $sql->execute(array('NOMBRE_IMPUESTO' => trim($nombre), 'VALOR_IMPUESTO' => trim($valor)));
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