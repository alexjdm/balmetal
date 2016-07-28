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
        Autos
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Autos</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div id="messageAuto"></div>

    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Agregar Auto</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-12" for="marca">Marca</label>
                                <div class="col-sm-12">
                                    <input class="form-control" id="marca" type="text" placeholder="Marca">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12" for="modelo">Modelo</label>
                                <div class="col-sm-12">
                                    <input class="form-control" id="modelo" type="text" placeholder="Modelo">
                                </div>
                            </div>

                            <div id="messageNewAuto" style="margin: 20px;"></div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <a id="cleanDataAutoBtn" class="btn btn-default">Limpiar</a>
                            <a id="newAutoBtn" class="btn btn-primary pull-right" >Agregar</a>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="col-md-8">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Autos</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <table id="tablaAutos" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $n = 1; ?>
                        <?php foreach ($autos as $auto): ?>
                            <tr data-id="<?php echo $auto['ID_AUTO'] ?>">
                                <th><?php echo $n ?></th>
                                <td><?php echo utf8_encode($auto['MARCA_AUTO']) ?></td>
                                <td><?php echo utf8_encode($auto['MODELO_AUTO']) ?></td>
                                <td>
                                    <button data-original-title="Edit Row" class="btn btn-xs btn-default editAuto">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    &nbsp
                                    <button data-original-title="Delete" class="btn btn-xs btn-default deleteAuto">
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
                            <th>Marca</th>
                            <th>Modelo</th>
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
        var table = $("#tablaAutos").dataTable();

        $("#tablaAutos").on("click", ".editAuto", (function() {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Mantenimiento&action=autoEdit',
                'GET',
                { idAuto: id },
                defaultMessage);
            return false;
        }));

        $("#tablaAutos").on("click", ".deleteAuto" ,(function () {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            showConfirmation($('#modalConfirmacion'),
                {
                    title: '¿ Está seguro ?',
                    message: 'Esta acción eliminará el auto. ¿Está seguro? ',
                    ok: 'Eliminar',
                    cancel: 'Cancelar'
                }, function () {

                    $.ajax({
                        type: 'GET',
                        url: 'ajax.php?controller=Mantenimiento&action=deleteAuto',
                        data: { idAuto: id },
                        beforeSend: function() {
                        },
                        success: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            if (returnedData.status == 'error') {
                                $('#messageAuto').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                            } else {
                                $('#messageAuto').html('<div class="alert alert-success" role="alert">' + returnedData.message + '</div>');
                                window.location.href = "index.php?controller=Mantenimiento&action=autos";
                            }
                        },
                        error: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            $('#messageAuto').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                        }
                    });
                });
        }));

        $('#newAutoBtn').click(function(){
            var e = 'ajax.php?controller=Mantenimiento&action=createNewAuto'; console.debug(e);
            var marca = $("#marca").val();
            var modelo = $("#modelo").val();

            if(marca == '' && modelo == '')
            {
                $('#messageNewAuto').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong> Debes llenar todos los campos.</div>');
            }
            else
            {
                $.ajax({
                    type: 'GET',
                    url: e,
                    data: { marca: marca, modelo: modelo },
                    dataType : "json",
                    beforeSend: function () {
                        $('#newAutoBtn').html("Cargando...");
                    },
                    success: function (data) {
                        console.debug("success");
                        console.debug(data);
                        //var returnedData = JSON.parse(data); console.debug(returnedData);
                        if(data.status == "success"){
                            $('#messageNewAuto').html('<div class="alert alert-success" role="alert"><strong>Listo! </strong>' + data.message + '</div>');
                            $('#newAutoBtn').html('Agregar');
                            window.location.href = "index.php?controller=Mantenimiento&action=autos";
                        }
                        else{
                            $('#newAutoBtn').html("Agregar");
                            $('#messageNewAuto').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                        }
                        return false;
                    },
                    error: function (data) {
                        console.debug("error");
                        console.debug(data);
                        //var returnedData = JSON.parse(data); console.debug(returnedData);
                        $('#newAutoBtn').html("Agregar");
                        $('#messageNewAuto').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                        return false;
                    }
                });
            }

            return false;
        });

        $("#cleanDataAutoBtn").click(function() {
            $(this).closest('form').find("input[type=text], textarea").val("");
            return false;
        });

    });
</script>