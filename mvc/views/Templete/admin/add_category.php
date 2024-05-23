<?php include 'header.php';
$error = '';
if(isset($_POST['name'])){
    $name = $_POST['name'];
    if(empty($name)){
        $error = 'Tên danh mục không được để trống';
    }
    if(!$error){
        $sql = "INSERT INTO category(c_name) VALUES('$name')";

        if(mysqli_query($conn,$sql)){
		//Nếu thêm mới thành công, chuyển hướng trang
            header('location: category.php');
        }else{
		// echo mysqli_error($conn);
            $error = 'Có lỗi, vui lòng thử lại';
        }
    }
}
?>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Thêm mới danh mục</h3>
        </div> 
        <div class="card-body">
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">Tên danh mục</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên danh mục">
                    <?php if($error) :?>
                        <div class="text-danger"><?php echo $error;?></div>
                    <?php endif;?>
                </div>
                <button type="submit" class="btn btn-primary">Lưu lại</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php';?>
