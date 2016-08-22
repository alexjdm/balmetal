<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px; height: 600px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Nuevo Certificado</h4>
        </div>
        <div class="modal-body" style="max-height: 479px; overflow-y: auto;">
            <input type="hidden" id="idSello" value="<?php echo $sello['ID_SELLO'] ?>">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="sello">Sello</label>
                <div class="col-sm-9">
                    <?php echo $sello['SELLO'] ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="familia">Familia</label>
                <div class="col-sm-9">
                    <?php echo $familia['NOMBRE_FAMILIA'] ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="articulo">Artículo</label>
                <div class="col-sm-9">
                    <?php echo utf8_encode($articulo['DESCRIPCION']) ?>
                </div>
            </div>
            <!--<div class="form-group">
                <label class="col-sm-3 control-label" for="auto">Automóvil</label>
                <div class="col-sm-9">
                    <?php /*echo utf8_encode($auto['MARCA_AUTO'] . " - " . $auto['MODELO_AUTO']) */?>
                </div>
            </div>-->
            <div class="form-group">
                <label class="col-sm-3 control-label" for="auto">Automóvil</label>
                <div class="col-sm-9">
                    <select id="auto" name="auto" class="form-control">
                        <?php foreach($autos as $auto): ?>
                            <option id="<?php echo $auto['ID_AUTO'] ?>"><?php echo utf8_encode($auto['MARCA_AUTO']) . " - " . utf8_encode($auto['MODELO_AUTO']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="chasis">Chasis</label>
                <div class="col-sm-9">
                    <input class="form-control" id="chasis" type="text" placeholder="Ingrese el número de chasis">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="patente">Patente</label>
                <div class="col-sm-9">
                    <input class="form-control" id="patente" type="text" placeholder="Ingrese la patente">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="glosa">Glosa</label>
                <div class="col-sm-9">
                    <input class="form-control" id="glosa" type="text" placeholder="Ingrese la glosa del producto">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="obs">Observaciones</label>
                <div class="col-sm-9">
                    <input class="form-control" id="obs" type="text" placeholder="Ingrese sus observaciones">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="folio">Folio</label>
                <div class="col-sm-9">
                    <input class="form-control" id="folio" type="text" placeholder="Ingrese el número de folio">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="cliente">Cliente</label>
                <div class="col-sm-9">
                    <select id="cliente" name="cliente" class="form-control">
                        <?php foreach($clientes as $cliente): ?>
                            <option id="<?php echo $cliente['ID_CLIENTE'] ?>"><?php echo $cliente['NOMBRE'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <br>
            <div id="messageNewCertificado"></div>
        </div>

        <div class="modal-footer">
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="saveCertificadoNew" type="button" class="btn btn-primary">Generar</button>
        </div>
    </div>
</div>

<script type="application/javascript">

    $('#saveCertificadoNew').click(function(){
        var e = 'ajax.php?controller=Sellos&action=createCertificado'; console.debug(e);

        var idSello = $("#idSello").val();
        var idCliente = $("#cliente").children(":selected").attr("id");
        var glosa = $("#glosa").val();
        var obs = $("#obs").val();
        var folio = $("#folio").val();
        var idAuto = $("#auto").children(":selected").attr("id");
        var chasis = $("#chasis").val();
        var patente = $("#patente").val();

        if(idSello == '' || idCliente == '' || glosa == '' || obs == '' || folio == '' || chasis == '')
        {
            $('#messageNewCertificado').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong> Debes llenar todos los campos</div>');
        }
        else
        {
            $.ajax({
                type: 'GET',
                url: e,
                //data: { idSello: idSello, idCliente: idCliente, glosa: glosa, obs: obs, folio: folio },
                data: { idSello: idSello, idCliente: idCliente, glosa: glosa, obs: obs, folio: folio, idAuto:idAuto, chasis: chasis, patente: patente },
                dataType : "json",
                beforeSend: function () {
                    $('#saveCertificadoNew').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageNewCertificado').html('<div class="alert alert-success" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveCertificadoNew').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        window.location.href = "index.php?controller=Certificados&action=certificados";
                    }
                    else {
                        $('#saveCertificadoNew').html("Generar");
                        $('#messageNewCertificado').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveCertificadoNew').html("Generar");
                    $('#messageNewCertificado').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                }
            });
        }

        return false;
    });

</script>