<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Auto</h4>
        </div>
        <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
            <input id="idAuto" value="<?php echo $auto['ID_AUTO'] ?>" type="hidden">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="marca">Marca</label>
                <div class="col-sm-9">
                    <input class="form-control" id="marca" type="text" value="<?php echo $auto['MARCA_AUTO'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="modelo">Modelo</label>
                <div class="col-sm-9">
                    <input class="form-control" id="modelo" type="text" value="<?php echo $auto['MODELO_AUTO'] ?>">
                </div>
            </div>
            <br>
            <div id="messageEditAuto"></div>
        </div>

        <div class="modal-footer">
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="saveAutoEdit" type="button" class="btn btn-primary">Guardar</button>

        </div>
    </div>
</div>

<script type="application/javascript">

    $('#saveAutoEdit').click(function(){
        var e = 'ajax.php?controller=Mantenimiento&action=editAuto'; console.debug(e);
        var idAuto = $("#idAuto").val(); console.debug(idAuto);
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
                data: { idAuto: idAuto, marca: marca, modelo: modelo },
                dataType : "json",
                beforeSend: function () {
                    $('#saveAutoEdit').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageEditAuto').html('<div class="alert alert-success" role="alert"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveAutoEdit').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        window.location.href = "index.php?controller=Mantenimiento&action=autos";
                    }
                    else{
                        $('#saveAutoEdit').html("Guardar");
                        $('#messageEditAuto').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveAutoEdit').html("Guardar");
                    $('#messageEditAuto').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                }
            });
        }

        return false;
    });

</script>