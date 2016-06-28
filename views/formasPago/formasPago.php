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
        Formas de Pago
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Formas de Pago</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div id="messageFormaPago"></div>

    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Agregar Forma de Pago</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-12" for="nombre">Nombre</label>
                                <div class="col-sm-12">
                                    <input class="form-control" id="nombre" type="text" placeholder="Nombre">
                                </div>
                            </div>

                            <div id="messageNewFormaPago" style="margin: 20px;"></div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <a id="cleanDataFormaPagoBtn" class="btn btn-default">Limpiar</a>
                            <a id="newFormaPagoBtn" class="btn btn-primary pull-right" >Agregar</a>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="col-md-8">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Formas de Pago</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <table id="tablaFormasPago" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $n = 1; ?>
                        <?php foreach ($formasPago as $formaPago): ?>
                            <tr data-id="<?php echo $formaPago['ID_FORMAPAGO'] ?>">
                                <th><?php echo $n ?></th>
                                <td><?php echo utf8_encode($formaPago['NOMBRE_FORMAPAGO']) ?></td>
                                <td>
                                    <button data-original-title="Edit Row" class="btn btn-xs btn-default editFormaPago">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    &nbsp
                                    <button data-original-title="Delete" class="btn btn-xs btn-default deleteFormaPago">
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
        var table = $("#tablaFormasPago").dataTable();

        $("#tablaFormasPago").on("click", ".editFormaPago", (function() {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Mantenimiento&action=formaPagoEdit',
                'GET',
                { idFormaPago: id },
                defaultMessage);
            return false;
        }));

        $("#tablaFormasPago").on("click", ".deleteFormaPago" ,(function () {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            showConfirmation($('#modalConfirmacion'),
                {
                    title: '¿ Está seguro ?',
                    message: 'Esta acción eliminará la forma de pago. ¿Está seguro? ',
                    ok: 'Eliminar',
                    cancel: 'Cancelar'
                }, function () {

                    $.ajax({
                        type: 'GET',
                        url: 'ajax.php?controller=Mantenimiento&action=deleteFormaPago',
                        data: { idFormaPago: id },
                        beforeSend: function() {
                        },
                        success: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            if (returnedData.status == 'error') {
                                $('#messageFormaPago').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                            } else {
                                $('#messageFormaPago').html('<div class="alert alert-success" role="alert">' + returnedData.message + '</div>');
                                window.location.href = "index.php?controller=Mantenimiento&action=formasPago";
                            }
                        },
                        error: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            $('#messageFormaPago').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                        }
                    });
                });
        }));

        $('#newFormaPagoBtn').click(function(){
            var e = 'ajax.php?controller=Mantenimiento&action=createNewFormaPago'; console.debug(e);
            var nombre = $("#nombre").val(); console.debug(nombre);

            if(nombre == '')
            {
                $('#messageNewFormaPago').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong> Debes llenar todos los campos.</div>');
            }
            else
            {
                $.ajax({
                    type: 'GET',
                    url: e,
                    data: { nombre: nombre },
                    dataType : "json",
                    beforeSend: function () {
                        $('#newFormaPagoBtn').html("Cargando...");
                    },
                    success: function (data) {
                        console.debug("success");
                        console.debug(data);
                        //var returnedData = JSON.parse(data); console.debug(returnedData);
                        if(data.status == "success"){
                            $('#messageNewFormaPago').html('<div class="alert alert-success" role="alert"><strong>Listo! </strong>' + data.message + '</div>');
                            $('#newFormaPagoBtn').html('Agregar');
                            window.location.href = "index.php?controller=Mantenimiento&action=formasPago";
                        }
                        else{
                            $('#newFormaPagoBtn').html("Agregar");
                            $('#messageNewFormaPago').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                        }
                        return false;
                    },
                    error: function (data) {
                        console.debug("error");
                        console.debug(data);
                        //var returnedData = JSON.parse(data); console.debug(returnedData);
                        $('#newFormaPagoBtn').html("Agregar");
                        $('#messageNewFormaPago').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                        return false;
                    }
                });
            }

            return false;
        });

        $("#cleanDataFormaPagoBtn").click(function() {
            $(this).closest('form').find("input[type=text], textarea").val("");
            return false;
        });

    });
</script>