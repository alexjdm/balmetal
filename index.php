<?php
  require_once('connections/db.php');

  if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action     = $_GET['action'];
  } else {
    //$controller = 'Home';
    //$action     = 'index';
    $controller = 'Account';
    $action     = 'login';
  }

  if($controller == 'Account' && $action == 'login')
  {
    require_once('views/layoutLogin.php');
  }
  else if($controller == 'Account' && $action == 'validation')
  {
    require_once('views/routes.php');
  }
  else
  {
    require_once('views/layout.php');
  }

?>