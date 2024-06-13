<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . '/controllers/OrderController.php';

$controller = null;

if (isset($_GET['action']) && $_GET['action'] === 'orders') {
    $controller = new OrderController();
    $controller->showOrdersByMonth();
}
?>