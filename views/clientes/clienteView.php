<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px; height: 600px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ver Cliente</h4>
        </div>
        <div class="modal-body" style="max-height: 479px; overflow-y: auto;">
            <input id="idCliente" value="<?php echo $cliente['ID_CLIENTE'] ?>" type="hidden">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="nombre">Nombre</label>
                    <div class="col-sm-8">
                        <?php echo $cliente['NOMBRE'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="rut">Rut</label>
                    <div class="col-sm-8">
                        <?php echo $cliente['RUT'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="tipo">Region</label>
                    <div class="col-sm-8">
                        <?php foreach($regiones as $region): ?>
                            <?php if($cliente['ID_REGION'] == $region['ID_REGION']){ echo utf8_encode($region['NOMBRE_REGION']); } ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="direccion">Dirección</label>
                    <div class="col-sm-8">
                        <?php echo $cliente['DIRECCION'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="comuna">Comuna</label>
                    <div class="col-sm-8">
                        <?php echo $cliente['COMUNA'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="banco">Banco</label>
                    <div class="col-sm-8">
                        <?php foreach($bancos as $banco): ?>
                            <?php if($cliente['ID_BANCO'] == $banco['ID_BANCO']){ echo utf8_encode($banco['NOMBRE_BANCO']); } ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="cuentaBancaria">Cuenta Bancaria</label>
                    <div class="col-sm-8">
                        <?php echo $cliente['CUENTA_BANCARIA'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="codigoPostal">Código Postal</label>
                    <div class="col-sm-8">
                        <?php echo $cliente['CODIGO_POSTAL'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="telefono">Teléfono</label>
                    <div class="col-sm-8">
                        <?php echo $cliente['TELEFONO'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="movil">Móvil</label>
                    <div class="col-sm-8">
                        <?php echo $cliente['MOVIL'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="correo">Correo Electrónico</label>
                    <div class="col-sm-8">
                        <?php echo $cliente['CORREO_ELECTRONICO'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="sitioWeb">Sitio Web</label>
                    <div class="col-sm-8">
                        <?php echo $cliente['SITIO_WEB'] ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>