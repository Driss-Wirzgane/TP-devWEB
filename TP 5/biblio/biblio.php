<?php
function ExisteClient($cin) {
    $file = fopen("copie_client", "r");
    if ($file) {
        while (($line = fgets($file)) !== false) {
            $attributes = explode('|', $line);
            $cinFromFile = trim($attributes[3]);
            if ($cinFromFile == $cin) {
                fclose($file);
                return true;
            }
        }
        fclose($file);
    } else {
        echo "Unable to open file.";
    }
    return false;

}

function ExisteCompte($num) {
    $file = fopen("copie_compte", "r");
    while (($line = fgets($file)) !== false) {
        $attributes = explode('|', $line);
        if ($attributes[0] == $num) {
            fclose($file);
            return TRUE;
        }
        else{
            fclose($file);
            return FALSE;
        }
    }
}

function NouveauCompte($num_compte, $montant, $CIN) {
    $handle = fopen("copie_compte", "a");
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

function NouveauClient(){
            $handle = fopen("copie_client", "a");
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

function virement($numeroCompte, $valeur) {
    $lines = file("copie_compte");
    $handle = fopen("copie_compte", "w");

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

function Infos($cin){
    $handleClient = fopen("copie_client", "r");
    $handleAccounts = fopen("copie_compte", "r");

    if (!$handleClient || !$handleAccounts) {
        echo "Error opening files.";
        return;
    }

    while (($line = fgets($handleClient)) !== false) {
        $attributes = explode('|', $line);
        if (trim($attributes[3]) == $cin) {
            $nomPrenom = $attributes[0] . " " . $attributes[1];
            echo "Nom et prénom : $nomPrenom\n";
            break;
        }
    }
    while (($line = fgets($handleAccounts)) !== false) {
        $attributes = explode('|', $line);
        if (trim($attributes[2]) == $cin) {
            $comptes  = "$attributes[0]  $attributes[1]";
            echo "Comptes : $comptes\n";
        }
    }
    fclose($handleClient);
    fclose($handleAccounts);
}

function Supprime($cin){
    $fichierClients = "copie_client";
    $fichierComptes = "copie_compte";

    $clients = file($fichierClients);
    $comptes = file($fichierComptes);

    $handleClients = fopen($fichierClients, "w");
    $handleComptes = fopen($fichierComptes, "w");

    if ($handleClients && $handleComptes) {
        foreach ($clients as $client) {
            $attributes = explode('|', $client);
            if (trim($attributes[3]) !== $cin) {
                fwrite($handleClients, $client);
            }
        }
        foreach ($comptes as $compte) {
            $attributes = explode('|', $compte);
            if (trim($attributes[2]) !== $cin) {
                fwrite($handleComptes, $compte);
            }
        }
        fclose($handleClients);
        fclose($handleComptes);

        echo "succes";
    }
}


function Debiteurs(){
    $fichierComptes = "copie_compte";
    $fichierClients = "copie_client";

    $debitCINs = array();

    $handleComptes = fopen($fichierComptes, "r");

    if ($handleComptes) {
        echo "Clients débiteurs :\n";
        while (($line = fgets($handleComptes)) !== false) {
            $attributes = explode('|', $line);
             if ($attributes[1] < 0) {
                $debitCINs[] = $attributes[2];
                echo "- " . $attributes[2] . "\n";
            }
        }
        
        fclose($handleComptes);
        $handleClients = fopen($fichierClients, "r");
        if ($handleClients) {
            echo "Noms et prénoms des clients débiteurs :\n";
            while (($line = fgets($handleClients)) !== false) {
            $attributes = explode('|', $line);
            if (in_array(trim($attributes[3]), $debitCINs)) {
                echo "- " . $attributes[0] . " " . $attributes[1] . "\n";
            }
        }
        fclose($handleClients);
        }
    }
}

?>