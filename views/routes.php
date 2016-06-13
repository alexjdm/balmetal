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
        case 'Productos':
            $controller = new ProductosController();
            break;
        case 'Certificados':
            $controller = new CertificadosController();
            break;
        case 'Proveedores':
            $controller = new ProveedoresController();
            break;
    }

    // call the action
    $controller->{ $action }();
}

// just a list of the controllers we have and their actions
// we consider those "allowed" values
$controllers = array(
    'Account' => ['login', 'validation', 'error'],
    'Home' => ['index', 'error'],
    'Productos' => ['familias', 'createNewFamilia', 'familiaEdit', 'editFamilia', 'deleteFamilia', 'error'],
    'Certificados' => ['asignacionBarras', 'sellosBarras', 'error'],
    'Proveedores' => ['index', 'error']
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