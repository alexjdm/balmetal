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
        Sellos
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Sellos</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div id="messageSello"></div>

    <div class="row">

        <div class="col-md-12">
            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Sellos</h3>
                    <button class="btn btn-primary" id="newSelloBtn" style="float:right;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo</button>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <table id="tablaSellos" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Sello</th>
                                <th>Codigo</th>
                                <th>Familia</th>
                                <th>Artículo</th>
                                <th>Automóvil</th>
                                <th>Chasis</th>
                                <th>Patente</th>
                                <th>Imprimir</th>
                                <th>Certificado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $n = 1; ?>
                        <?php foreach ($sellos as $sello): ?>
                            <tr data-id="<?php echo $sello['ID_SELLO'] ?>" data-sello="<?php echo $sello['SELLO'] ?>">
                                <td><?php echo $n ?></td>
                                <td><?php echo $sello['SELLO'] ?></td>
                                <td>
                                    <?php
                                    foreach($articulos as $articulo):
                                        if($sello['ID_ARTICULO'] == $articulo['ID_ARTICULO'])
                                        {
                                            echo $articulo['CODIGO_ARTICULO'];
                                            break;
                                        }
                                    endforeach;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach($articulos as $articulo):
                                        if($sello['ID_ARTICULO'] == $articulo['ID_ARTICULO']){
                                            foreach($familias as $familia):
                                                if($familia['ID_FAMILIA'] == $articulo['ID_FAMILIA']){
                                                    echo $familia['NOMBRE_FAMILIA'];
                                                    break;
                                                }
                                            endforeach;
                                        }
                                    endforeach;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach($articulos as $articulo):
                                        if($sello['ID_ARTICULO'] == $articulo['ID_ARTICULO'])
                                        {
                                            echo $articulo['DESCRIPCION'];
                                            break;
                                        }
                                    endforeach;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach($autos as $auto):
                                        if($auto['ID_AUTO'] == $sello['ID_AUTO'])
                                        {
                                            echo $auto['MARCA_AUTO'] . " - " . $auto['MODELO_AUTO'];
                                            break;
                                        }
                                    endforeach;
                                    ?>
                                </td>
                                <td><?php echo $sello['CHASIS'] ?></td>
                                <td><?php echo $sello['PATENTE'] ?></td>
                                <td>
                                    <center>
                                        <?php echo $sello['IMPRIMIR'] ?>
                                        &nbsp
                                        <button data-original-title="View Row" class="btn btn-xs btn-default printSello">
                                            <i class="fa fa-print" aria-hidden="true"></i>
                                        </button>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <button data-original-title="Edit Row" class="btn btn-xs btn-default newCertificado">
                                            <i class="fa fa-certificate"></i>
                                        </button>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <button data-original-title="View Row" class="btn btn-xs btn-default viewSello">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </center>
                                    <!--&nbsp
                                    <button data-original-title="Edit Row" class="btn btn-xs btn-default editSello">
                                        <i class="fa fa-pencil"></i>
                                    </button>
                                    &nbsp
                                    <button data-original-title="Delete" class="btn btn-xs btn-default deleteSello" disabled>
                                        <i class="fa fa-times"></i>
                                    </button>-->
                                </td>
                            </tr>
                            <?php $n++; ?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>N°</th>
                                <th>Sello</th>
                                <th>Codigo</th>
                                <th>Familia</th>
                                <th>Artículo</th>
                                <th>Automóvil</th>
                                <th>Chasis</th>
                                <th>Patente</th>
                                <th>Imprimir</th>
                                <th>Certificado</th>
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
        var table = $("#tablaSellos").dataTable();

        $("#tablaSellos").on("click", ".printSello", (function() {
            var e = 'ajax.php?controller=Sellos&action=imprimirSello';

            var id = $(this).closest('tr').data("id");
            var sello = $(this).closest('tr').data("sello");

            $.ajax({
                type: 'GET',
                url: e,
                data: { idSello: id },
                dataType : "json",
                beforeSend: function () {
                    $('#saveProveedorEdit').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageSellos').html('<div class="alert alert-success" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveProveedorEdit').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        window.location.href = "index.php?controller=Sellos&action=sellos";
                        var win = window.open('imprimir.php?sello=' + sello, '_blank');
                        win.focus();
                        //reloadPage();
                        window.location.href = "index.php?controller=Sellos&action=sellos";
                    }
                    else {
                        $('#saveProveedorEdit').html("Guardar");
                        $('#messageSellos').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveProveedorEdit').html("Guardar");
                    $('#messageSellos').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                }
            });

            /*ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Sellos&action=selloView',
                'GET',
                { idSello: id },
                defaultMessage);*/

            return false;
        }));
        
        $("#tablaSellos").on("click", ".viewSello", (function() {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Sellos&action=selloView',
                'GET',
                { idSello: id },
                defaultMessage);
            return false;
        }));

        $("#tablaSellos").on("click", ".editSello", (function() {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Sellos&action=selloEdit',
                'GET',
                { idSello: id },
                defaultMessage);
            return false;
        }));

        $("#tablaSellos").on("click", ".deleteSello" ,(function () {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            showConfirmation($('#modalConfirmacion'),
                {
                    title: '¿ Está seguro ?',
                    message: 'Esta acción eliminará el sello. ¿Está seguro? ',
                    ok: 'Eliminar',
                    cancel: 'Cancelar'
                }, function () {

                    $.ajax({
                        type: 'GET',
                        url: 'ajax.php?controller=Sellos&action=deleteSello',
                        data: { idSello: id },
                        beforeSend: function() {
                        },
                        success: function(returnedData) {
                            //var returnedData = JSON.parse(data); console.debug(returnedData);
                            if (returnedData.status == 'error') {
                                $('#messageSello').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                            } else {
                                $('#messageSello').html('<div class="alert alert-success" role="alert">' + returnedData.message + '</div>');
                                window.location.href = "index.php?controller=Sellos&action=sellos";
                            }
                        },
                        error: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            $('#messageSello').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                        }
                    });
                });
        }));

        $('#newSelloBtn').click(function(){
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Sellos&action=newSello',
                'GET',
                { idSello: id },
                defaultMessage);
            return false;
        });

        $('.newCertificado').click(function(){
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Sellos&action=newCertificado',
                'GET',
                { idSello: id },
                defaultMessage);
            return false;
        });

    });
</script>