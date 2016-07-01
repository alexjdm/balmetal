<?php
/**
 * Created by PhpStorm.
 * User: alexj
 * Date: 30-03-2016
 * Time: 0:32
 */
?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['nombre'].' '.$_SESSION['apellido']; ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENÚ</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="<?php if($controller=='Home'){ echo 'active'; } ?>"><a href="index.php?controller=Home&action=index"><i class="fa fa-area-chart"></i> <span>Inicio</span></a></li>

            <li class="treeview <?php if($controller=='Proveedores' || $controller=='Clientes'){ echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-list"></i> <span>Datos Comerciales</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu <?php if($controller=='Proveedores' || $controller=='Clientes'){ echo 'menu-open'; } ?>" style="display: <?php if($controller=='Proveedores' || $controller=='Clientes'){ echo 'block'; } else { echo 'none'; } ?>;">
                    <li class="<?php if($controller=='Proveedores' && $action=='proveedores'){ echo 'active'; } ?>"><a href="index.php?controller=Proveedores&action=proveedores"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                    <li class="<?php if($controller=='Clientes' && $action=='clientes'){ echo 'active'; } ?>"><a href="index.php?controller=Clientes&action=clientes"><i class="fa fa-circle-o"></i> Clientes</a></li>
                </ul>
            </li>

            <li class="treeview <?php if($controller=='Productos'){ echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-archive"></i> <span>Productos</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu <?php if($controller=='Productos'){ echo 'menu-open'; } ?>" style="display: <?php if($controller=='Productos'){ echo 'block'; } else { echo 'none'; } ?>;">
                    <li class="<?php if($controller=='Productos' && $action=='articulos'){ echo 'active'; } ?>"><a href="index.php?controller=Productos&action=articulos"><i class="fa fa-circle-o"></i> Artículos</a></li>
                    <li class="<?php if($controller=='Productos' && $action=='articulosSellos'){ echo 'active'; } ?>"><a href="index.php?controller=Productos&action=articulosSellos"><i class="fa fa-circle-o"></i> Artículos Sellos</a></li>
                    <li class="<?php if($controller=='Productos' && $action=='familias'){ echo 'active'; } ?>"><a href="index.php?controller=Productos&action=familias"><i class="fa fa-circle-o"></i> Familias</a></li>
                    <li class="<?php if($controller=='Productos' && $action=='modeloVehiculos'){ echo 'active'; } ?>"><a href="index.php?controller=Productos&action=modeloVehiculos"><i class="fa fa-circle-o"></i> Modelo de vehículos</a></li>
                    <li class="<?php if($controller=='Productos' && $action=='listaPrecioNV'){ echo 'active'; } ?>"><a href="index.php?controller=Productos&action=listaPrecioNV"><i class="fa fa-circle-o"></i> Lista de Precio NV</a></li>
                    <li class="<?php if($controller=='Productos' && $action=='sellosCunas'){ echo 'active'; } ?>"><a href="index.php?controller=Productos&action=sellosCunas"><i class="fa fa-circle-o"></i> Sellos Cuñas</a></li>
                    <li class="<?php if($controller=='Productos' && $action=='sellosLanzas'){ echo 'active'; } ?>"><a href="index.php?controller=Productos&action=sellosLanzas"><i class="fa fa-circle-o"></i> Sellos Lanzas</a></li>
                </ul>
            </li>

            <li class="treeview <?php if($controller=='Certificados'){ echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-file-text-o"></i> <span>Certificados</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu <?php if($controller=='Certificados'){ echo 'menu-open'; } ?>" style="display: <?php if($controller=='Certificados'){ echo 'block'; } else { echo 'none'; } ?>;">
                    <?php $asignacion = ($action=='asignacionBarras' || $action=='asignacionLunetas' || $action=='asignacionParachoques' || $action=='asignacionCunas'); ?>
                    <li class="<?php if($asignacion){ echo 'active'; } ?>">
                        <a href="#"><i class="fa fa-circle-o"></i> Asignación <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu <?php if($asignacion){ echo 'menu-open'; } ?>" style="display: <?php if($asignacion){ echo 'block'; } else { echo 'none'; } ?>;">
                            <li class="<?php if($action=='asignacionBarras'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=asignacionBarras"><i class="fa fa-circle-o"></i> Barras</a></li>
                            <li class="<?php if($action=='asignacionLunetas'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=asignacionLunetas"><i class="fa fa-circle-o"></i> Lunetas</a></li>
                            <li class="<?php if($action=='asignacionParachoques'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=asignacionParachoques"><i class="fa fa-circle-o"></i> Para Choques</a></li>
                            <li class="<?php if($action=='asignacionCunas'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=asignacionCunas"><i class="fa fa-circle-o"></i> Cuñas</a></li>
                        </ul>
                    </li>

                    <?php $reAsignacion = ($action=='reAsignacionBarras' || $action=='reAsignacionLunetas' || $action=='reAsignacionParachoques' || $action=='reAsignacionCunas'); ?>
                    <li class="<?php if($reAsignacion){ echo 'active'; } ?>">
                        <a href="#"><i class="fa fa-circle-o"></i> Re Asignación <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu <?php if($reAsignacion){ echo 'menu-open'; } ?>" style="display: <?php if($reAsignacion){ echo 'block'; } else { echo 'none'; } ?>;">
                            <li class="<?php if($action=='reAsignacionBarras'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=reAsignacionBarras"><i class="fa fa-circle-o"></i> Barras</a></li>
                            <li class="<?php if($action=='reAsignacionLunetas'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=reAsignacionLunetas"><i class="fa fa-circle-o"></i> Lunetas</a></li>
                            <li class="<?php if($action=='reAsignacionParachoques'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=reAsignacionParachoques"><i class="fa fa-circle-o"></i> Para Choques</a></li>
                            <li class="<?php if($action=='reAsignacionCunas'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=reAsignacionCunas"><i class="fa fa-circle-o"></i> Cuñas</a></li>
                        </ul>
                    </li>

                    <?php $sellos = ($action=='sellosBarras' || $action=='sellosLunetas' || $action=='sellosParachoques' || $action=='sellosCunas'); ?>
                    <li class="<?php if($sellos){ echo 'active'; } ?>">
                        <a href="#"><i class="fa fa-circle-o"></i> Sellos <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu <?php if($sellos){ echo 'menu-open'; } ?>" style="display: <?php if($sellos){ echo 'block'; } else { echo 'none'; } ?>;">
                            <li class="<?php if($action=='sellosBarras'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=sellosBarras"><i class="fa fa-circle-o"></i> Barras</a></li>
                            <li class="<?php if($action=='sellosLunetas'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=sellosLunetas"><i class="fa fa-circle-o"></i> Lunetas</a></li>
                            <li class="<?php if($action=='sellosParachoques'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=sellosParachoques"><i class="fa fa-circle-o"></i> Para Choques</a></li>
                            <li class="<?php if($action=='sellosCunas'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=sellosCunas"><i class="fa fa-circle-o"></i> Cuñas</a></li>
                        </ul>
                    </li>

                    <?php $certificados = ($action=='certificadosBarras' || $action=='certificadosLunetas' || $action=='certificadosParachoques' || $action=='certificadosCunas' || $action=='certificadosBarrasEspecial'); ?>
                    <li class="<?php if($certificados){ echo 'active'; } ?>">
                        <a href="#"><i class="fa fa-circle-o"></i> Certificados <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu <?php if($certificados){ echo 'menu-open'; } ?>" style="display: <?php if($certificados){ echo 'block'; } else { echo 'none'; } ?>;">
                            <li class="<?php if($action=='certificadosBarras'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=certificadosBarras"><i class="fa fa-circle-o"></i> Barras</a></li>
                            <li class="<?php if($action=='certificadosLunetas'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=certificadosLunetas"><i class="fa fa-circle-o"></i> Lunetas</a></li>
                            <li class="<?php if($action=='certificadosParachoques'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=certificadosParachoques"><i class="fa fa-circle-o"></i> Para Choques</a></li>
                            <li class="<?php if($action=='certificadosCunas'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=certificadosCunas"><i class="fa fa-circle-o"></i> Cuñas</a></li>
                            <li class="<?php if($action=='certificadosBarrasEspecial'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=certificadosBarrasEspecial"><i class="fa fa-circle-o"></i> Barras Especial</a></li>
                        </ul>
                    </li>

                    <?php $anulacion = ($action=='anulacionFolioBarras'); ?>
                    <li class="<?php if($anulacion){ echo 'active'; } ?>">
                        <a href="#"><i class="fa fa-circle-o"></i> Anulación Certificados <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu <?php if($anulacion){ echo 'menu-open'; } ?>" style="display: <?php if($anulacion){ echo 'block'; } else { echo 'none'; } ?>;">
                            <li class="<?php if($action=='anulacionFolioBarras'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=anulacionFolioBarras"><i class="fa fa-circle-o"></i> Folio Barras</a></li>
                        </ul>
                    </li>

                    <li class="<?php if($controller=='Certificados' && $action=='informeCertificados'){ echo 'active'; } ?>"><a href="index.php?controller=Certificados&action=informeCertificados"><i class="fa fa-circle-o"></i> Informe Certificados</a></li>
                </ul>
            </li>

            <li class="treeview <?php if($controller=='Mantenimiento'){ echo 'active'; } ?>">
                <a href="#">
                    <i class="fa fa-tasks"></i> <span>Mantenimiento</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu <?php if($controller=='Mantenimiento'){ echo 'menu-open'; } ?>" style="display: <?php if($controller=='Mantenimiento'){ echo 'block'; } else { echo 'none'; } ?>;">
                    <li class="<?php if($controller=='Mantenimiento' && $action=='impuestos'){ echo 'active'; } ?>"><a href="index.php?controller=Mantenimiento&action=impuestos"><i class="fa fa-circle-o"></i> Impuestos</a></li>
                    <li class="<?php if($controller=='Mantenimiento' && $action=='bancos'){ echo 'active'; } ?>"><a href="index.php?controller=Mantenimiento&action=bancos"><i class="fa fa-circle-o"></i> Entidades Bancarias</a></li>
                    <li class="<?php if($controller=='Mantenimiento' && $action=='ubicaciones'){ echo 'active'; } ?>"><a href="index.php?controller=Mantenimiento&action=ubicaciones"><i class="fa fa-circle-o"></i> Ubicaciones</a></li>
                    <li class="<?php if($controller=='Mantenimiento' && $action=='formasPago'){ echo 'active'; } ?>"><a href="index.php?controller=Mantenimiento&action=formasPago"><i class="fa fa-circle-o"></i> Formas de Pago</a></li>
                </ul>
            </li>

            <!--<li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Datos Comerciales</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="index.php?controller=Proveedores&action=index">Proveedores</a></li>
                    <li><a href="#">Clientes</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class="fa fa-link"></i> <span>Productos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Articulos</a></li>
                    <li><a href="#">Articulos Sellos</a></li>
                </ul>
            </li>-->
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>