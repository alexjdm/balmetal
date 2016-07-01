<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px; height: 600px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Cliente</h4>
        </div>
        <div class="modal-body" style="max-height: 479px; overflow-y: auto;">
            <input id="idCliente" value="<?php echo $cliente['ID_CLIENTE'] ?>" type="hidden">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="nombre">Nombre</label>
                <div class="col-sm-9">
                    <input class="form-control" id="nombre" type="text" value="<?php echo $cliente['NOMBRE'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="rut">Rut</label>
                <div class="col-sm-9">
                    <input class="form-control" id="rut" type="text" value="<?php echo $cliente['RUT'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="direccion">Dirección</label>
                <div class="col-sm-9">
                    <input class="form-control" id="direccion" type="text" value="<?php echo $cliente['DIRECCION'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="region">Región</label>
                <div class="col-sm-9">
                    <select id="region" name="region" class="form-control">
                        <?php foreach($regiones as $region): ?>
                            <option id="<?php echo $region['ID_REGION'] ?>" <?php if($cliente['ID_REGION'] == $region['ID_REGION']){ echo "selected";  } ?>><?php echo utf8_encode($region['NOMBRE_REGION']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="comuna">Comuna</label>
                <div class="col-sm-9">
                    <input class="form-control" id="comuna" type="text" value="<?php echo $cliente['COMUNA'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="banco">Banco</label>
                <div class="col-sm-9">
                    <select id="banco" name="banco" class="form-control">
                        <?php foreach($bancos as $banco): ?>
                            <option id="<?php echo $banco['ID_BANCO'] ?>" <?php if($cliente['ID_BANCO'] == $banco['ID_BANCO']){ echo "selected";  } ?>><?php echo $banco['NOMBRE_BANCO'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="cuentaBancaria">Cuenta Bancaria</label>
                <div class="col-sm-9">
                    <input class="form-control" id="cuentaBancaria" type="text" value="<?php echo $cliente['CUENTA_BANCARIA'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="codigoPostal">Código Postal</label>
                <div class="col-sm-9">
                    <input class="form-control" id="codigoPostal" type="text" value="<?php echo $cliente['CODIGO_POSTAL'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="telefono">Teléfono</label>
                <div class="col-sm-9">
                    <input class="form-control" id="telefono" type="text" value="<?php echo $cliente['TELEFONO'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="movil">Móvil</label>
                <div class="col-sm-9">
                    <input class="form-control" id="movil" type="text" value="<?php echo $cliente['MOVIL'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="correo">Correo Electrónico</label>
                <div class="col-sm-9">
                    <input class="form-control" id="correo" type="email" value="<?php echo $cliente['CORREO_ELECTRONICO'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="sitioWeb">Sitio Web</label>
                <div class="col-sm-9">
                    <input class="form-control" id="sitioWeb" type="text" value="<?php echo $cliente['SITIO_WEB'] ?>">
                </div>
            </div>

            <br>
            <div id="messageEditCliente"></div>
        </div>

        <div class="modal-footer">
            <div id="messageEditCliente" style="float:left; width: 400px;"></div>
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="saveClienteEdit" type="button" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</div>

<script type="application/javascript">

    $('#saveClienteEdit').click(function(){
        var e = 'ajax.php?controller=Clientes&action=editCliente'; console.debug(e);
        var idCliente = $("#idCliente").val();
        var nombre = $("#nombre").val();
        var rut = $("#rut").val();
        var tipo = $("#tipo").val();
        var direccion = $("#direccion").val();
        var region = $("#region").children(":selected").attr("id");
        var comuna = $("#comuna").val();
        var banco = $("#banco").children(":selected").attr("id");
        var cuentaBancaria = $("#cuentaBancaria").val();
        var codigoPostal = $("#codigoPostal").val();
        var telefono = $("#telefono").val();
        var movil = $("#movil").val();
        var correo = $("#correo").val();
        var sitioWeb = $("#sitioWeb").val();

        if(nombre == '' || rut == '')
        {
            $('#messageEditCliente').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong> Debes llenar al menos el nombre y rut.</div>');
        }
        else
        {
            $.ajax({
                type: 'GET',
                url: e,
                data: { idCliente: idCliente, nombre: nombre, rut: rut, tipo: tipo, direccion: direccion, region: region, comuna: comuna, banco: banco, cuentaBancaria: cuentaBancaria,
                    codigoPostal: codigoPostal, telefono: telefono, movil: movil, correo: correo, sitioWeb: sitioWeb },
                dataType : "json",
                beforeSend: function () {
                    $('#saveClienteEdit').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageEditCliente').html('<div class="alert alert-success" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveClienteEdit').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        window.location.href = "index.php?controller=Clientes&action=proveedores";
                    }
                    else {
                        $('#saveClienteEdit').html("Guardar");
                        $('#messageEditCliente').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveClienteEdit').html("Guardar");
                    $('#messageEditCliente').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                }
            });
        }

        return false;
    });

</script>