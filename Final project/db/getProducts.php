<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
    include 'db.php';

    $json = array();
    $query = "SELECT * FROM products"; 
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn)); 
    }

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($json, $row);
    }

    echo json_encode($json);
?>
