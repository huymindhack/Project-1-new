<?php 
include 'header.php';
$error = ''; // Biến $error để lưu thông báo lỗi
// Lấy id từ tham số URL đã gửi tới từ nút xóa
$id = !empty($_GET['id']) ? (int)$_GET['id'] : 0;

// Truy vấn COUNT để đếm số lượng sản phẩm theo c_id
$sql_c = "SELECT COUNT(*) as 'total' FROM product WHERE c_id = $id";
$query_count = mysqli_query($conn, $sql_c); // Truy vấn
$row_count = mysqli_fetch_assoc($query_count); // Duyệt dữ liệu

if($row_count['total'] == 0) {
    $deleted = mysqli_query($conn, "DELETE FROM category WHERE c_id = $id");
    if($deleted) {
        header('location: category.php');
    } else {
        echo 'Có lỗi, vui lòng kiểm tra lại';
    }
} else {
    $error = 'Danh mục này đang có '.$row_count['total'] .' sản phẩm';
}
?>

<!-- Hiển thị thông báo lỗi -->
<div class="alert alert-danger" role="alert">
    <?php echo $error; ?>
</div>

<?php include 'footer.php';?>
