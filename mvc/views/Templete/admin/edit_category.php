<?php
include 'header.php';
$error = '';

if(!$error){
    // Lấy id từ tham số URL đã gửi tới từ nút sửa
    $id = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
    $query = mysqli_query($conn,"SELECT * FROM category WHERE c_id = $id");
    $category = mysqli_fetch_assoc($query); // Lấy thông tin danh mục từ cơ sở dữ liệu

    if(!$category){
        // Nếu không có danh mục nào được tìm thấy với ID cung cấp
        echo '<div class="alert alert-danger" role="alert">Không tìm thấy danh mục</div>';
        exit;
    }

    if(isset($_POST['name'])){
        $name = $_POST['name'];
        // Kiểm tra xem tên mới đã được sử dụng hay chưa
        $check_query = mysqli_query($conn, "SELECT * FROM category WHERE c_name = '$name' AND c_id != $id");
        if(mysqli_num_rows($check_query) > 0){
            $error = 'Tên danh mục này đã được sử dụng';
        } else {
            if(empty($name)){
                $error = 'Tên danh mục không được để trống';
            } else {
                // Thực hiện cập nhật tên danh mục vào cơ sở dữ liệu
                $sql = "UPDATE category SET c_name = '$name' WHERE c_id = $id";
                if(mysqli_query($conn,$sql)){
                    header('location: category.php');
                } else {
                    $error = 'Có lỗi xảy ra khi cập nhật danh mục';
                }
            }
        }
    }
}
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="card-title">Sửa danh mục hàng</h5>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            <div class="mb-3">
                <label for="categoryName" class="form-label">Tên danh mục</label>
                <input type="text" class="form-control" id="categoryName" name="name" value="<?php echo isset($category['c_name']) ? $category['c_name'] : ''; ?>">
            </div>
            <?php if($error): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">Lưu lại</button>
        </form>
    </div>
</div>

<?php include 'footer.php';?>
