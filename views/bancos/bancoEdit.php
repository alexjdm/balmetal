<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Banco</h4>
        </div>
        <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
            <input id="idBanco" value="<?php echo $banco['ID_BANCO'] ?>" type="hidden">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="nombre">Nombre</label>
                <div class="col-sm-9">
                    <input class="form-control" id="nombre" type="text" value="<?php echo $banco['NOMBRE_BANCO'] ?>">
                </div>
            </div>
            <br>
            <div id="messageEditBanco"></div>
        </div>

        <div class="modal-footer">
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="saveBancoEdit" type="button" class="btn btn-primary">Guardar</button>

        </div>
    </div>
</div>

<script type="application/javascript">

    $('#saveBancoEdit').click(function(){
        var e = 'ajax.php?controller=Mantenimiento&action=editBanco'; console.debug(e);
        var idBanco = $("#idBanco").val(); console.debug(idBanco);
        var nombre = $("#nombre").val(); console.debug(nombre);

        if(nombre == '')
        {
            $('#messageNewBanco').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong> Debes llenar todos los campos.</div>');
        }
        else
        {
            $.ajax({
                type: 'GET',
                url: e,
                data: { idBanco: idBanco, nombre: nombre },
                dataType : "json",
                beforeSend: function () {
                    $('#saveBancoEdit').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageEditBanco').html('<div class="alert alert-success" role="alert"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveBancoEdit').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        window.location.href = "index.php?controller=Mantenimiento&action=bancos";
                    }
                    else{
                        $('#saveBancoEdit').html("Guardar");
                        $('#messageEditBanco').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveBancoEdit').html("Guardar");
                    $('#messageEditBanco').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                }
            });
        }

        return false;
    });

</script>