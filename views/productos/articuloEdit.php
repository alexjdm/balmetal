<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Articulo</h4>
        </div>
        <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
            <input id="idArticulo" value="<?php echo $articulo['ID_ARTICULO'] ?>" type="hidden">

            <div class="form-group">
                <label class="col-sm-3 control-label" for="codigo">Código</label>
                <div class="col-sm-9">
                    <input class="form-control" id="codigo" type="text" value="<?php echo $articulo['CODIGO'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="familia">Familia</label>
                <div class="col-sm-9">
                    <select id="familia" name="familia" class="form-control">
                        <?php foreach($familias as $familia): ?>
                            <option id="<?php echo $familia['ID_FAMILIA'] ?>"><?php echo $familia['NOMBRE_FAMILIA'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="descripcion">Descripción</label>
                <div class="col-sm-9">
                    <input class="form-control" id="descripcion" type="text"  value="<?php echo $articulo['DESCRIPCION'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="impuesto">Impuesto</label>
                <div class="col-sm-9">
                    <select id="impuesto" name="impuesto" class="form-control">
                        <?php foreach($impuestos as $impuesto): ?>
                            <option id="<?php echo $impuesto['ID_IMPUESTO'] ?>"><?php echo $impuesto['VALOR_IMPUESTO'] . " %" ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="proveedor1">Proveedor 1</label>
                <div class="col-sm-9">
                    <select id="proveedor1" name="proveedor1" class="form-control">
                        <option id="0">Ninguno</option>
                        <?php foreach($proveedores as $proveedor): ?>
                            <option id="<?php echo $proveedor['ID_PROVEEDOR'] ?>"><?php echo $proveedor['NOMBRE'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="proveedor2">Proveedor 2</label>
                <div class="col-sm-9">
                    <select id="proveedor2" name="proveedor2" class="form-control">
                        <option id="0">Ninguno</option>
                        <?php foreach($proveedores as $proveedor): ?>
                            <option id="<?php echo $proveedor['ID_PROVEEDOR'] ?>"><?php echo $proveedor['NOMBRE'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="descripcionCorta">Descripción Corta</label>
                <div class="col-sm-9">
                    <input class="form-control" id="descripcionCorta" type="text"  value="<?php echo $articulo['DESCRIPCION_CORTA'] ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="ubicacion">Ubicación</label>
                <div class="col-sm-9">
                    <select id="ubicacion" name="ubicacion" class="form-control">
                        <option id="0">Ninguno</option>
                        <?php foreach($ubicaciones as $ubicacion): ?>
                            <option id="<?php echo $ubicacion['ID_UBICACION'] ?>"><?php echo $ubicacion['NOMBRE_UBICACION'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="stock">Stock</label>
                <div class="col-sm-9">
                    <input class="form-control" id="stock" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="stockMin">Stock Mínimo</label>
                <div class="col-sm-9">
                    <input class="form-control" id="stockMin" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="avisoStockMin">Aviso Stock Mínimo</label>
                <div class="col-sm-9">
                    <select id="avisoStockMin" name="avisoStockMin" class="form-control">
                        <option id="0">No</option>
                        <option id="1">Si</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="datosProducto">Datos del producto</label>
                <div class="col-sm-9">
                    <input class="form-control" id="datosProducto" type="text">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="fechaAlta">Fecha de Alta</label>
                <div class="col-sm-9">
                    <input type="text" id="fechaAlta" class="form-control" name="fechaAlta" />
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <div id="messageEditArticulo" style="float:left; width: 400px;"></div>
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="saveArticuloEdit" type="button" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</div>

<script type="application/javascript">

    $('#saveArticuloEdit').click(function(){
        var e = 'ajax.php?controller=Productos&action=editArticulo'; console.debug(e);
        var idArticulo = $("#idArticulo").val(); console.debug(idArticulo);
        var codigo = $("#codigo").val(); console.debug(codigo);
        var idArticulo = $("#familia").val(); console.debug(idArticulo);
        var descripcion = $("#descripcion").val(); console.debug(descripcion);
        var idImpuesto = $("#impuesto").val(); console.debug(idImpuesto);
        var proveedor1 = $("#proveedor1").val(); console.debug(proveedor1);
        var proveedor2 = $("#proveedor2").val(); console.debug(proveedor2);
        var descripcionCorta = $("#descripcionCorta").val(); console.debug(descripcionCorta);
        var ubicacion = $("#ubicacion").val(); console.debug(ubicacion);
        var stock = $("#stock").val(); console.debug(stock);
        var stockMin = $("#stockMin").val(); console.debug(stockMin);
        var AvisoStockMin = $("#AvisoStockMin").val(); console.debug(AvisoStockMin);
        var datosProducto = $("#datosProducto").val(); console.debug(datosProducto);
        var fechaAlta = $("#fechaAlta").val(); console.debug(fechaAlta);

        if(codigo == '' || descripcion == '')
        {
            $('#messageEditArticulo').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong> Debes llenar todos los campos.</div>');
        }
        else
        {
            $.ajax({
                type: 'GET',
                url: e,
                data: { idArticulo: idArticulo, codigo: codigo, idFamilia: idFamilia, descripcion: descripcion, idImpuesto: idImpuesto,
                    proveedor1: proveedor1, proveedor2: proveedor2, descripcionCorta: descripcionCorta, ubicacion: ubicacion, stock: stock,
                    stockMin: stockMin, AvisoStockMin: AvisoStockMin, datosProducto: datosProducto, fechaAlta: fechaAlta
                },
                dataType : "json",
                beforeSend: function () {
                    $('#saveArticuloEdit').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageEditArticulo').html('<div class="alert alert-success" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveArticuloEdit').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        window.location.href = "index.php?controller=Productos&action=articulos";
                    }
                    else{
                        $('#saveArticuloEdit').html("Guardar");
                        $('#messageEditArticulo').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveArticuloEdit').html("Guardar");
                    $('#messageEditArticulo').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                }
            });
        }

        return false;
    });

</script>