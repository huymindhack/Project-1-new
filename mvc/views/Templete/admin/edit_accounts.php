<?php
include 'header.php';
$error = '';

if(!$error){
    // Lấy id sản phẩm từ tham số URL đã gửi tới từ nút sửa
    $id = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
    $query = mysqli_query($conn,"SELECT * FROM product WHERE p_id = $id");
    $product = mysqli_fetch_assoc($query); // Lấy thông tin sản phẩm từ cơ sở dữ liệu

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $category = $_POST['category'];
        $sql = "UPDATE users_account SET role = '$category' WHERE id = $id";               
            if(mysqli_query($conn,$sql)){
                header('location: user_accounts.php');
            } else {
                $error = 'Có lỗi xảy ra khi cập nhật sản phẩm';
            }
    }
}
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title">Sửa sản phẩm</h5>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="mb-3">
                <label for="productCategory" class="form-label">Danh mục</label>
                <select class="form-select" id="productCategory" name="category">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <?php if($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Lưu lại</button>
        </form>
    </div>
</div>

<?php include 'footer.php';?>
