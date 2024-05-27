<?php
    function Infos($cin){
        $handleClient = fopen("client.txt", "r");
        $handleAccounts = fopen("compte.txt", "r");

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
?>
