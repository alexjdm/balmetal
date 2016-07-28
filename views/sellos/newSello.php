<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px; height: 600px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Nuevo Sello</h4>
        </div>
        <div class="modal-body" style="max-height: 479px; overflow-y: auto;">

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
                <label class="col-sm-3 control-label" for="articulo">Artículo</label>
                <div class="col-sm-9">
                    <select id="articulo" name="articulo" class="form-control">
                        <?php foreach($articulos as $articulo): ?>
                            <?php if($articulo['ID_FAMILIA'] == $familias[0]['ID_FAMILIA']) { ?>
                                <option id="<?php echo $articulo['ID_ARTICULO'] ?>"><?php echo utf8_encode($articulo['DESCRIPCION']) ?></option>
                            <?php } ?>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label" for="auto">Automóvil</label>
                <div class="col-sm-9">
                    <select id="auto" name="auto" class="form-control">
                        <?php foreach($autos as $auto): ?>
                            <option id="<?php echo $auto['ID_AUTO'] ?>"><?php echo $auto['MARCA_AUTO'] . " - " . $auto['MODELO_AUTO'] ?></option>
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
            <div id="messageNewSello"></div>
        </div>

        <div class="modal-footer">
            <div id="messageNewSello" style="float:left; width: 400px;"></div>
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <button id="saveSelloNew" type="button" class="btn btn-primary">Crear</button>
        </div>
    </div>
</div>

<script type="application/javascript">

    $('#familia').on('change', function() {
        console.debug(this.value);
        var e = 'ajax.php?controller=Productos&action=getArticulos'; console.debug(e);
        var id = $(this).children(":selected").attr("id");

        var articulosFromPHP = <?php echo json_encode($articulos) ?>; console.debug(articulosFromPHP);
        var items = [];
        $.each(articulosFromPHP, function(index, item)
        {
            if(item.ID_FAMILIA == id)
                items+="<option id='"+item.ID_ARTICULO+"'>"+item.DESCRIPCION+"</option>";
        });
        console.debug(items);
        $('#articulo').html(items);

    });

    $('#saveSelloNew').click(function(){
        var e = 'ajax.php?controller=Sellos&action=createSello'; console.debug(e);
        var idArticulo = $("#articulo").children(":selected").attr("id");
        var idAuto = $("#auto").children(":selected").attr("id");
        var chasis = $("#chasis").val();
        var patente = $("#patente").val();
        var cantidad = $("#cantidad").val();

        if(idArticulo == '' || cantidad == '' || chasis == '' || patente == '')
        {
            $('#messageNewSello').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong> Debes llenar todos los campos</div>');
        }
        else
        {
            $.ajax({
                type: 'GET',
                url: e,
                data: { idArticulo: idArticulo, idAuto: idAuto, chasis: chasis, patente: patente, cantidad: cantidad },
                dataType : "json",
                beforeSend: function () {
                    $('#saveSelloNew').html("Cargando...");
                },
                success: function (data) {
                    console.debug("success");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    if(data.status == "success"){
                        $('#messageNewSello').html('<div class="alert alert-success" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Listo! </strong>' + data.message + '</div>');
                        $('#saveSelloNew').html('<i class="fa fa-check" aria-hidden="true"></i> Listo');
                        $('#modalPrincipal').hide();
                        window.location.href = "index.php?controller=Sellos&action=sellos";
                    }
                    else {
                        $('#saveSelloNew').html("Crear");
                        $('#messageNewSello').html('<div class="alert alert-danger" role="alert" style="text-align: left!important;margin: 0!important;padding: 5px!important;"><strong>Error! </strong>' + data.message + '</div>');
                    }
                },
                error: function (data) {
                    console.debug("error");
                    console.debug(data);
                    //var returnedData = JSON.parse(data); console.debug(returnedData);
                    $('#saveSelloNew').html("Crear");
                    $('#messageNewSello').html('<div class="alert alert-danger" role="alert"><strong>Error! </strong>' + data.message + '</div>');
                }
            });
        }

        return false;
    });

</script>