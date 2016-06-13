<?php
/**
 * Created by PhpStorm.
 * User: alexj
 * Date: 28-03-2016
 * Time: 22:37
 */

    //Inicio de variables de sesión
    if (!isset($_SESSION)) {
        @session_start();
    }
    //Validar si se está ingresando con sesión correctamente
    if (!$_SESSION){
        echo '<script language = javascript>
                alert("Usuario no autenticado, por favor ingrese sus credenciales.")
                self.location = "index.php"
            </script>';
    }
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        BalMetal
        <small>Inicio</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-file-text-o"></i> Certificados</a></li>
        <li class="active">Asignación de Barras</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Your Page Content Here -->
    <p>You successfully landed on the home page. Congrats!</p>

</section><!-- /.content -->
