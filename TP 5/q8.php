<?php

function Debiteurs(){
    $fichierComptes = "compte.txt";
    $fichierClients = "client.txt";

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

Debiteurs();

?>
