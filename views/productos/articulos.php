<?php
/**
 * Created by PhpStorm.
 * User: alexj
 * Date: 03-04-2016
 * Time: 23:50
 */

//Inicio de variables de sesión
if (!isset($_SESSION)) {
    @session_start();
}

?>

<style>
    .descripcionTA {
        resize: none;
        height: 100px;
    }
</style>

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Artículos
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Artículos</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div id="messageArticulo"></div>

    <div class="row">

        <div class="col-md-12">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Artículos</h3>
                    <button class="btn btn-primary" id="newArticuloBtn" style="float:right;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo</button>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <table id="tablaArticulos" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Código de Golpe</th>
                            <th>Descripción</th>
                            <th>Familia</th>
                            <th>Código de Producto</th>
                            <th>Precio Venta</th>
                            <th>Stock</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $n = 1; ?>
                        <?php foreach ($articulos as $articulo): ?>
                            <tr data-id="<?php echo $articulo['ID_ARTICULO'] ?>">
                                <th><?php echo $n ?></th>
                                <td><?php echo $articulo['CODIGO_ARTICULO'] ?></td>
                                <td><?php echo $articulo['DESCRIPCION'] ?></td>
                                <td>
                                    <?php
                                        foreach($familias as $familia):
                                            if($familia['ID_FAMILIA'] == $articulo['ID_FAMILIA'])
                                            {
                                                echo $familia['NOMBRE_FAMILIA'];
                                                break;
                                            }
                                        endforeach;
                                    ?>
                                </td>
                                <td><?php echo $articulo['CODIGO_PRODUCTO'] ?></td>
                                <td><?php echo $articulo['PRECIO_VENTA'] ?></td>
                                <td><?php echo $articulo['STOCK'] ?></td>
                                <td>
                                    <button title="Código de Artículo" class="btn btn-xs btn-default codigoArticulo">
                                        <i class="fa fa-barcode" aria-hidden="true"></i>
                                    </button>
                                    &nbsp
                                    <button title="Asignar Sello" class="btn btn-xs btn-default asignarSello">
                                        <i class="fa fa-certificate" aria-hidden="true"></i>
                                    </button>
                                    &nbsp
                                    <button title="Editar Artículo" class="btn btn-xs btn-default editArticulo">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    &nbsp
                                    <button title="Eliminar" class="btn btn-xs btn-default deleteArticulo">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php $n++; ?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>N°</th>
                            <th>Código de Golpe</th>
                            <th>Descripción</th>
                            <th>Familia</th>
                            <th>Código de Producto</th>
                            <th>Precio Venta</th>
                            <th>Stock</th>
                            <th>Opciones</th>
                        </tr>
                        </tfoot>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->


<script>
    $(function() {
        var table = $("#tablaArticulos").dataTable();

        $("#tablaArticulos").on("click", ".codigoArticulo", (function() {
            var id = $(this).closest('tr').data("id");
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Productos&action=articuloCodigo',
                'GET',
                { idArticulo: id },
                defaultMessage);
            return false;
        }));

        $("#tablaArticulos").on("click", ".asignarSello", (function() {
            var id = $(this).closest('tr').data("id");
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Productos&action=asignarSelloArticulo',
                'GET',
                { idArticulo: id },
                defaultMessage);
            return false;
        }));

        $("#tablaArticulos").on("click", ".editArticulo", (function() {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Productos&action=articuloEdit',
                'GET',
                { idArticulo: id },
                defaultMessage);
            return false;
        }));

        $("#tablaArticulos").on("click", ".deleteArticulo" ,(function () {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            showConfirmation($('#modalConfirmacion'),
                {
                    title: '¿ Está seguro ?',
                    message: 'Esta acción eliminará el artículo. ¿Está seguro? ',
                    ok: 'Eliminar',
                    cancel: 'Cancelar'
                }, function () {

                    $.ajax({
                        type: 'GET',
                        url: 'ajax.php?controller=Productos&action=deleteArticulo',
                        data: { idArticulo: id },
                        beforeSend: function() {
                        },
                        success: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            if (returnedData.status == 'error') {
                                $('#messageArticulo').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                            } else {
                                $('#messageArticulo').html('<div class="alert alert-success" role="alert">' + returnedData.message + '</div>');
                                window.location.href = "index.php?controller=Productos&action=articulos";
                            }
                        },
                        error: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            $('#messageArticulo').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                        }
                    });
                });
        }));

        $('#newArticuloBtn').click(function(){
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Productos&action=newArticulo',
                'GET',
                { idArticulo: id },
                defaultMessage);
            return false;
        });

        $('.certificado').click(function(){
            window.open(
                'helpers/blog_pdf/php/pdf/pdf_blanco.php',
                '_blank'
            );
            //window.location.href = "helpers/blog_pdf/php/pdf/pdf_blanco.php";
        });

    });
</script>