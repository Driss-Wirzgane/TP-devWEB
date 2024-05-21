<?php
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $product_id = mysqli_real_escape_string($conn, $_GET["id"]);

        $sql = "DELETE FROM products WHERE id = '$product_id'";

        mysqli_query($conn, $sql);
    }
}
?>
