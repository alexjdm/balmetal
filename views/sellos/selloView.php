<style>

    .tableline {
        border: 6px solid #000000;
    }

    table {
        background-color: #fff;
        font: 12px Arial,Helvetica,sans-serif,Verdana;
    }
    .col-centered{
        float: none;
        margin: 0 auto;
    }

</style>

<div class="modal-dialog" style="width:950px; height: 600px;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ver Sello</h4>
        </div>
        <div class="modal-body" style="max-height: 479px; overflow-y: auto;">

            <table class="tableline" align="center" style="width: 917px; margin-top: 8px;">
                <tr style="width: 100%;">
                    <td style="width: 35%; padding: 15px 10px;">
                        <img src="dist/img/cesmec.png" width="400">
                    </td>
                    <td style="width: 30%; padding: 10px; padding-top: 35px; padding-left: 0px;">
                        <p style="font-size: 25px; font-weight: bold;">
                            EMPRESA: <br>
                            BALMETAL S.A.<br><br>
                            SELLO N: <br>
                            <?php echo $sello['SELLO'] ?></p>
                    </td>
                    <td style="width: 35%;">
                        <img src="dist/img/balmetal.png" width="225">
                    </td>
                </tr>
                <tr style="width: 100%;">
                    <td colspan="3" style="padding: 20px;" align="center">
                        <img src="dist/img/barcode.png">
                    </td>
                </tr>
            </table>

        </div>

        <div class="modal-footer">
            <button type="button" id="cerrarPrincipal" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>