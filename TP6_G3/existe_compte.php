<?php
    include 'bibliotheque.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["num"])) {
            $num = $_POST["num"];
            if (Existecompte($num)) {
                echo "Compte exists.";
            } else {
                echo "Compte does not exist.";
            }
        }
    }
?>
    
    <!DOCTYPE html>
    <html>
    <body>
        <h2>Check Compte Existence</h2>
        <form method="post" action="">
            numero de compte: <input type="text" name="num"><br>
            <input type="submit" value="Submit">
        </form>
    </body>
    </html>   