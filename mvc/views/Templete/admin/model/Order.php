<?php

require_once __DIR__ . '/../config/db.php';

class Order
{
    private $pdo;

    public function __construct()
    {
        global $pdo;
        $this->pdo = $pdo;
    }
    public function getOrdersByMonth()
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                DATE_FORMAT(order_date, '%Y-%m') AS month,
                SUM(order_details.price * order_details.quantity) AS total_revenue
            FROM orders
            JOIN order_details ON orders.id = order_details.order_id
            GROUP BY DATE_FORMAT(order_date, '%Y-%m')
            ORDER BY DATE_FORMAT(order_date, '%Y-%m')
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}