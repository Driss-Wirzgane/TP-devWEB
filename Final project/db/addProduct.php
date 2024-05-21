<?php
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
include 'db.php';
$data = json_decode(file_get_contents('php://input'), true);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $data["nom"];
    $description = $data["desc"];
    $price = $data["price"];

    $sql = "INSERT INTO products (name, description, price) VALUES ('$name', '$description', '$price')";
    if (mysqli_query($conn, $sql)) {
        echo "{status: success}";
    } else {
        echo "{status: failed, message: " . mysqli_error($conn) . "}";
    }
}
?>