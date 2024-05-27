<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'GET') {
    $nom = isset($_REQUEST['nom']) ? $_REQUEST['nom'] : '';
    $prenom = isset($_REQUEST['prenom']) ? $_REQUEST['prenom'] : '';
    if(!empty($nom) && !empty($prenom)){
        echo "Bonjour $nom $prenom";
    }
    else {
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>exercice 1</title>
        </head>
        <body>
        <form action="exercice1.php" method="post">
            nom  : <input type="text" name="nom"> <br>
            prenom : <input type="text" name="prenom"> 
            <input type="submit" name="valider">
        </form>
        </body>
        </html>
<?php
    }
}
?>