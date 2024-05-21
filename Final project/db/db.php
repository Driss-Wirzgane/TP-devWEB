<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "products";

    $conn = mysqli_connect($host, $user, $pass, $db);
    if($conn === false){
        die("Error: Could not connect. " . mysqli_connect_error());
    }
?>