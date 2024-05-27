<?php
function ExisteCompte($num) {
    $file = fopen("copie_compte", "r");
    while (($line = fgets($file)) !== false) {
        $attributes = explode('|', $line);
        if ($attributes[0] == $num) {
            fclose($file);
            return true;
        }
    }
    fclose($file);
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["num"])) {
        $num = $_POST["num"];
        if (ExisteCompte($num)) {
            echo "Account  exists.";
        } else {
            echo "Account does not exist.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<body>
    <h2>Check Account Existence</h2>
    <form method="post" action="">
        Account Number: <input type="text" name="num"><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>
