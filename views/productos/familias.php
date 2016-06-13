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
        Familias
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Familias</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div id="messageFamilia"></div>

    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Agregar Familia</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-12" for="codigo">Código</label>
                                <div class="col-sm-12">
                                    <input class="form-control" id="codigo" type="text" placeholder="Código">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12" for="nombre">Nombre</label>
                                <div class="col-sm-12">
                                    <input class="form-control" id="nombre" type="text" placeholder="Nombre">
                                </div>
                            </div>

                            <div id="messageNewFamilia" style="margin: 20px;"></div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <a id="cleanDataFamiliaBtn" class="btn btn-default">Limpiar</a>
                            <a id="newFamiliaBtn" class="btn btn-info pull-right" >Agregar</a>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="col-md-8">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Familias</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <table id="tablaFamilias" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $n = 1; ?>
                        <?php foreach ($familias as $familia): ?>
                            <tr data-id="<?php echo $familia['ID_FAMILIA'] ?>">
                                <th><?php echo $n ?></th>
                                <td><?php echo $familia['CODIGO_FAMILIA'] ?></td>
                                <td><?php echo $familia['NOMBRE_FAMILIA'] ?></td>
                                <td>
                                    <button data-original-title="Edit Row" class="btn btn-xs btn-default editFamilia">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    &nbsp
                                    <button data-original-title="Delete" class="btn btn-xs btn-default deleteFamilia">
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
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Opciones</th>
                        </tr>
                        </tfoot>
                    </table>
                    <button class="btn btn-primary" id="save" style="float:right;">Guardar</button>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

</section><!-- /.content -->


<script>
    $(function() {
        var table = $("#tablaFamilias").dataTable();

        $("#tablaFamilias").on("click", ".editFamilia", (function() {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Productos&action=familiaEdit',
                'GET',
                { idFamilia: id },
                defaultMessage);
            return false;
        }));

        $("#tablaFamilias").on("click", ".deleteFamilia" ,(function () {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            showConfirmation($('#modalConfirmacion'),
                {
                    title: '¿ Está seguro ?',
                    message: 'Esta acción eliminará la familia. ¿Está seguro? ',
                    ok: 'Eliminar',
                    cancel: 'Cancelar'
                }, function () {

                    $.ajax({
                        type: 'GET',
                        url: 'ajax.php?controller=Productos&action=deleteFamilia',
                        data: { idFamilia: id },
                        beforeSend: function() {
                        },
                        success: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            if (returnedData.status == 'error') {
                                $('#messageFamilia').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                            } else {
                                $('#messageFamilia').html('<div class="alert alert-success" role="alert">' + returnedData.message + '</div>');
                                window.location.href = "index.php?controller=Productos&action=familias";
                            }
                        },
                        error: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            $('#messageFamilia').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                        }
                    });
                });
        }));

        $('#newFamiliaBtn').click(function(){
            var e = 'ajax.php?controller=Productos&action=createNewFamilia'; console.debug(e);
            var codigo = $("#codigo").val(); console.debug(codigo);
            var nombre = $("#nombre").val(); console.debug(nombre);

            if(nombre == '' || codigo == '')
            {
                $('#messageNewFamilia').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong> Debes llenar todos los campos.</div>');
            }
            else
            {
                $.ajax({
                    type: 'GET',
                    url: e,
                    data: { codigo: codigo, nombre: nombre},
                    dataType : "json",
                    beforeSend: function () {
                        $('#newFamiliaBtn').html("Cargando...");
                    },
                    success: function (data) {
                        console.debug("success");
                        console.debug(data);
                        //var returnedData = JSON.parse(data); console.debug(returnedData);
                        if(data.status == "success"){
                            $('#messageNewFamilia').html('<div class="alert alert-success" role="alert"><strong>Listo! </strong>' + data.message + '</div>');
                            $('#newFamiliaBtn').html('Agregar');
                            window.location.href = "index.php?controller=Productos&action=familias";
                        }
                        else{
                            $('#newFamiliaBtn').html("Agregar");
                            $('#messageNewFamilia').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                        }
                        return false;
                    },
                    error: function (data) {
                        console.debug("error");
                        console.debug(data);
                        //var returnedData = JSON.parse(data); console.debug(returnedData);
                        $('#newFamiliaBtn').html("Agregar");
                        $('#messageNewFamilia').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                        return false;
                    }
                });
            }

            return false;
        });

        $("#cleanDataFamiliaBtn").click(function() {
            $(this).closest('form').find("input[type=text], textarea").val("");
            return false;
        });

    });
</script>