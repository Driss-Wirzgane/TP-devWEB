<?php
function ExisteClient($cin) {
    $file = fopen("client.txt", "r");
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