<?php
class HomeController {
    public function index() {
        $first_name = 'Jon';
        $last_name  = 'Snow';
        require_once('views/home/index.php');
    }

    public function error() {
        require_once('views/error/error.php');
    }
}
?>