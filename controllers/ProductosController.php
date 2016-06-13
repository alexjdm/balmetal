<?php
/*Incluimos el fichero de la clase*/
require_once 'connections/db.php';
require_once 'helpers/CommonHelper.php';
require_once 'models/ProductosModel.php';

class ProductosController {

    public $modelP;

    public function __construct()
    {
        $this-> modelP = new ProductosModel();
    }

    //************** FAMILIA *********************
    public function familias(){
        $familias = $this->modelP->getFamiliasList();
        require_once('views/productos/familias.php');
    }

    public function createNewFamilia() {
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelP->newFamilia($codigo, $nombre);
    }

    public function familiaEdit() {
        $idFamilia = isset($_GET['idFamilia']) ? $_GET['idFamilia'] : null;
        $familia = $this->modelP->getFamilia($idFamilia);
        require_once('views/productos/familiaEdit.php');
    }

    //Guardar en BD los datos del usuario
    public function editFamilia() {
        $idFamilia = isset($_GET['idFamilia']) ? $_GET['idFamilia'] : null;
        $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : null;
        $nombre = isset($_GET['nombre']) ? $_GET['nombre'] : null;

        return $this->modelP->editFamilia($idFamilia, $codigo, $nombre);
    }

    public function deleteFamilia() {
        $idFamilia = isset($_GET['idFamilia']) ? $_GET['idFamilia'] : null;

        return $this->modelP->deleteFamilia($idFamilia);
    }

    public function error() {
        require_once('views/error/error.php');
    }

}
?>