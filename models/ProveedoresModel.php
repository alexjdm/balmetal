<?php

class ProveedoresModel
{

    public function getProveedoresList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM proveedor WHERE HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll();
    }

    public function getProveedor($idProveedor){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM proveedor WHERE ID_PROVEEDOR=$idProveedor AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

    public function editProveedor($idProveedor, $nombre, $rut, $tipo, $direccion, $idRegion, $comuna, $banco, $cuentaBancaria,
                                 $codigoPostal, $telefono, $movil, $correo, $sitioWeb){

        $tipo = $tipo != '' ? $tipo : null;
        $direccion = $direccion != '' ?  $direccion  : null;
        $idRegion = $idRegion != '' ?  $idRegion  : null;
        $comuna = $comuna != '' ?  $comuna  : null;
        $banco = $banco != '' ?  $banco  : null;
        $cuentaBancaria = $cuentaBancaria != '' ?  $cuentaBancaria  : null;
        $codigoPostal = $codigoPostal != '' ?  $codigoPostal  : null;
        $telefono = $telefono != '' ? $telefono : null;
        $movil = $movil != '' ?  $movil  : null;
        $correo = $correo != '' ?  $correo  : null;
        $sitioWeb = $sitioWeb != '' ?  $sitioWeb  : null;

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE proveedor set NOMBRE =:NOMBRE, RUT =:RUT, TIPO_PROVEEDOR =:TIPO_PROVEEDOR, DIRECCION =:DIRECCION, COMUNA =:COMUNA, ID_REGION =:ID_REGION, ID_BANCO =:ID_BANCO, CUENTA_BANCARIA =:CUENTA_BANCARIA, CODIGO_POSTAL =:CODIGO_POSTAL, TELEFONO =:TELEFONO, MOVIL =:MOVIL, CORREO_ELECTRONICO =:CORREO_ELECTRONICO, SITIO_WEB =:SITIO_WEB WHERE ID_PROVEEDOR=:ID_PROVEEDOR");

        if ($sql->execute(array('NOMBRE' => trim($nombre), 'RUT' => trim($rut), 'TIPO_PROVEEDOR' => trim($tipo), 'DIRECCION' => trim($direccion), 'COMUNA' => trim($comuna), 'ID_REGION' => $idRegion,
            'ID_BANCO' => $banco, 'CUENTA_BANCARIA' => trim($cuentaBancaria), 'CODIGO_POSTAL' => $codigoPostal, 'TELEFONO' => trim($telefono), 'MOVIL' => trim($movil), 'CORREO_ELECTRONICO' => trim($correo), 'SITIO_WEB' => trim($sitioWeb),
            'ID_PROVEEDOR' => $idProveedor))) {
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

    public function deleteProveedor($idProveedor){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE proveedor set HABILITADO =:HABILITADO WHERE ID_PROVEEDOR=:ID_PROVEEDOR");

        if ($sql->execute(array('HABILITADO' => 0, 'ID_PROVEEDOR' => $idProveedor ))) {
            $status  = "success";
            $message = "El proveedor ha sido eliminado.";
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

    public function newProveedor($nombre, $rut, $tipo, $direccion, $idRegion, $comuna, $banco, $cuentaBancaria,
                                 $codigoPostal, $telefono, $movil, $correo, $sitioWeb){

        $tipo = $tipo != '' ? $tipo : null;
        $direccion = $direccion != '' ?  $direccion  : null;
        $idRegion = $idRegion != '' ?  $idRegion  : null;
        $comuna = $comuna != '' ?  $comuna  : null;
        $banco = $banco != '' ?  $banco  : null;
        $cuentaBancaria = $cuentaBancaria != '' ?  $cuentaBancaria  : null;
        $codigoPostal = $codigoPostal != '' ?  $codigoPostal  : null;
        $telefono = $telefono != '' ? $telefono : null;
        $movil = $movil != '' ?  $movil  : null;
        $correo = $correo != '' ?  $correo  : null;
        $sitioWeb = $sitioWeb != '' ?  $sitioWeb  : null;


        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("INSERT INTO `proveedor`(`NOMBRE`, `RUT`, `TIPO_PROVEEDOR`, `DIRECCION`, `COMUNA`, `ID_REGION`, `ID_BANCO`, `CUENTA_BANCARIA`, `CODIGO_POSTAL`, `TELEFONO`, `MOVIL`, `CORREO_ELECTRONICO`, `SITIO_WEB`, `HABILITADO`)
              VALUES (:NOMBRE, :RUT, :TIPO_PROVEEDOR, :DIRECCION, :COMUNA, :ID_REGION, :ID_BANCO, :CUENTA_BANCARIA, :CODIGO_POSTAL, :TELEFONO, :MOVIL, :CORREO_ELECTRONICO, :SITIO_WEB, '1')");
        $sql->execute(array('NOMBRE' => trim($nombre), 'RUT' => trim($rut), 'TIPO_PROVEEDOR' => trim($tipo), 'DIRECCION' => trim($direccion), 'COMUNA' => trim($comuna), 'ID_REGION' => $idRegion,
            'ID_BANCO' => $banco, 'CUENTA_BANCARIA' => trim($cuentaBancaria), 'CODIGO_POSTAL' => $codigoPostal, 'TELEFONO' => trim($telefono), 'MOVIL' => trim($movil), 'CORREO_ELECTRONICO' => trim($correo), 'SITIO_WEB' => trim($sitioWeb) ));
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