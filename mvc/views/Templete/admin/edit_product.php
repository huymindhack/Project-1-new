<?php
include 'header.php';
$error = '';

if(!$error){
    // Lấy id sản phẩm từ tham số URL đã gửi tới từ nút sửa
    $id = !empty($_GET['id']) ? (int)$_GET['id'] : 0;
    $query = mysqli_query($conn,"SELECT * FROM product WHERE p_id = $id");
    $product = mysqli_fetch_assoc($query); // Lấy thông tin sản phẩm từ cơ sở dữ liệu

    if(!$product){
        // Nếu không có sản phẩm nào được tìm thấy với ID cung cấp
        echo '<div class="alert alert-danger" role="alert">Không tìm thấy sản phẩm</div>';
        exit;
    }

    if(isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description']) && isset($_POST['category'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category = $_POST['category'];

        // Kiểm tra xem tên mới đã được sử dụng hay chưa
        $check_query = mysqli_query($conn, "SELECT * FROM product WHERE p_name = '$name' AND p_id != $id");
        if(mysqli_num_rows($check_query) > 0){
            $error = 'Tên sản phẩm này đã được sử dụng';
        } else {
            if(empty($name) || empty($price) || empty($description)){
                $error = 'Không được để trống thông tin sản phẩm';
            } else {
                // Thực hiện cập nhật thông tin sản phẩm vào cơ sở dữ liệu
                $sql = "UPDATE product SET p_name = '$name', price = '$price', description = '$description', c_id = '$category' WHERE p_id = $id";               
                if(mysqli_query($conn,$sql)){
                    header('location: product.php');
                } else {
                    $error = 'Có lỗi xảy ra khi cập nhật sản phẩm';
                }
            }
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
                <label for="productName" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="productName" name="name" value="<?php echo isset($product['product_name']) ? $product['product_name'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Giá</label>
                <input type="text" class="form-control" id="productPrice" name="price" value="<?php echo isset($product['product_price']) ? $product['product_price'] : ''; ?>">
            </div>
            <div class="mb-3">
                <label for="productDescription" class="form-label">Mô tả</label>
                <textarea class="form-control" id="productDescription" name="description"><?php echo isset($product['product_description']) ? $product['product_description'] : ''; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="productCategory" class="form-label">Danh mục</label>
                <select class="form-select" id="productCategory" name="category">
                    <?php
                        $category_query = mysqli_query($conn, "SELECT * FROM category");
                        while($row = mysqli_fetch_assoc($category_query)){
                            echo "<option value='".$row['c_id']."'>".$row['c_name']."</option>";
                        }
                    ?>
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
