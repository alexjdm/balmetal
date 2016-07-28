<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Asignar Sellos al Artículo</h4>
        </div>
        <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
            <input type="hidden" id="idArticulo" value="<?php echo $articulo['ID_ARTICULO'] ?>">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="codigo">Código</label>
                <div class="col-sm-9">
                    <?php echo $articulo['CODIGO_ARTICULO'] ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="familia">Familia</label>
                <div class="col-sm-9">
                    <?php foreach($familias as $familia): ?>
                        <?php echo $familia['NOMBRE_FAMILIA'] ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="descripcion">Artículo</label>
                <div class="col-sm-9">
                    <?php echo $articulo['DESCRIPCION'] ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="auto">Automóvil</label>
                <div class="col-sm-9">
                    <select id="auto" name="auto" class="form-control">
                        <?php foreach($autos as $auto): ?>
                            <option id="<?php echo $auto['ID_AUTO'] ?>"><?php echo utf8_encode($auto['MARCA_AUTO']) . " - " . utf8_encode($auto['MODELO_AUTO'])  ?></option>
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
                <label class="col-sm-3 control-label" for="cantidad">Cantidad</label>
                <div class="col-sm-9">
                    <input class="form-control" id="cantidad" type="text" placeholder="Ingrese la cantidad de sellos">
                </div>
            </div>

            <br>
            <div id="messageAsignarSello"></div>
        </div>

        <div class="modal-footer">
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="saveArticuloEdit" type="button" class="btn btn-primary">Crear</button>
        </div>
    </div>
</div>

<script type="application/javascript">

    $('#saveArticuloEdit').click(function(){
        var e = 'ajax.php?controller=Productos&action=articuloAsignarSello'; console.debug(e);
        var idArticulo = $("#idArticulo").val();
        var idAuto = $("#auto").children(":selected").attr("id");
        var chasis = $("#chasis").val();
        var patente = $("#patente").val();
        var cantidad = $("#cantidad").val();

        if(cantidad == '' || chasis == '' || patente == '')
        {
            $('#messageAsignarSello').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong> Debes llenar todos los campos.</div>');
        }
        else
        {
            $.ajax({
                type: 'GET',
                url: e,
                data: { idArticulo: idArticulo, idAuto: idAuto, chasis: chasis, patente: patente, cantidad: cantidad },
                dataType : "json",
                beforeSend: function () {
                    $('#saveArticuloEdit').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageAsignarSello').html('<div class="alert alert-success" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveArticuloEdit').html('Crear');
                        //$('#modalPrincipal').hide();
                        //window.location.href = "index.php?controller=Productos&action=articulos";
                    }
                    else{
                        $('#saveArticuloEdit').html("Crear");
                        $('#messageAsignarSello').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveArticuloEdit').html("Crear");
                    $('#messageAsignarSello').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                }
            });
        }

        return false;
    });

</script>