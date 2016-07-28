<?php
function call($controller, $action) {
    // require the file that matches the controller name
    require_once('controllers/' . $controller . 'Controller.php');

    // create a new instance of the needed controller
    switch($controller) {
        case 'Account':
            $controller = new AccountController();
            break;
        case 'Home':
            $controller = new HomeController();
            break;
        case 'Proveedores':
            $controller = new ProveedoresController();
            break;
        case 'Clientes':
            $controller = new ClientesController();
            break;
        case 'Productos':
            $controller = new ProductosController();
            break;
        case 'Certificados':
            $controller = new CertificadosController();
            break;
        case 'Sellos':
            $controller = new SellosController();
            break;
        case 'Mantenimiento':
            $controller = new MantenimientoController();
            break;
    }

    // call the action
    $controller->{ $action }();
}

// just a list of the controllers we have and their actions
// we consider those "allowed" values
$controllers = array(
    'Account' => ['login', 'logout', 'validation', 'error'],
    'Home' => ['index', 'error'],
    'Clientes' => ['clientes', 'newCliente', 'createNewCliente', 'clienteEdit', 'editCliente', 'clienteView', 'deleteCliente',
        'error'],
    'Proveedores' => ['proveedores', 'newProveedor', 'createNewProveedor', 'proveedorEdit', 'editProveedor', 'proveedorView', 'deleteProveedor',
        'error'],
    'Productos' => ['familias', 'createNewFamilia', 'familiaEdit', 'editFamilia', 'deleteFamilia',
        'articulos', 'newArticulo', 'createNewArticulo', 'articuloEdit', 'editArticulo', 'articuloCodigo', 'codigoArticulo',
        'asignarSelloArticulo', 'articuloAsignarSello', 'deleteArticulo', 'getArticulos', 'error'],
    'Certificados' => ['asignacionBarras', 'sellosBarras', 'error'],
    'Sellos' => ['sellos', 'sellosEdit', 'editSellos', 'deleteSellos', 'selloView', 'imprimirSello', 'versionImprimir',
        'newSello', 'createSello', 'newCertificado',
        'error'],
    'Mantenimiento' => ['impuestos', 'createNewImpuesto', 'impuestoEdit', 'editImpuesto', 'deleteImpuesto',
        'bancos', 'createNewBanco', 'bancoEdit', 'editBanco', 'deleteBanco',
        'ubicaciones', 'createNewUbicacion', 'ubicacionEdit', 'editUbicacion', 'deleteUbicacion',
        'formasPago', 'createNewFormaPago', 'formaPagoEdit', 'editFormaPago', 'deleteFormaPago',
        'autos', 'createNewAuto', 'autoEdit', 'editAuto', 'deleteAuto',
        'error']
);

// check that the requested controller and action are both allowed
// if someone tries to access something else he will be redirected to the error action of the home controller
if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
        call($controller, $action);
    } else {
        call('Home', 'error');
    }
} else {
    call('Home', 'error');
}
?>