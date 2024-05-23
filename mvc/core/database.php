<?php 
    $conn = mysqli_connect("localhost","root","","Project-1");

    if (!$conn) {
        die("Could not connect to database". mysqli_connect_error());
    }

?>