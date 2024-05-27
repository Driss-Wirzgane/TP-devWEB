<?php
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type");
$host = "localhost";
$user = "root";
$pass = "";
$db = "exemple";
$conn = mysqli_connect($host, $user, $pass, $db);
if($conn === false){
    die("Error: Could not connect. " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["id"])) {
        $id = mysqli_real_escape_string($conn, $_GET["id"]);

        $sql = "DELETE FROM client WHERE id = '$id'";

        mysqli_query($conn, $sql);
    }
}
?>