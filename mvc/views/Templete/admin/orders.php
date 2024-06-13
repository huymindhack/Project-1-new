<?php
include 'header.php';

// Truy vấn dữ liệu từ bảng orders, order_details và products
$sql = "
    SELECT o.customer_name, p.p_name AS product_name, od.quantity, o.total_price
    FROM orders o
    JOIN order_details od ON o.id = od.order_id
    JOIN product p ON od.product_id = p.p_id
";
$result = mysqli_query($conn, $sql);

// Lưu trữ kết quả truy vấn vào một mảng
$orders = [];
while ($row = mysqli_fetch_assoc($result)) {
    $orders[] = $row;
}
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Danh sách đơn hàng</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Tên người đặt</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng sản phẩm</th>
                        <th>Tổng giá đơn hàng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order) : ?>
                    <tr>
                        <td><?php echo $order['customer_name']; ?></td>
                        <td><?php echo $order['product_name']; ?></td>
                        <td><?php echo $order['quantity']; ?></td>
                        <td><?php echo $order['total_price']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
