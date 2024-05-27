<!DOCTYPE html>
<html>
<head>
    <title>AjouterClient</title>
</head>
<body>
    <h2>Ajouter un client :</h2>
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
    include 'bibliotheque.php';
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
            NouveauClient($nom,$prenom,$adresse,$CIN,$num,$montant);
        }
    }
?>