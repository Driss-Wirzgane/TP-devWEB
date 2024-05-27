<?php
include "biblio.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["cin"])) {
        $cin = $_POST["cin"];
        if (ExisteClient($cin)) {
            echo "Client exists.";
        } else {
            echo "Client does not exist.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Check Client Existence</h2>
    <form method="post" action="">
        Cin: <input type="text" name="cin"><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
