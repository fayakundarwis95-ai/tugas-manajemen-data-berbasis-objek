<?php
require_once "controllers/ProdukController.php";
$controller = new ProdukController();

if (isset($_GET['hapus'])) {
    $id = (int)$_GET['hapus'];
    $controller->model->delete($id);
    header("Location: index.php?msg=hapus");
    exit;
}

require_once "views/list.php";
?>
