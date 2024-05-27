<?php
function virement($numeroCompte, $valeur) {
    $lines = file("compte.txt");
    $handle = fopen("compte.txt", "w");

    if ($handle !== false) {
        foreach ($lines as $ligne) {
            $infosCompte = explode("|", $ligne);
            if ($infosCompte[0] == $numeroCompte) {
                $nouveauMontant = floatval($infosCompte[1]) + $valeur;
                fwrite($handle, $numeroCompte . '|' . $nouveauMontant . '|' . $infosCompte[2]);
            } else {
                fwrite($handle, $ligne);
            }
        }
        fclose($handle);

        echo "The transfer was successful.";
    } else {
        echo "Unable to open the accounts file.";
    }
}
?>
