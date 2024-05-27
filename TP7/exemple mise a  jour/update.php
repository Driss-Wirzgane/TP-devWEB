<?php
    header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Content-Type");
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "exemple";
    $conn = mysqli_connect($host, $user, $pass, $db);
    if($conn === false){
        die("Error: Could not connect. " . mysqli_connect_error());
    }
    $data = json_decode(file_get_contents('php://input'), true);
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $data["id"];
        $name = $data["nom"];
        $email = $data["email"];

        $sql = "UPDATE client SET nom = '$name', email = '$email' WHERE id = $id";
        if (mysqli_query($conn, $sql)) {
            echo "{status: success}";
        } else {
            echo "{status: failed, message: " . mysqli_error($conn) . "}";
        }
    }
?>