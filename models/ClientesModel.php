<?php

class ClientesModel
{

    public function getClientesList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM cliente WHERE HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll();
    }

    public function getCliente($idCliente){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM cliente WHERE ID_CLIENTE=$idCliente AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll()[0];
    }

    public function editCliente($idCliente, $nombre, $rut,  $direccion, $comuna, $idRegion, $codigoPostal, $telefono, $movil, $correo, $sitioWeb,
                                $formaPago, $banco, $cuentaBancaria){

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
        $formaPago = $formaPago != '' ?  $formaPago  : null;

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE cliente set NOMBRE =:NOMBRE, RUT =:RUT, DIRECCION =:DIRECCION, COMUNA =:COMUNA, ID_REGION =:ID_REGION, CODIGO_POSTAL =:CODIGO_POSTAL, TELEFONO =:TELEFONO, MOVIL =:MOVIL, CORREO_ELECTRONICO =:CORREO_ELECTRONICO, SITIO_WEB =:SITIO_WEB, FORMA_PAGO =:FORMA_PAGO, ID_BANCO =:ID_BANCO, CUENTA_BANCARIA =:CUENTA_BANCARIA WHERE ID_CLIENTE=:ID_CLIENTE");

        if ($sql->execute(array('NOMBRE' => trim($nombre), 'RUT' => trim($rut), 'DIRECCION' => trim($direccion), 'COMUNA' => trim($comuna), 'ID_REGION' => $idRegion,
            'CODIGO_POSTAL' => $codigoPostal, 'TELEFONO' => trim($telefono), 'MOVIL' => trim($movil), 'CORREO_ELECTRONICO' => trim($correo), 'SITIO_WEB' => trim($sitioWeb),
            'FORMA_PAGO' => $formaPago, 'ID_BANCO' => $banco, 'CUENTA_BANCARIA' => trim($cuentaBancaria), 'ID_CLIENTE' => $idCliente))) {
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

    public function deleteCliente($idCliente){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("UPDATE cliente set HABILITADO =:HABILITADO WHERE ID_CLIENTE=:ID_CLIENTE");

        if ($sql->execute(array('HABILITADO' => 0, 'ID_CLIENTE' => $idCliente ))) {
            $status  = "success";
            $message = "El cliente ha sido eliminado.";
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

    public function newCliente($nombre, $rut,  $direccion, $comuna, $idRegion, $codigoPostal, $telefono, $movil, $correo, $sitioWeb,
                               $formaPago, $banco, $cuentaBancaria){

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
        $formaPago = $formaPago != '' ?  $formaPago  : null;

        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("INSERT INTO `cliente`(`NOMBRE`, `RUT`, `DIRECCION`, `COMUNA`, `ID_REGION`, `CODIGO_POSTAL`, `TELEFONO`, `MOVIL`, `CORREO_ELECTRONICO`, `SITIO_WEB`, `FORMA_PAGO`, `ID_BANCO`, `CUENTA_BANCARIA`, `HABILITADO`)
              VALUES (:NOMBRE, :RUT, :DIRECCION, :COMUNA, :ID_REGION, :CODIGO_POSTAL, :TELEFONO, :MOVIL, :CORREO_ELECTRONICO, :SITIO_WEB, :FORMA_PAGO, :ID_BANCO, :CUENTA_BANCARIA, '1')");
        $sql->execute(array('NOMBRE' => trim($nombre), 'RUT' => trim($rut), 'DIRECCION' => trim($direccion), 'COMUNA' => trim($comuna), 'ID_REGION' => $idRegion, 'CODIGO_POSTAL' => $codigoPostal,
            'TELEFONO' => trim($telefono), 'MOVIL' => trim($movil), 'CORREO_ELECTRONICO' => trim($correo), 'SITIO_WEB' => trim($sitioWeb), 'FORMA_PAGO' => $formaPago, 'ID_BANCO' => $banco, 'CUENTA_BANCARIA' => trim($cuentaBancaria) ));
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