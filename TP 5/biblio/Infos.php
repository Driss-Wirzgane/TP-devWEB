<?php
    include "biblio.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["cin"])) {
            $cin = $_POST["cin"];
            Infos($cin);
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Information Client</title>
</head>
<body>
    <h2>Information Client</h2>
    <form method="post" action="">
        CIN: <input type="text" name="cin"><br>
        <input type="submit" value="Obtenir les informations">
    </form>
</body>
</html>