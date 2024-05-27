<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "exemple";
    $conn = mysqli_connect($host, $user, $pass, $db);
    if($conn === false){
        die("Error: Could not connect. " . mysqli_connect_error());
    }

    $table = array();
    $query = "SELECT id FROM client"; 
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        die("Error executing query: " . mysqli_error($conn)); 
    }

    while ($row = mysqli_fetch_assoc($result)) {
        array_push($table, $row);
    }

    echo json_encode($table);
?>