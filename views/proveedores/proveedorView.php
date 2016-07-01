<style>
    .form-group{
        padding: 15px;
    }
</style>

<div class="modal-dialog" style="width:700px; height: 600px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ver Proveedor</h4>
        </div>
        <div class="modal-body" style="max-height: 479px; overflow-y: auto;">
            <input id="idProveedor" value="<?php echo $proveedor['ID_PROVEEDOR'] ?>" type="hidden">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="nombre">Nombre</label>
                    <div class="col-sm-8">
                        <?php echo $proveedor['NOMBRE'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="rut">Rut</label>
                    <div class="col-sm-8">
                        <?php echo $proveedor['RUT'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="tipo">Tipo</label>
                    <div class="col-sm-8">
                        <?php
                            if($proveedor['TIPO_PROVEEDOR'] == '0'){ echo "Todos los estados";  }
                            else if($proveedor['TIPO_PROVEEDOR'] == '1'){ echo "Vendedor";  }
                            else if($proveedor['TIPO_PROVEEDOR'] == '2'){ echo "Trabajador";  }
                            else if($proveedor['TIPO_PROVEEDOR'] == '3'){ echo "Instalador";  }
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="direccion">Dirección</label>
                    <div class="col-sm-8">
                        <?php echo $proveedor['DIRECCION'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="region">Región</label>
                    <div class="col-sm-8">
                        <?php foreach($regiones as $region): ?>
                            <?php if($proveedor['ID_REGION'] == $region['ID_REGION']){ echo utf8_encode($region['NOMBRE_REGION']); } ?>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="comuna">Comuna</label>
                    <div class="col-sm-8">
                        <?php echo $proveedor['COMUNA'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="banco">Banco</label>
                    <div class="col-sm-8">
                        <?php foreach($bancos as $banco): ?>
                            <?php if($proveedor['ID_BANCO'] == $banco['ID_BANCO']){ echo utf8_encode($banco['NOMBRE_BANCO']); } ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="cuentaBancaria">Cuenta Bancaria</label>
                    <div class="col-sm-8">
                        <?php echo $proveedor['CUENTA_BANCARIA'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="codigoPostal">Código Postal</label>
                    <div class="col-sm-8">
                        <?php echo $proveedor['CODIGO_POSTAL'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="telefono">Teléfono</label>
                    <div class="col-sm-8">
                        <?php echo $proveedor['TELEFONO'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="movil">Móvil</label>
                    <div class="col-sm-8">
                        <?php echo $proveedor['MOVIL'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="correo">Correo Electrónico</label>
                    <div class="col-sm-8">
                        <?php echo $proveedor['CORREO_ELECTRONICO'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="sitioWeb">Sitio Web</label>
                    <div class="col-sm-8">
                        <?php echo $proveedor['SITIO_WEB'] ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>