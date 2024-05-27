<!DOCTYPE html>
<html>
<body>
    <form method="GET" action="">
        CIN : <input type="text" name="CIN">
        Nom : <input type="text" name="nom">
        Prenom : <input type="text" name="prenom">
        Adresse : <input type="text" name="adresse">
        Numero de Compte : <input type="text" name="num">
        Montant : <input type="text" name="montant">
        <input type="submit" value="Submit">
    </form>
</body>
</html>

<?php
    //include "biblio.php";
    function NouveauClient1(){
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if (isset($_GET["CIN"]) && isset($_GET["nom"]) && isset($_GET["prenom"]) && isset($_GET["adresse"]) && isset($_GET["num"]) && isset($_GET["montant"])) {
                $CIN = $_GET["CIN"];
                $nom = $_GET["nom"];
                $prenom = $_GET["prenom"];
                $adresse = $_GET["adresse"];
                $num = $_GET["num"];
                $montant = $_GET["montant"];
                
                $mon = (string)$montant;
                $number = (string)$num;

                $handle = fopen("client.txt", "a");
                if ($handle) {
                    if (!ExisteClient($CIN)) {
                        $txt = $nom . "|" . $prenom . "|" . $adresse . "|" . $CIN . "\n";
                        fwrite($handle, $txt);
                        fclose($handle);
                        echo "Account is created";
                    } else {
                        echo "Error: Client already exists";
                        return false;
                    }
                }
                NouveauCompte($number, $mon, $CIN);
            }
        }
    }

    NouveauClient1();
?>
