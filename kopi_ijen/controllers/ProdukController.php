<?php
require_once dirname(__DIR__) . "/config/Database.php";
require_once dirname(__DIR__) . "/models/Produk.php";

class ProdukController {
    public Produk $model;

    public function __construct() {
        $database = new Database();
        $db = $database->connect();
        $this->model = new Produk($db);
    }
}
?>
