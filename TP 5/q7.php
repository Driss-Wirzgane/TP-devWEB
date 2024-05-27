<?php

    function Supprime($cin){
        $fichierClients = "client.txt";
        $fichierComptes = "compte.txt";

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

    Supprime("AD8888");

?>
