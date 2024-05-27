<!DOCTYPE html>
<html>
    <body>
        <h2>Check infos</h2>
        <form method="post" action="">
            Cin: <input type="text" name="cin"><br>
            <input type="submit" value="Submit">
        </form>
    </body>
</html> 

<?php
    include 'bibliotheque.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["cin"])) {
            $cin = $_POST["cin"];
            infos($cin);
        }
    }
?>

