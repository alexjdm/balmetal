<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px; height: 600px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Nuevo Artículo</h4>
        </div>

        <form id="uploadForm" action="ajax.php?controller=Trading&action=createNewArticulo" method="post">

            <div class="modal-body" style="max-height: 479px; overflow-y: auto;">

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="codigo">Código de Golpe</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="codigo" type="text">
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
                        <input class="form-control" id="descripcion" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="idImpuesto">Impuesto</label>
                    <div class="col-sm-9">
                        <select id="idImpuesto" name="idImpuesto" class="form-control">
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
                        <input class="form-control" id="descripcionCorta" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="fechaAlta">Fecha de Alta</label>
                    <div class="col-sm-9">
                        <input type="text" id="fechaAlta" class="form-control" name="fechaAlta" />
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
                    <label class="col-sm-3 control-label" for="embalaje">Embalaje</label>
                    <div class="col-sm-9">
                        <select id="embalaje" name="embalaje" class="form-control">
                            <option id="1" selected>Todos los embalajes</option>
                            <option id="0">Ninguno</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="unidadesPorCaja">Unidades por caja</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="unidadesPorCaja" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="preguntarPrecioTicket">Preguntar precio ticket</label>
                    <div class="col-sm-9">
                        <select id="preguntarPrecioTicket" name="preguntarPrecioTicket" class="form-control">
                            <option id="0">No</option>
                            <option id="1">Si</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="editarDescripcionTicket">Editar descripción ticket</label>
                    <div class="col-sm-9">
                        <select id="editarDescripcionTicket" name="editarDescripcionTicket" class="form-control">
                            <option id="0">No</option>
                            <option id="1">Si</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="observaciones">Observaciones</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="observaciones" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="precioCompra">Precio de compra</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="precioCompra" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="precioInterno">Precio interno</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="precioInterno" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="precioVenta">Precio venta</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="precioVenta" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="precioIVA">Precio con IVA</label>
                    <div class="col-sm-9">
                        <input class="form-control" id="precioIVA" type="text">
                    </div>
                </div>
                <div class="form-group" style="display: block;">
                    <label class="col-sm-3 control-label" for="imagenArticulo">Imagen [Formato jpg] [200x200]</label>
                    <div class="col-sm-9">
                        <input id="imagenArticulo" name="imagenArticulo" class="form-control" type="file">
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <div id="messageNewArticulo" style="float:left; width: 400px;"></div>
                <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button id="saveArticuloNew" type="submit" class="btn btn-primary">Guardar</button>
            </div>

        </form>

    </div>
</div>

<script type="application/javascript">

    $("#fechaAlta").daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
        format: 'DD-MM-YYYY',
        locale: {
            //format: 'DD-MM-YYYY',
            applyLabel: 'Aceptar',
            fromLabel: 'Desde',
            toLabel: 'Hasta',
            customRangeLabel: 'Rango Personalizado',
            daysOfWeek: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi','Sa'],
            monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            firstDay: 1
        }
    });

    $("#uploadForm").on('submit',(function(e) {
        e.preventDefault();

        var url1 = 'ajax.php?controller=Productos&action=createNewArticulo'; console.debug(url1);

        var formData = new FormData();
        formData.append('codigo', $('#codigo').val());
        formData.append('idFamilia', $("#familia").children(":selected").attr("id"));
        formData.append('descripcion', $('#descripcion').val());
        formData.append('idImpuesto', $("#idImpuesto").children(":selected").attr("id"));
        formData.append('proveedor1', $("#proveedor1").children(":selected").attr("id"));
        formData.append('proveedor2', $("#proveedor2").children(":selected").attr("id"));
        formData.append('descripcionCorta', $('#descripcionCorta').val());
        formData.append('ubicacion', $("#ubicacion").children(":selected").attr("id"));
        formData.append('stock', $('#stock').val());
        formData.append('stockMin', $('#stockMin').val());
        formData.append('avisoStockMin', $("#avisoStockMin").children(":selected").attr("id"));
        formData.append('datosProducto', $('#datosProducto').val());
        formData.append('fechaAlta', $('#fechaAlta').val());
        formData.append('embalaje', $("#embalaje").children(":selected").attr("id"));
        formData.append('unidadesPorCaja', $('#unidadesPorCaja').val());
        formData.append('preguntarPrecioTicket', $("#preguntarPrecioTicket").children(":selected").attr("id"));
        formData.append('editarDescripcionTicket', $("#editarDescripcionTicket").children(":selected").attr("id"));
        formData.append('observaciones', $('#observaciones').val());
        formData.append('precioCompra', $('#precioCompra').val());
        formData.append('precioInterno', $('#precioInterno').val());
        formData.append('precioVenta', $('#precioVenta').val());
        formData.append('precioIVA', $('#precioIVA').val());
        formData.append('imagenArticulo', $('#imagenArticulo')[0].files[0]);

        if($('#codigo').val() == '' || $('#descripcion').val() == '')
        {
            $('#messageNewArticulo').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong> Debes llenar al menos el código y la descripción.</div>');
        }
        else
        {
            $.ajax({
                type: 'POST',
                url: url1,
                data:  formData,
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('#saveArticuloNew').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    var data = JSON.parse(data); console.debug(data);
                    if(data.status == "success"){
                        $('#messageNewArticulo').html('<div class="alert alert-success" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveArticuloNew').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        window.location.href = "index.php?controller=Productos&action=articulos";
                    }
                    else{
                        $('#saveArticuloNew').html("Guardar");
                        $('#messageNewArticulo').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveArticuloNew').html("Guardar");
                    $('#messageNewArticulo').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                }
            });
        }

        return false;

    }));

    $("#cleanDataArticuloBtn").click(function() {
        $(this).closest('form').find("input[type=text], textarea").val("");
        return false;
    });

</script>