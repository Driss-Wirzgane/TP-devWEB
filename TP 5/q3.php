<?php 
include "q1.php";
include "q2.php";

function NouveauCompte($num_compte, $montant, $CIN) {
    $handle = fopen("compte.txt", "a");
    if ($handle) {
        if (!ExisteCompte($num_compte) && ExisteClient($CIN)) {
            $txt = $num_compte . "|" . $montant . "|" . $CIN . "\n";
            fwrite($handle, $txt);
            fclose($handle);
            echo "Le compte a été créé avec succès.";
            return TRUE;
        } else {
            echo "Erreur: Impossible de créer le compte. Vérifiez que le client existe et que le numéro de compte est unique.";
            return FALSE;
        }
    } else {
        echo "Erreur: Impossible d'ouvrir le fichier des comptes.";
        return FALSE;
    }
}
?>
