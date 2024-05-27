<?php
    include "biblio.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["cin"])) {
            $cin = $_POST["cin"];
            Supprime($cin);
        }
    }
?>


<!DOCTYPE html>
<html>
<head>
    <title>Supprimer Client</title>
</head>
<body>
    <h2>Supprimer Client</h2>
    <form method="post" action="">
        CIN: <input type="text" name="cin"><br>
        <input type="submit" value="Supprimer">
    </form>
</body>
</html>