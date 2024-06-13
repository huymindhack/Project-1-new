<?php
require_once __DIR__ . '/../model/Order.php';

class OrderController
{
    private $orderModel;

    public function __construct()
    {
        $this->orderModel = new Order();

    }

    public function showOrdersByMonth()
    {
        $ordersByMonth = $this->orderModel->getOrdersByMonth();
        require_once __DIR__ . '/order_chart.php';
    }
}