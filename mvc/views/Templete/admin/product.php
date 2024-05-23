<?php 
include 'header.php';

// Truy vấn dữ liệu từ bảng product kèm tên danh mục tương ứng
$sql = "SELECT product.*, category.c_name AS c_name FROM product JOIN category ON product.c_id = category.c_id";
$result = mysqli_query($conn, $sql);

// Kiểm tra xem có dữ liệu trả về không
if (mysqli_num_rows($result) > 0) {
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Danh sách sản phẩm</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Giá</th>
                    <th>Hình ảnh</th>
                    <th>Mô tả</th>
                    <th>Danh mục</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Lặp qua từng hàng dữ liệu trả về từ truy vấn
                while ($p = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $p['p_id']; ?></td>
                        <td><?php echo $p['p_name']; ?></td>
                        <td><?php echo $p['price']; ?></td>
                        <td><img src="../images/<?php echo $p['img']; ?>" alt="<?php echo $p['p_name']; ?>" class="img-thumbnail" width="100px"></td>
                        <td><?php echo $p['description']; ?></td>
                        <td><?php echo $p['c_name']; ?></td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $p['p_id'];?>" class="btn btn-sm btn-primary">Sửa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php
} else {
    echo '<div class="alert alert-warning" role="alert">Không có sản phẩm nào trong cơ sở dữ liệu.</div>';
}

include 'footer.php';
?>
