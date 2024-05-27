<?php 
include "biblio.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["num_compte"]) && isset($_POST["montant"]) && isset($_POST["cin"])) {
        $num_compte = $_POST["num_compte"];
        $montant = $_POST["montant"];
        $CIN = $_POST["cin"];
        
        if (NouveauCompte($num_compte, $montant, $CIN)) {
            echo "Account created successfully";
        }
    } else {
        echo "Veuillez fournir tous les détails du compte.";
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Créer un nouveau compte</h2>
    <form method="post" action="">
        Numéro de Compte: <input type="text" name="num_compte"><br>
        Montant: <input type="text" name="montant"><br>
        CIN du Client: <input type="text" name="cin"><br>
        <input type="submit" value="Créer le compte">
    </form>
</body>
</html>
