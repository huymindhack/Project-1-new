<?php 
include 'header.php';

// Truy vấn dữ liệu từ bảng product kèm tên danh mục tương ứng
$sql = "SELECT * from users_account";
$result = mysqli_query($conn, $sql);

// Kiểm tra xem có dữ liệu trả về không
if (mysqli_num_rows($result) > 0) {
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Danh sách tài khoản</h3>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Lặp qua từng hàng dữ liệu trả về từ truy vấn
                while ($p = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $p['id']; ?></td>
                        <td><?php echo $p['email']; ?></td>
                        <td><?php echo $p['password']; ?></td>
                        <td><?php echo $p['role'] ?></td>
                        <td>
                            <a href="edit_accounts.php?id=<?php echo $p['id'];?>" class="btn btn-sm btn-primary">Sửa</a>
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
