<!DOCTYPE html>
<html>
    <head>
    </head>
    <body>
    <?php
        session_start();
        include '../php/dbconnect.php';
        $table = $_SESSION["currentContactTable"];
        $Sql = "SELECT `message` FROM `$table`";
        
    ?>
    </body>
</html>