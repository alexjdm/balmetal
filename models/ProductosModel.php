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

    public function getArticulos($idFamilia){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM articulo WHERE ID_FAMILIA = '$idFamilia' AND HABILITADO='1'");
        $sql->execute();

        return $sql->fetchAll();
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
            $message = "El artículo ha sido eliminado.";
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

    public function newArticulo($codigo, $idFamilia, $descripcion, $idImpuesto, $proveedor1, $proveedor2,
                                $descripcionCorta, $ubicacion, $stock, $stockMin, $avisoStockMin, $datosProducto, $fechaAlta, $embalaje,
                                $unidadesPorCaja, $preguntarPrecioTicket, $editarDescripcionTicket, $observaciones, $precioCompra,
                                $precioInterno, $precioVenta, $precioIVA, $codigoBarra, $imagenArticulo){

        $fechaAlta = $fechaAlta != '' ? $fechaAlta : null;
        $stock = $stock != '' ? $stock : null;
        $stockMin = $stockMin != '' ? $stockMin : null;
        $unidadesPorCaja = $unidadesPorCaja != '' ? $unidadesPorCaja : null;
        $precioCompra = $precioCompra != '' ? $precioCompra : null;
        $precioInterno = $precioInterno != '' ? $precioInterno : null;
        $precioVenta = $precioVenta != '' ? $precioVenta : null;
        $precioIVA = $precioIVA != '' ? $precioIVA : null;
        $imagenArticulo = $imagenArticulo != '' ? $imagenArticulo : null;

        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("INSERT INTO `articulo`(`CODIGO_ARTICULO`, `ID_FAMILIA`, `DESCRIPCION`, `ID_IMPUESTO`, `ID_PROVEEDOR1`, `ID_PROVEEDOR2`, `DESCRIPCION_CORTA`, `UBICACION`, `STOCK`, `STOCK_MINIMO`, `AVISO_MINIMO`, `DATOS_ARTICULO`, `FECHA_ALTA`, `EMBALAJE`, `UNIDADES_POR_CAJA`, `PREGUNTAR_PRECIO_TICKET`, `MODIFICAR_DESCRIPCION_TICKET`, `OBSERVACIONES`, `PRECIO_COMPRA`, `PRECIO_INTERNO`, `PRECIO_VENTA`, `PRECIO_IVA`, `IMAGEN_ARTICULO`, `CODIGO_BARRA`, `HABILITADO`)
          VALUES (:CODIGO_ARTICULO, :ID_FAMILIA, :DESCRIPCION, :ID_IMPUESTO, :ID_PROVEEDOR1, :ID_PROVEEDOR2, :DESCRIPCION_CORTA, :UBICACION, :STOCK, :STOCK_MINIMO, :AVISO_MINIMO, :DATOS_ARTICULO, :FECHA_ALTA, :EMBALAJE, :UNIDADES_POR_CAJA, :PREGUNTAR_PRECIO_TICKET, :MODIFICAR_DESCRIPCION_TICKET, :OBSERVACIONES, :PRECIO_COMPRA, :PRECIO_INTERNO, :PRECIO_VENTA, :PRECIO_IVA, :IMAGEN_ARTICULO, :CODIGO_BARRA, '1')");

        $sql->execute(array('CODIGO_ARTICULO' => trim($codigo), 'ID_FAMILIA' => $idFamilia, 'DESCRIPCION' => $descripcion,
            'ID_IMPUESTO' => $idImpuesto, 'ID_PROVEEDOR1' => $proveedor1, 'ID_PROVEEDOR2' => $proveedor2,
            'DESCRIPCION_CORTA' => trim($descripcionCorta), 'UBICACION' => $ubicacion, 'STOCK' => $stock, 'STOCK_MINIMO' => $stockMin,
            'AVISO_MINIMO' => $avisoStockMin, 'DATOS_ARTICULO' => $datosProducto, 'FECHA_ALTA' => $fechaAlta, 'EMBALAJE' => $embalaje,
            'UNIDADES_POR_CAJA' => $unidadesPorCaja, 'PREGUNTAR_PRECIO_TICKET' => $preguntarPrecioTicket, 'MODIFICAR_DESCRIPCION_TICKET' => $editarDescripcionTicket,
            'OBSERVACIONES' => $observaciones,'PRECIO_COMPRA' => $precioCompra, 'PRECIO_INTERNO' => $precioInterno, 'PRECIO_VENTA' => $precioVenta,
            'PRECIO_IVA' => $precioIVA, 'IMAGEN_ARTICULO' => $imagenArticulo, 'CODIGO_BARRA' => $codigoBarra));
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

    public function articuloAsignarSello($idArticulo, $idAuto, $chasis, $patente, $cantidad){

        if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");

        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM articulo where ID_ARTICULO=:ID_ARTICULO");
        $sql->execute(array('ID_ARTICULO' => $idArticulo));
        $articulo = $sql->fetchAll()[0];

        $sql = $pdo->prepare("SELECT COUNT(*) FROM sello where ID_ARTICULO=:ID_ARTICULO");
        $sql->execute(array('ID_ARTICULO' => $idArticulo));
        $cuenta = $sql->fetchColumn();

        if($cuenta > 0)
        {
            $sql = $pdo->prepare("SELECT * FROM sello where ID_ARTICULO=:ID_ARTICULO order by ID_SELLO desc");
            $sql->execute(array('ID_ARTICULO' => $idArticulo));
            $ultimoSello = $sql->fetchAll()[0];
            $cuenta = substr($ultimoSello['SELLO'], 1, strlen($ultimoSello['SELLO'])-2);
        }

        $year = date("y");
        $i = 0;
        $exito = true;
        while($i < $cantidad){
            $sello = substr($year, 1, 1) . ($cuenta+$i+1) . $articulo['CODIGO_ARTICULO'];
            $sql = $pdo->prepare("INSERT INTO `sello`(`SELLO`, `ID_ARTICULO`, `ID_AUTO`, `CHASIS`, `PATENTE`, `HABILITADO`) VALUES (:SELLO, :ID_ARTICULO, :ID_AUTO, :CHASIS, :PATENTE, '1')");
            $sql->execute(array('SELLO' => $sello, 'ID_ARTICULO' => $idArticulo, 'ID_AUTO' => $idAuto, 'CHASIS' => $chasis, 'PATENTE' => $patente));
            $id = $pdo->lastInsertId();

            if(empty($id)) {
                $exito = false;
            }

            $i++;
        }

        if($exito) {
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