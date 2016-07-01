<?php


class RegionesModel
{
    public function getRegionesList(){
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = $pdo->prepare("SELECT * FROM region");
        $sql->execute();

        return $sql->fetchAll();
    }
}