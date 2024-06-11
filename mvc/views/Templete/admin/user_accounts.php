<?php 
include 'header.php';

// Truy vấn dữ liệu từ bảng product kèm tên danh mục tương ứng
$sql = "SELECT count(id) as total from users_account";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);
$total_records = $row['total'];

$current_page = isset($_POST['page']) ? $_POST['page'] : 1;

$limit = 10;

$total_page = ceil($total_records / $limit);

if ($current_page > $total_page) {
    $current_page = $total_page;
}

else if ($current_page < 1) {
    $current_page = 1;
}

$start = ($current_page - 1) * $limit;

$result = mysqli_query($conn, "select * from users_account limit $start, $limit");

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

    <div class="pagination d-flex justify-content-center align-items-center">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <?php 
                if ($current_page > 1 && $total_page > 1) {
            ?>
                <button type="submit" value="<?php echo ($current_page - 1); ?>" name="page" class="btn btn-primary">Prev</button>
            <?php
                }

                for ($i = 1; $i <= $total_page ; $i++) {
                    if ($i == $current_page) {
            ?>
                    <button type='submit' value='<?php echo $i ?>' name='page' class='btn btn-danger'><?php echo $i ?></button>
            <?php
                    }

                    else {   
            ?>
                        <button type="submit" value="<?php echo $i ?>" name="page" class="btn btn-primary"><?php echo $i ?></button>
            <?php
                    }
                }

                if ($current_page < $total_page && $total_page > 1) {
            ?>
<button type="submit" class="btn btn-primary" value="<?php echo ($current_page + 1); ?>" name="page">Next</button>
            <?php
                }
            ?>
        </form>
    </div>
</div>
<?php
} else {
    echo '<div class="alert alert-warning" role="alert">Không có sản phẩm nào trong cơ sở dữ liệu.</div>';
}

include 'footer.php';
?>
