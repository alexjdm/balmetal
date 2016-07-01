<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px; height: 600px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Nuevo Proveedor</h4>
        </div>
        <div class="modal-body" style="max-height: 479px; overflow-y: auto;">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="nombre">Nombre</label>
                <div class="col-sm-9">
                    <input class="form-control" id="nombre" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="rut">Rut</label>
                <div class="col-sm-9">
                    <input class="form-control" id="rut" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="tipo">Tipo</label>
                <div class="col-sm-9">
                    <select class="form-control" id="tipo" name="tipo">
                        <option value="0">Todos los estados</option>
                        <option value="1">Vendedor</option>
                        <option value="2">Trabajador</option>
                        <option value="3">Instalador</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="direccion">Dirección</label>
                <div class="col-sm-9">
                    <input class="form-control" id="direccion" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="region">Región</label>
                <div class="col-sm-9">
                    <select id="region" name="region" class="form-control">
                        <?php foreach($regiones as $region): ?>
                            <option id="<?php echo $region['ID_REGION'] ?>"><?php echo utf8_encode($region['NOMBRE_REGION']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="comuna">Comuna</label>
                <div class="col-sm-9">
                    <input class="form-control" id="comuna" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="banco">Banco</label>
                <div class="col-sm-9">
                    <select id="banco" name="banco" class="form-control">
                        <?php foreach($bancos as $banco): ?>
                            <option id="<?php echo $banco['ID_BANCO'] ?>"><?php echo $banco['NOMBRE_BANCO'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="cuentaBancaria">Cuenta Bancaria</label>
                <div class="col-sm-9">
                    <input class="form-control" id="cuentaBancaria" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="codigoPostal">Código Postal</label>
                <div class="col-sm-9">
                    <input class="form-control" id="codigoPostal" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="telefono">Teléfono</label>
                <div class="col-sm-9">
                    <input class="form-control" id="telefono" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="movil">Móvil</label>
                <div class="col-sm-9">
                    <input class="form-control" id="movil" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="correo">Correo Electrónico</label>
                <div class="col-sm-9">
                    <input class="form-control" id="correo" type="email">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="sitioWeb">Sitio Web</label>
                <div class="col-sm-9">
                    <input class="form-control" id="sitioWeb" type="text">
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <div id="messageNewProveedor" style="float:left; width: 400px;"></div>
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="saveProveedorNew" type="button" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</div>

<script type="application/javascript">

    $('#saveProveedorNew').click(function(){
        var e = 'ajax.php?controller=Proveedores&action=createNewProveedor'; console.debug(e);
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
            $('#messageNewProveedor').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong> Debes llenar al menos el nombre y rut.</div>');
        }
        else
        {
            $.ajax({
                type: 'GET',
                url: e,
                data: { nombre: nombre, rut: rut, tipo: tipo, direccion: direccion, region: region, comuna: comuna, banco: banco, cuentaBancaria: cuentaBancaria,
                    codigoPostal: codigoPostal, telefono: telefono, movil: movil, correo: correo, sitioWeb: sitioWeb },
                dataType : "json",
                beforeSend: function () {
                    $('#saveProveedorNew').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageNewProveedor').html('<div class="alert alert-success" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveProveedorNew').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        window.location.href = "index.php?controller=Proveedores&action=proveedores";
                    }
                    else{
                        $('#saveProveedorNew').html("Guardar");
                        $('#messageNewProveedor').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveProveedorNew').html("Guardar");
                    $('#messageNewProveedor').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                }
            });
        }

        return false;
    });

    $("#cleanDataProveedorBtn").click(function() {
        $(this).closest('form').find("input[type=text], textarea").val("");
        return false;
    });

</script>