<?php

/**
 * Created by PhpStorm.
 * User: alexj
 * Date: 12-04-2016
 * Time: 20:03
 */
class ProveedoresModel
{
    public function getProveedoresList(){
        $bd = DataBase::getInstance();
        /*Creamos una query sencilla*/
        $sql = "SELECT * FROM PROVEEDORES WHERE HABILITADO='1'";
        $resultado = $bd->ejecutar($sql);
        $fila = $bd->obtener_fila($resultado, 0);
    }
}