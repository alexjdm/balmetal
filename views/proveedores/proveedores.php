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
        Proveedores
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Proveedores</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div id="messageProveedor"></div>

    <div class="row">

        <div class="col-md-12">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Proveedores</h3>
                    <button class="btn btn-primary" id="newProveedorBtn" style="float:right;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo</button>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <table id="tablaProveedores" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Rut</th>
                            <th>Teléfono</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $n = 1; ?>
                        <?php foreach ($proveedores as $proveedor): ?>
                            <tr data-id="<?php echo $proveedor['ID_PROVEEDOR'] ?>">
                                <th><?php echo $n ?></th>
                                <td><?php echo $proveedor['NOMBRE'] ?></td>
                                <td><?php echo $proveedor['RUT'] ?></td>
                                <td><?php echo $proveedor['TELEFONO'] ?></td>
                                <td>
                                    <button data-original-title="View Row" class="btn btn-xs btn-default viewProveedor">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    &nbsp
                                    <button data-original-title="Edit Row" class="btn btn-xs btn-default editProveedor">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    &nbsp
                                    <button data-original-title="Delete" class="btn btn-xs btn-default deleteProveedor">
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
                            <th>Nombre</th>
                            <th>NIF/CIF</th>
                            <th>Teléfono</th>
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
        var table = $("#tablaProveedores").dataTable();

        $("#tablaProveedores").on("click", ".viewProveedor", (function() {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Proveedores&action=proveedorView',
                'GET',
                { idProveedor: id },
                defaultMessage);
            return false;
        }));

        $("#tablaProveedores").on("click", ".editProveedor", (function() {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Proveedores&action=proveedorEdit',
                'GET',
                { idProveedor: id },
                defaultMessage);
            return false;
        }));

        $("#tablaProveedores").on("click", ".deleteProveedor" ,(function () {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            showConfirmation($('#modalConfirmacion'),
                {
                    title: '¿ Está seguro ?',
                    message: 'Esta acción eliminará el proveedor. ¿Está seguro? ',
                    ok: 'Eliminar',
                    cancel: 'Cancelar'
                }, function () {

                    $.ajax({
                        type: 'GET',
                        url: 'ajax.php?controller=Proveedores&action=deleteProveedor',
                        data: { idProveedor: id },
                        beforeSend: function() {
                        },
                        success: function(returnedData) {
                            //var returnedData = JSON.parse(data); console.debug(returnedData);
                            if (returnedData.status == 'error') {
                                $('#messageProveedor').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                            } else {
                                $('#messageProveedor').html('<div class="alert alert-success" role="alert">' + returnedData.message + '</div>');
                                window.location.href = "index.php?controller=Proveedores&action=proveedores";
                            }
                        },
                        error: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            $('#messageProveedor').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                        }
                    });
                });
        }));

        $('#newProveedorBtn').click(function(){
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Proveedores&action=newProveedor',
                'GET',
                { idProveedor: id },
                defaultMessage);
            return false;
        });

    });
</script>