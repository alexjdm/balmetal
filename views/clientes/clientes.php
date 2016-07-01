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
        Clientes
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Clientes</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div id="messageCliente"></div>

    <div class="row">

        <div class="col-md-12">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Clientes</h3>
                    <button class="btn btn-primary" id="newClienteBtn" style="float:right;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo</button>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <table id="tablaClientes" class="table table-bordered table-striped">
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
                        <?php foreach ($clientes as $cliente): ?>
                            <tr data-id="<?php echo $cliente['ID_CLIENTE'] ?>">
                                <th><?php echo $n ?></th>
                                <td><?php echo $cliente['NOMBRE'] ?></td>
                                <td><?php echo $cliente['RUT'] ?></td>
                                <td><?php echo $cliente['TELEFONO'] ?></td>
                                <td>
                                    <button data-original-title="View Row" class="btn btn-xs btn-default viewCliente">
                                        <i class="fa fa-search"></i>
                                    </button>
                                    &nbsp
                                    <button data-original-title="Edit Row" class="btn btn-xs btn-default editCliente">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    &nbsp
                                    <button data-original-title="Delete" class="btn btn-xs btn-default deleteCliente">
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
        var table = $("#tablaClientes").dataTable();

        $("#tablaClientes").on("click", ".viewCliente", (function() {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Clientes&action=clienteView',
                'GET',
                { idCliente: id },
                defaultMessage);
            return false;
        }));

        $("#tablaClientes").on("click", ".editCliente", (function() {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Clientes&action=clienteEdit',
                'GET',
                { idCliente: id },
                defaultMessage);
            return false;
        }));

        $("#tablaClientes").on("click", ".deleteCliente" ,(function () {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            showConfirmation($('#modalConfirmacion'),
                {
                    title: '¿ Está seguro ?',
                    message: 'Esta acción eliminará el cliente. ¿Está seguro? ',
                    ok: 'Eliminar',
                    cancel: 'Cancelar'
                }, function () {

                    $.ajax({
                        type: 'GET',
                        url: 'ajax.php?controller=Clientes&action=deleteCliente',
                        data: { idCliente: id },
                        beforeSend: function() {
                        },
                        success: function(returnedData) {
                            //var returnedData = JSON.parse(data); console.debug(returnedData);
                            if (returnedData.status == 'error') {
                                $('#messageCliente').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                            } else {
                                $('#messageCliente').html('<div class="alert alert-success" role="alert">' + returnedData.message + '</div>');
                                window.location.href = "index.php?controller=Clientes&action=clientes";
                            }
                        },
                        error: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            $('#messageCliente').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                        }
                    });
                });
        }));

        $('#newClienteBtn').click(function(){
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Clientes&action=newCliente',
                'GET',
                { idCliente: id },
                defaultMessage);
            return false;
        });

    });
</script>