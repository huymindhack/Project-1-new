<?php require_once "database.php";

// Hàm để lấy tất cả dữ liệu từ một bảng
function getTableData($conn, $tableName) {
    // Chuẩn bị truy vấn SQL
    $sql = "SELECT * FROM $tableName";

    // Thực thi truy vấn và kiểm tra kết quả
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // Dữ liệu được trả về thành một mảng kết hợp (associative array)
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        echo "Không có dữ liệu trong bảng $tableName";
    }
}

function insertData($conn, $tableName, $data) {
    // $conn: MySQLi connection object
    // $tableName: Name of the table to insert data into
    // $data: An associative array where keys are column names and values are the data to be inserted

    // Prepare column names and values for the SQL query
    $columns = implode(", ", array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";

    // Construct the SQL query
    $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        
        return true;
    } else {
        
        return false;
    }
}





?>