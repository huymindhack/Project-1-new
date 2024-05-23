<?php
include 'header.php';
// Truy vấn dữ liệu bảng danh muc
$category = mysqli_query($conn,"SELECT * FROM category");
?>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h3 class="card-title">Danh sách danh mục</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($category as $c) : ?>
                    <tr>
                        <td><?php echo $c['c_id'];?></td>
                        <td><?php echo $c['c_name'];?></td>
                        <td>
                            <a href="edit_category.php?id=<?php echo $c['c_id'];?>" class="btn btn-sm btn-primary">Sửa</a>
                            <a href="delete_category.php?id=<?php echo $c['c_id'];?>" class="btn btn-sm btn-danger">Xóa</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php';?>
