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
        Impuestos
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Impuestos</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div id="messageImpuesto"></div>

    <div class="row">
        <div class="col-md-4">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Agregar Impuesto</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <form class="form-horizontal">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-12" for="valor">Valor</label>
                                <div class="col-sm-12">
                                    <input class="form-control" id="valor" type="text" placeholder="Valor">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12" for="nombre">Nombre</label>
                                <div class="col-sm-12">
                                    <input class="form-control" id="nombre" type="text" placeholder="Nombre">
                                </div>
                            </div>

                            <div id="messageNewImpuesto" style="margin: 20px;"></div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <a id="cleanDataImpuestoBtn" class="btn btn-default">Limpiar</a>
                            <a id="newImpuestoBtn" class="btn btn-primary pull-right" >Agregar</a>
                        </div><!-- /.box-footer -->
                    </form>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

        <div class="col-md-8">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Impuestos</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <table id="tablaImpuestos" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nombre</th>
                            <th>Valor</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $n = 1; ?>
                        <?php foreach ($impuestos as $impuesto): ?>
                            <tr data-id="<?php echo $impuesto['ID_IMPUESTO'] ?>">
                                <th><?php echo $n ?></th>
                                <td><?php echo utf8_encode($impuesto['NOMBRE_IMPUESTO']) ?></td>
                                <td><?php echo $impuesto['VALOR_IMPUESTO'] ?></td>
                                <td>
                                    <button data-original-title="Edit Row" class="btn btn-xs btn-default editImpuesto">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    &nbsp
                                    <button data-original-title="Delete" class="btn btn-xs btn-default deleteImpuesto">
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
                            <th>Valor</th>
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
        var table = $("#tablaImpuestos").dataTable();

        $("#tablaImpuestos").on("click", ".editImpuesto", (function() {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Mantenimiento&action=impuestoEdit',
                'GET',
                { idImpuesto: id },
                defaultMessage);
            return false;
        }));

        $("#tablaImpuestos").on("click", ".deleteImpuesto" ,(function () {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            showConfirmation($('#modalConfirmacion'),
                {
                    title: '¿ Está seguro ?',
                    message: 'Esta acción eliminará la impuesto. ¿Está seguro? ',
                    ok: 'Eliminar',
                    cancel: 'Cancelar'
                }, function () {

                    $.ajax({
                        type: 'GET',
                        url: 'ajax.php?controller=Mantenimiento&action=deleteImpuesto',
                        data: { idImpuesto: id },
                        beforeSend: function() {
                        },
                        success: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            if (returnedData.status == 'error') {
                                $('#messageImpuesto').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                            } else {
                                $('#messageImpuesto').html('<div class="alert alert-success" role="alert">' + returnedData.message + '</div>');
                                window.location.href = "index.php?controller=Mantenimiento&action=impuestos";
                            }
                        },
                        error: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            $('#messageImpuesto').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                        }
                    });
                });
        }));

        $('#newImpuestoBtn').click(function(){
            var e = 'ajax.php?controller=Mantenimiento&action=createNewImpuesto'; console.debug(e);
            var valor = $("#valor").val(); console.debug(valor);
            var nombre = $("#nombre").val(); console.debug(nombre);

            if(nombre == '' || valor == '')
            {
                $('#messageNewImpuesto').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong> Debes llenar todos los campos.</div>');
            }
            else
            {
                $.ajax({
                    type: 'GET',
                    url: e,
                    data: { valor: valor, nombre: nombre},
                    dataType : "json",
                    beforeSend: function () {
                        $('#newImpuestoBtn').html("Cargando...");
                    },
                    success: function (data) {
                        console.debug("success");
                        console.debug(data);
                        //var returnedData = JSON.parse(data); console.debug(returnedData);
                        if(data.status == "success"){
                            $('#messageNewImpuesto').html('<div class="alert alert-success" role="alert"><strong>Listo! </strong>' + data.message + '</div>');
                            $('#newImpuestoBtn').html('Agregar');
                            window.location.href = "index.php?controller=Mantenimiento&action=impuestos";
                        }
                        else{
                            $('#newImpuestoBtn').html("Agregar");
                            $('#messageNewImpuesto').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                        }
                        return false;
                    },
                    error: function (data) {
                        console.debug("error");
                        console.debug(data);
                        //var returnedData = JSON.parse(data); console.debug(returnedData);
                        $('#newImpuestoBtn').html("Agregar");
                        $('#messageNewImpuesto').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                        return false;
                    }
                });
            }

            return false;
        });

        $("#cleanDataImpuestoBtn").click(function() {
            $(this).closest('form').find("input[type=text], textarea").val("");
            return false;
        });

    });
</script>