<?php
function ExisteCompte($num) {
    $file = fopen("compte.txt", "r");
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
?>
