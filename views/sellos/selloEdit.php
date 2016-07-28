<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px; height: 600px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Sello</h4>
        </div>
        <div class="modal-body" style="max-height: 479px; overflow-y: auto;">
            <input id="idSello" value="<?php echo $sello['ID_SELLO'] ?>" type="hidden">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="sello">Sello</label>
                <div class="col-sm-9">
                    <input class="form-control" id="sello" type="text" value="<?php echo $sello['SELLO'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="articulo">Artículo</label>
                <div class="col-sm-9">
                    <select id="articulo" name="articulo" class="form-control">
                        <?php foreach($articulos as $articulo): ?>
                            <option id="<?php echo $articulo['ID_ARTICULO'] ?>" <?php if($sello['ID_ARTICULO'] == $articulo['ID_ARTICULO']){ echo "selected";  } ?>><?php echo utf8_encode($articulo['NOMBRE_ARTICULO']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <br>
            <div id="messageEditSello"></div>
        </div>

        <div class="modal-footer">
            <div id="messageEditSello" style="float:left; width: 400px;"></div>
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="saveSelloEdit" type="button" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</div>

<script type="application/javascript">

    $('#saveSelloEdit').click(function(){
        var e = 'ajax.php?controller=Sellos&action=editSello'; console.debug(e);
        var idSello = $("#idSello").val();
        var sello = $("#sello").val();
        var articulo = $("#articulo").val();

        if(sello == '' || articulo == '')
        {
            $('#messageEditSello').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong> Debes llenar todos los campos</div>');
        }
        else
        {
            $.ajax({
                type: 'GET',
                url: e,
                data: { idSello: idSello, sello: sello, idArticulo: articulo },
                dataType : "json",
                beforeSend: function () {
                    $('#saveSelloEdit').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageEditSello').html('<div class="alert alert-success" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveSelloEdit').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        window.location.href = "index.php?controller=Sellos&action=selloes";
                    }
                    else {
                        $('#saveSelloEdit').html("Guardar");
                        $('#messageEditSello').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveSelloEdit').html("Guardar");
                    $('#messageEditSello').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                }
            });
        }

        return false;
    });

</script>