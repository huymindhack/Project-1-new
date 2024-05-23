<?php
include 'header.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    
    // Kiểm tra xem tệp đã được tải lên chưa và có hợp lệ không
    if(isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['img']['name'];
        $target_dir = "../Project-1/mvc/views/Templete/images/";
        $target_file = $target_dir . basename($_FILES["img"]["name"]);

        // Kiểm tra xem tệp đã tồn tại chưa, nếu tồn tại thì thêm số đằng sau tên tệp để tránh trùng lặp
        $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
        $counter = 1;
        while(file_exists($target_file)) {
            $new_filename = basename($_FILES["img"]["name"], '.' . $file_extension) . '_' . $counter . '.' . $file_extension;
            $target_file = $target_dir . $new_filename;
            $counter++;
        }

        // Di chuyển tệp đã tải lên vào thư mục uploads
        move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
    } else {
        // Nếu không có tệp được tải lên hoặc có lỗi xảy ra, có thể xử lý ở đây
        $image = ""; // Gán giá trị mặc định cho $image nếu không có tệp được tải lên
    }

    // Thêm sản phẩm vào cơ sở dữ liệu
    $c_id = $_POST['c_id'];
    $sql = "INSERT INTO product (p_name, price, description, img, c_id) VALUES ('$name', '$price', '$description', '$image', '$c_id')";
    mysqli_query($conn, $sql);
}

// Truy vấn danh sách các danh mục từ cơ sở dữ liệu
$sql_category = "SELECT * FROM category";
$result_category = mysqli_query($conn, $sql_category);
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Thêm mới sản phẩm</h3>
    </div>
    <div class="card-body">
        <form action="" method="POST" role="form" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên sản phẩm" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá sản phẩm</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Nhập giá sản phẩm" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Mô tả sản phẩm</label>
                <textarea class="form-control" id="description" name="description" placeholder="Nhập mô tả sản phẩm" required></textarea>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Hình ảnh sản phẩm</label>
                <input type="file" class="form-control" id="img" name="img" required>
            </div>
            <div class="mb-3">
                <label for="c_id" class="form-label">Danh mục</label>
                <select name="c_id" id="c_id" class="form-control" required>
                    <option value="">Chọn danh mục</option>
                    <?php while ($row = mysqli_fetch_assoc($result_category)) : ?>
                        <option value="<?php echo $row['c_id']; ?>"><?php echo $row['c_name']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lưu lại</button>
        </form>
    </div>
</div>

<?php include 'footer.php';?>
