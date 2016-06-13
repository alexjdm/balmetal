<?php
/**
 * Created by PhpStorm.
 * User: alexj
 * Date: 28-03-2016
 * Time: 22:37
 */

    //Inicio de variables de sesión
    if (!isset($_SESSION)) {
        @session_start();
    }
    //Validar si se está ingresando con sesión correctamente
    if (!$_SESSION){
        echo '<script language = javascript>
                alert("Usuario no autenticado, por favor ingrese sus credenciales.")
                self.location = "index.php"
            </script>';
    }
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        BalMetal
        <small>Inicio</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-file-text-o"></i> Certificados</a></li>
        <li class="active">Sellos de Barras</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Buscar Barras</h3>
            <!-- form start -->
            <form class="form-horizontal">
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="codigoArticulo">Código Artículo</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="codigoArticulo" type="text" placeholder="Código de Artículo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="familia">Familia</label>
                        <div class="col-sm-10">
                            <select id="familia" name="familia" class="form-control">
                                <?php foreach($familias as $familia): ?>
                                    <option id="<?php echo $familia['ID_FAMILIA'] ?>"><?php echo $familia['NOMBRE_FAMILIA'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="numeroBarra">Número de Barra</label>
                        <div class="col-sm-10">
                            <input class="form-control" id="numeroBarra" type="text" placeholder="Número de Barra">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="proveedor">Proveedor</label>
                        <div class="col-sm-10">
                            <select id="proveedor" name="proveedor" class="form-control">
                                <?php foreach($proveedores as $proveedor): ?>
                                    <option id="<?php echo $proveedor['ID_PROVEEDOR'] ?>"><?php echo $ubicacion['NOMBRE_PROVEEDOR'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="ubicacion">Ubicación</label>
                        <div class="col-sm-10">
                            <select id="ubicacion" name="ubicacion" class="form-control">
                                <?php foreach($ubicaciones as $ubicacion): ?>
                                    <option id="<?php echo $ubicacion['ID_UBICACION'] ?>"><?php echo $proveedor['NOMBRE_UBICACION'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div id="messageSearchSellosBarras" style="margin: 20px;"></div>

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button id="cleanDataBtn" class="btn btn-default" type="submit">Limpiar</button>
                    <button id="searchBtn" class="btn btn-success pull-right" type="submit">Buscar</button>
                    <button id="newBtn" class="btn btn-info pull-right" type="submit"><i class="fa fa-plus-square" aria-hidden="true"></i> Nuevo</button>
                    <button id="printBtn" class="btn btn-success pull-right" type="submit">Imprimir</button>
                </div><!-- /.box-footer -->
            </form>
        </div><!-- /.box-header -->
    </div>

    <div id="messageVenta"></div>

    <!-- Default box -->
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Ventas</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <table id="tablaVentas" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>N°</th>
                    <th>Sello</th>
                    <th>Código</th>
                    <th>Familia</th>
                    <th>Producto</th>
                    <th>Otros</th>
                    <th></th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                <?php $n = 1; ?>
                <?php foreach ($articulos as $articulo): ?>
                    <tr data-id="<?php echo $articulo['ID_ARTICULO'] ?>">
                        <th><?php echo $n ?></th>
                        <td><?php echo $articulo['SELLO'] ?></td>
                        <td><?php echo $articulo['CODIGO'] ?></td>
                        <td><?php
                            foreach($familias as $familia):
                                if($familia['ID_FAMILIA'] == $articulo['ID_FAMILIA']){
                                    echo $familia['NOMBRE_FAMILIA'];
                                    break;
                                }
                            endforeach;
                            ?>
                        </td>
                        <td><?php
                            foreach($productos as $producto):
                                if($producto['ID_PRODUCTO'] == $articulo['ID_PRODUCTO']){
                                    echo $producto['NOMBRE_PRODUCTO'];
                                    break;
                                }
                            endforeach;
                            ?>
                        </td>
                        <td><?php echo $articulo['NUMERO'] ?></td>
                        <td>
                            <button data-original-title="Imprimir" class="btn btn-xs btn-default print">
                                <i class="fa fa-print"></i>
                            </button>
                            &nbsp
                            <button data-original-title="Editar Artículo" class="btn btn-xs btn-default editarArticulo">
                                <i class="fa fa-pencil-square-o"></i>
                            </button>
                            &nbsp
                            <button data-original-title="Editar Barra" class="btn btn-xs btn-default editarBarra">
                                <i class="fa fa-pencil"></i>
                            </button>
                            &nbsp
                            <button data-original-title="Visualizar" class="btn btn-xs btn-default deleteVenta">
                                <i class="fa fa-eye"></i>
                            </button>
                        </td>
                    </tr>
                    <?php $n++; ?>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>N°</th>
                    <th>Sello</th>
                    <th>Código</th>
                    <th>Familia</th>
                    <th>Producto</th>
                    <th>Otros</th>
                    <th></th>
                    <th>Opciones</th>
                </tr>
                </tfoot>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->

</section><!-- /.content -->
