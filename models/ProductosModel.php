<?php

class ProductosModel
{

    //************** FAMILIA *********************
    public function getFamiliasList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM familia WHERE HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll();
    }

    public function getFamilia($idFamilia){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM familia WHERE ID_FAMILIA=$idFamilia AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

    public function editFamilia($idFamilia, $codigo, $nombre){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE familia set NOMBRE_FAMILIA =:NOMBRE_FAMILIA, CODIGO_FAMILIA =:CODIGO_FAMILIA WHERE ID_FAMILIA=:ID_FAMILIA");

        if ($sql->execute(array('NOMBRE_FAMILIA' => trim($nombre), 'CODIGO_FAMILIA' => trim($codigo), 'ID_FAMILIA' => $idFamilia ))) {
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

    public function deleteFamilia($idFamilia){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE familia set HABILITADO =:HABILITADO WHERE ID_FAMILIA=:ID_FAMILIA");

        if ($sql->execute(array('HABILITADO' => 0, 'ID_FAMILIA' => $idFamilia ))) {
            $status  = "success";
            $message = "La familia ha sido eliminada.";
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

    public function newFamilia($codigo, $nombre){

        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("INSERT INTO `familia`(`NOMBRE_FAMILIA`, `CODIGO_FAMILIA`, `HABILITADO`) VALUES (:NOMBRE_FAMILIA, :CODIGO_FAMILIA, '1')");
        $sql->execute(array('NOMBRE_FAMILIA' => trim($nombre), 'CODIGO_FAMILIA' => trim($codigo)));
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


    //************** ARIICULO *********************
    public function getArticulosList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM articulo WHERE HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll();
    }

    public function getArticulo($idArticulo){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM articulo WHERE ID_ARTICULO=$idArticulo AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

    public function editArticulo($idArticulo, $codigo, $nombre){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE articulo set NOMBRE_FAMILIA =:NOMBRE_FAMILIA, CODIGO_FAMILIA =:CODIGO_FAMILIA WHERE ID_ARTICULO=:ID_ARTICULO");

        if ($sql->execute(array('NOMBRE_FAMILIA' => trim($nombre), 'CODIGO_FAMILIA' => trim($codigo), 'ID_ARTICULO' => $idArticulo ))) {
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

    public function deleteArticulo($idArticulo){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE articulo set HABILITADO =:HABILITADO WHERE ID_ARTICULO=:ID_ARTICULO");

        if ($sql->execute(array('HABILITADO' => 0, 'ID_ARTICULO' => $idArticulo ))) {
            $status  = "success";
            $message = "La articulo ha sido eliminada.";
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

    public function newArticulo($codigo, $nombre){

        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("INSERT INTO `articulo`(`NOMBRE_FAMILIA`, `CODIGO_FAMILIA`, `HABILITADO`) VALUES (:NOMBRE_FAMILIA, :CODIGO_FAMILIA, '1')");
        $sql->execute(array('NOMBRE_FAMILIA' => trim($nombre), 'CODIGO_FAMILIA' => trim($codigo)));
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

    //************** PRODUCTO *********************

    public function getProductosList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM empresas WHERE HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll();
    }

    public function getProducto($idProducto){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM empresas WHERE ID_EMPRESA=$idProducto AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

    public function editProducto($idProducto, $nombre, $sitio_web, $correo, $direccion){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE empresas set NOMBRE_EMPRESA =:NOMBRE, SITIO_WEB =:SITIO_WEB, CORREO_ELECTRONICO =:CORREO_ELECTRONICO, DIRECCION =:DIRECCION WHERE ID_EMPRESA=:ID_EMPRESA");

        if ($sql->execute(array('NOMBRE' => trim($nombre), 'SITIO_WEB' => trim($sitio_web), 'CORREO_ELECTRONICO' => trim($correo), 'DIRECCION' => $direccion, 'ID_EMPRESA' => $idProducto ))) {
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

    public function deleteProducto($idProducto){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE empresas set HABILITADO =:HABILITADO WHERE ID_EMPRESA=:ID_EMPRESA");

        if ($sql->execute(array('HABILITADO' => 0, 'ID_EMPRESA' => $idProducto ))) {
            $status  = "success";
            $message = "La empresa ha sido eliminada.";
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

    public function newProducto($nombre, $sitio_web, $correo, $direccion){

        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("INSERT INTO `empresas`(`NOMBRE_EMPRESA`, `SITIO_WEB`, `CORREO_ELECTRONICO`, `DIRECCION`, `HABILITADO`) VALUES (:nombre,:sitio_web,:correo,:direccion,'1')");
        $sql->execute(array('nombre' => trim($nombre), 'sitio_web' => trim($sitio_web), 'correo' => trim($correo), 'direccion' => $direccion));
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