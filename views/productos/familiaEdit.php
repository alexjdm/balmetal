<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Familia</h4>
        </div>
        <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
            <input id="idFamilia" value="<?php echo $familia['ID_FAMILIA'] ?>" type="hidden">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="codigo">Código</label>
                <div class="col-sm-9">
                    <input class="form-control" id="codigo" type="text" value="<?php echo $familia['CODIGO_FAMILIA'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="nombre">Nombre</label>
                <div class="col-sm-9">
                    <input class="form-control" id="nombre" type="text" value="<?php echo $familia['NOMBRE_FAMILIA'] ?>">
                </div>
            </div>
            <br>
            <div id="messageEditFamilia"></div>
        </div>

        <div class="modal-footer">
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="saveFamiliaEdit" type="button" class="btn btn-primary" id="submit">Guardar</button>

        </div>
    </div>
</div>

<script type="application/javascript">

    $('#saveFamiliaEdit').click(function(){
        var e = 'ajax.php?controller=Familia&action=editFamilia'; console.debug(e);
        var idFamilia = $("#idFamilia").val(); console.debug(idFamilia);
        var codigo = $("#codigo").val(); console.debug(codigo);
        var nombre = $("#nombre").val(); console.debug(nombre);

        $.ajax({
            type: 'GET',
            url: e,
            data: { idFamilia: idFamilia, codigo: codigo, nombre: nombre },
            dataType : "json",
            beforeSend: function () {
                $('#saveFamiliaEdit').html("Cargando...");
            },
            success: function (data) {
                console.debug("success");
                console.debug(data);
                //var returnedData = JSON.parse(data); console.debug(returnedData);
                if(data.status == "success"){
                    $('#messageEditFamilia').html('<div class="alert alert-success" role="alert"><strong>Listo! </strong>' + data.message + '</div>');
                    $('#saveFamiliaEdit').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                    $('#modalPrincipal').hide();
                    window.location.href = "index.php?controller=Familia&action=index";
                }
                else{
                    $('#saveFamiliaEdit').html("Guardar");
                    $('#messageEditFamilia').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                }
            },
            error: function (data) {
                console.debug("error");
                console.debug(data);
                //var returnedData = JSON.parse(data); console.debug(returnedData);
                $('#saveFamiliaEdit').html("Guardar");
                $('#messageEditFamilia').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
            }
        });
    });

</script>