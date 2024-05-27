<?php 
function estPremier($number){
    if($number < 2){
        return false;
    }
    for ($i = 2; $i <= sqrt($number); $i++){
        if ($number % $i === 0){
            return false;
        }
    }
    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num = isset($_POST['num']) ? intval($_POST['num']) : 0;
    $resultat = estPremier($num) ? "est Premier" : "n'est pas premier";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>exercice 2</title>
</head>
<body>
<form action="exercice2.php" method="post">
    nombre  : <input type="number" name="num"> <br>
    <input type="submit" name="valider">
</form>
<?php 
    if (isset($resultat)){
        echo "le nombre $num $resultat ";
    }
?>
</body>
</html>
