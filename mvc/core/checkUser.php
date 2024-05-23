<?php 
    function checkUser($conn, $tableName, $email) {
        // Chuẩn bị truy vấn SQL
        $sql = "SELECT * FROM $tableName where email='$email'";
    
        // Thực thi truy vấn và kiểm tra kết quả
        $result = $conn->query($sql);

        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }
?>