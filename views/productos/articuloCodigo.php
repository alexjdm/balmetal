<div class="modal-dialog" style="width:700px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Código de Barras del Artículo</h4>
        </div>
        <div class="modal-body" style="max-height: 600px; overflow-y: auto;">
            <input type="hidden" id="idArticulo" value="<?php echo $articulo['ID_ARTICULO'] ?>">

            <table style="padding: 20px;border: 2px solid #000; width:400px;" align="center">
                <tr>
                    <td style="padding: 20px 20px 10px 20px;font-size: 12px;" align="center">BALMETAL: <?php echo $articulo['DESCRIPCION'] ?></td>
                </tr>
                <tr>
                    <td style="padding: 10px 20px 20px 20px;" align="center"><img src="<?php echo $articulo['CODIGO_BARRA'] ?>" width="100%" /></td>
                </tr>
            </table>

            <!--<center>
                <div style="border: 2px solid #000; width:400px;">
                    <div style="padding: 20px 20px 10px 20px; ;font-size: 20px">
                        BALMETAL: MALO
                    </div>
                    <div style="padding: 10px 20px 20px 20px;">
                        <center>
                            <img src="<?php /*echo $articulo['CODIGO_BARRA'] */?>" width="100%" />
                        </center>
                    </div>
                </div>
            </center>-->
            <!--<img src="<?php echo $articulo['CODIGO_BARRA'] ?>" width="100%">-->
        </div>

        <div class="modal-footer">
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            <!--<a href="<?php echo $articulo['CODIGO_BARRA'] ?>" class="btn btn-primary descargar" download>Descargar</a>-->
            <a href="javascript:void(0);" class="btn btn-primary descargar">Descargar</a>
        </div>
    </div>
</div>

<script>
    $(function() {

        $(".descargar").click(function() {
            var id = $('#idArticulo').val(); console.debug(id);
            window.open(
                'helpers/blog_pdf/php/pdf/pdf_codigo_prev.php?idArticulo=' + id,
                '_blank'
            );
        });

    });
</script>

