<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Impuesto</h4>
        </div>
        <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
            <input id="idImpuesto" value="<?php echo $impuesto['ID_IMPUESTO'] ?>" type="hidden">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="valor">Valor</label>
                <div class="col-sm-9">
                    <input class="form-control" id="valor" type="text" value="<?php echo $impuesto['VALOR_IMPUESTO'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="nombre">Nombre</label>
                <div class="col-sm-9">
                    <input class="form-control" id="nombre" type="text" value="<?php echo $impuesto['NOMBRE_IMPUESTO'] ?>">
                </div>
            </div>
            <br>
            <div id="messageEditImpuesto"></div>
        </div>

        <div class="modal-footer">
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="saveImpuestoEdit" type="button" class="btn btn-primary">Guardar</button>

        </div>
    </div>
</div>

<script type="application/javascript">

    $('#saveImpuestoEdit').click(function(){
        var e = 'ajax.php?controller=Mantenimiento&action=editImpuesto'; console.debug(e);
        var idImpuesto = $("#idImpuesto").val(); console.debug(idImpuesto);
        var nombre = $("#nombre").val(); console.debug(nombre);
        var valor = $("#valor").val(); console.debug(valor);

        if(nombre == '' || valor == '')
        {
            $('#messageNewImpuesto').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong> Debes llenar todos los campos.</div>');
        }
        else
        {
            $.ajax({
                type: 'GET',
                url: e,
                data: { idImpuesto: idImpuesto, nombre: nombre, valor: valor},
                dataType : "json",
                beforeSend: function () {
                    $('#saveImpuestoEdit').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageEditImpuesto').html('<div class="alert alert-success" role="alert"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveImpuestoEdit').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        window.location.href = "index.php?controller=Mantenimiento&action=impuestos";
                    }
                    else{
                        $('#saveImpuestoEdit').html("Guardar");
                        $('#messageEditImpuesto').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveImpuestoEdit').html("Guardar");
                    $('#messageEditImpuesto').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                }
            });
        }

        return false;
    });

</script>