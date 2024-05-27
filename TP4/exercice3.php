<?php 
function calculprixTTCsimple($duree){
    $tarifparm = 2;
    $prixHT = $tarifparm * $duree;
    $prixTTC = $prixHT * (1 + 0.2);
    return $prixTTC;
}

function calculprixTTC($duree, $Type){
    $tarif = 0;
    switch($Type){
        case 1 : 
            $tarif = 218;
            break;
        case 2 : 
            $tarif = 350;
            break;
        case 3 : 
            $tarif = 450;
            break;
        default:
            $tarif = 0;
    }
    $tarifparm = 2;
    $prixHT = $tarif + $duree * $tarifparm;
    $prixTTC = $prixHT * (1 + 0.2);
    $Type = $Type - 1;
    if ($duree > $Type  * 60){
        $tarifparm = 2;
        $prixHT += ($duree - $Type * 60) * $tarifparm;
        $prixTTC = $prixHT * (1 + 0.2);
    }
    return $prixTTC;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
    $duree = isset($_POST['duree']) ? intval($_POST['duree']) : 0;
    $Type = isset($_POST['Type']) ? intval($_POST['Type']) : 0;
    if ($Type == 0) {
        $prixTTC = calculprixTTCsimple($duree);
    } else {
        $prixTTC = calculprixTTC($duree, $Type);
    }
    $prixHT = $prixTTC / (1 + 0.2);
    echo "nom est $nom prix HT : $prixHT prix TTC est : $prixTTC DH.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>exercice 3</title>
</head>
<body>
    <form action="exercice3.php" method="post">
        nom  : <input type="text" name="nom"> <br>
        Duree  : <input type="number" name="duree"> <br>
        <select name="Type" >
            <option value="0">abonnement simple</option>
            <option value="1">Forfait 1h</option>
            <option value="2">Forfait 2h</option>
            <option value="3">Forfait 3h</option>
        </select>
        <input type="submit" name="valider">
    </form>
</body>
</html>
