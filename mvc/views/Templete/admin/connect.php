<?php
    $conn = mysqli_connect('localhost', 'root', '', 'Project-1');
    
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Set character set to UTF-8
    mysqli_set_charset($conn, "utf8");
?>