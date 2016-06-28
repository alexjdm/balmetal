<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Ubicación</h4>
        </div>
        <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
            <input id="idUbicacion" value="<?php echo $ubicacion['ID_UBICACION'] ?>" type="hidden">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="nombre">Nombre</label>
                <div class="col-sm-9">
                    <input class="form-control" id="nombre" type="text" value="<?php echo $ubicacion['NOMBRE_UBICACION'] ?>">
                </div>
            </div>
            <br>
            <div id="messageEditUbicacion"></div>
        </div>

        <div class="modal-footer">
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="saveUbicacionEdit" type="button" class="btn btn-primary">Guardar</button>

        </div>
    </div>
</div>

<script type="application/javascript">

    $('#saveUbicacionEdit').click(function(){
        var e = 'ajax.php?controller=Mantenimiento&action=editUbicacion'; console.debug(e);
        var idUbicacion = $("#idUbicacion").val(); console.debug(idUbicacion);
        var nombre = $("#nombre").val(); console.debug(nombre);

        if(nombre == '')
        {
            $('#messageNewUbicacion').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong> Debes llenar todos los campos.</div>');
        }
        else
        {
            $.ajax({
                type: 'GET',
                url: e,
                data: { idUbicacion: idUbicacion, nombre: nombre },
                dataType : "json",
                beforeSend: function () {
                    $('#saveUbicacionEdit').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageEditUbicacion').html('<div class="alert alert-success" role="alert"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveUbicacionEdit').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        window.location.href = "index.php?controller=Mantenimiento&action=ubicaciones";
                    }
                    else{
                        $('#saveUbicacionEdit').html("Guardar");
                        $('#messageEditUbicacion').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveUbicacionEdit').html("Guardar");
                    $('#messageEditUbicacion').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                }
            });
        }

        return false;
    });

</script>