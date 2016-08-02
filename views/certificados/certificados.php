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
        Certificados
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Certificados</a></li>
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
                    <h3 class="box-title">Lista de Certificados</h3>
                    <button class="btn btn-primary" id="newCertificadoBtn" style="float:right;" disabled><i class="fa fa-plus-circle" aria-hidden="true"></i> Nuevo</button>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <table id="tablaCertificados" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>N°</th>
                                <th>Sello</th>
                                <th>Cliente</th>
                                <th>Automóvil</th>
                                <th>Glosa</th>
                                <th>Observaciones</th>
                                <th>Folio</th>
                                <th>Imprimir</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $n = 1; ?>
                        <?php foreach ($certificados as $certificado): ?>
                            <tr data-id="<?php echo $certificado['ID_CERTIFICADO'] ?>" data-certificado="<?php echo $certificado['URL_CERTIFICADO'] ?>">
                                <td><?php echo $n ?></td>
                                <td>
                                    <?php
                                    foreach($sellos as $sello):
                                        if($sello['ID_SELLO'] == $certificado['ID_SELLO'])
                                        {
                                            echo $sello['SELLO'];
                                            break;
                                        }
                                    endforeach;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach($clientes as $cliente):
                                        if($cliente['ID_CLIENTE'] == $certificado['ID_CLIENTE'])
                                        {
                                            echo $cliente['NOMBRE'];
                                            break;
                                        }
                                    endforeach;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach($sellos as $sello):
                                        if($certificado['ID_SELLO'] == $sello['ID_SELLO']){
                                            foreach($autos as $auto):
                                                if($sello['ID_AUTO'] == $auto['ID_AUTO']){
                                                    echo $auto['MARCA_AUTO'] . " - " . $auto['MODELO_AUTO'];
                                                    break;
                                                }
                                            endforeach;
                                        }
                                    endforeach;
                                    ?>
                                </td>
                                <td><?php echo $certificado['GLOSA'] ?></td>
                                <td><?php echo $certificado['OBSERVACIONES'] ?></td>
                                <td><?php echo $certificado['FOLIO'] ?></td>
                                <td>
                                    <center>
                                        <?php echo $certificado['IMPRIMIR'] ?>
                                        &nbsp
                                        <button data-original-title="View Row" class="btn btn-xs btn-default printCertificado">
                                            <i class="fa fa-print" aria-hidden="true"></i>
                                        </button>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <button data-original-title="Delete" class="btn btn-xs btn-default deleteCertificado">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </center>
                                    <!--
                                    <button data-original-title="View Row" class="btn btn-xs btn-default viewCertificado">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    &nbsp
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
                                <th>Cliente</th>
                                <th>Automóvil</th>
                                <th>Glosa</th>
                                <th>Observaciones</th>
                                <th>Folio</th>
                                <th>Imprimir</th>
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
        var table = $("#tablaCertificados").dataTable();

        $("#tablaCertificados").on("click", ".printCertificado", (function() {
            var e = 'ajax.php?controller=Certificados&action=imprimirCertificado';

            var id = $(this).closest('tr').data("id");
            var certificado = $(this).closest('tr').data("certificado");

            $.ajax({
                type: 'GET',
                url: e,
                data: { idCertificado: id },
                dataType : "json",
                beforeSend: function () {
                    $('#saveProveedorEdit').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageCertificados').html('<div class="alert alert-success" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveProveedorEdit').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        //window.location.href = "index.php?controller=Certificados&action=certificados";
                        var win = window.open(certificado, '_blank');
                        win.focus();
                        //reloadPage();
                        window.location.href = "index.php?controller=Certificados&action=certificados";
                    }
                    else {
                        $('#saveProveedorEdit').html("Guardar");
                        $('#messageCertificados').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveProveedorEdit').html("Guardar");
                    $('#messageCertificados').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                }
            });

            return false;
        }));

        $("#tablaCertificados").on("click", ".deleteCertificado" ,(function () {
            var id = $(this).closest('tr').data("id"); console.debug(id);
            showConfirmation($('#modalConfirmacion'),
                {
                    title: '¿ Está seguro ?',
                    message: 'Esta acción eliminará el certificado. ¿Está seguro? ',
                    ok: 'Eliminar',
                    cancel: 'Cancelar'
                }, function () {

                    $.ajax({
                        type: 'GET',
                        url: 'ajax.php?controller=Certificados&action=deleteCertificado',
                        data: { idCertificado: id },
                        beforeSend: function() {
                        },
                        success: function(returnedData) {
                            //var returnedData = JSON.parse(data); console.debug(returnedData);
                            if (returnedData.status == 'error') {
                                $('#messageSello').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                            } else {
                                $('#messageSello').html('<div class="alert alert-success" role="alert">' + returnedData.message + '</div>');
                                window.location.href = "index.php?controller=Certificados&action=certificados";
                            }
                        },
                        error: function(data) {
                            var returnedData = JSON.parse(data); console.debug(returnedData);
                            $('#messageSello').html('<div class="alert alert-danger" role="alert">' + returnedData.message + '</div>');
                        }
                    });
                });
        }));

        $('#newCertificadoBtn').click(function(){
            var id = $(this).closest('tr').data("id"); console.debug(id);
            ajax_loadModal($('#modalPrincipal'),
                'ajax.php?controller=Certificados&action=newCertificado',
                'GET',
                { idCertificado: id },
                defaultMessage);
            return false;
        });

    });
</script>