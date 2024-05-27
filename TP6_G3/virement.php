<?php
    include "bibliotheque.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["numeroCompte"]) && isset($_POST["valeur"])) {
            $num = $_POST["numeroCompte"];
            $valeur = $_POST["valeur"];
            Virement($num,$valeur);
        }
    }
?>



<!DOCTYPE html>
<html>
<head>
    <title>Virement</title>
</head>
<body>
    <h2>Virement</h2>
    <form method="post" action="">
        Numéro de Compte: <input type="text" name="numeroCompte"><br>
        Valeur: <input type="text" name="valeur"><br>
        <input type="submit" value="Effectuer le virement">
    </form>
</body>
</html>