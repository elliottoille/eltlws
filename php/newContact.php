<?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") { # If the server recieves a POST request then
        include 'dbconnect.php'; # Include code from dbconnect.php in this document

        if ($_SESSION["loggedIn"] = "T") {
            newContact();
        } else {
            echo "you are not logged in";
        }
    }

function newContact() {
    $username = $_POST["username"]; # Sets username equal to the username passed by the POST method
        $userID1 = $_SESSION["userID"]; # Sets userID1 equal to the userID of the logged in user

        $sql = "SELECT `userID` FROM `users` WHERE `username`='$username';"; # SQL code that fetches the associated userID of the username entered by the user
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);

        $num = mysqli_num_rows($result); # Store the amount of rows fetched from the previous SQL query

        if ($num != 0) { # If the amount of rows returned is 0 (username doesn't already exist) then
            $userID2 = $row["userID"];
        } else {
            echo "username doesn't exist"; # This will display on the webpage if something is returned in the initial query
        }
        
        if ($userID1 > $userID2) {
            $tableName = sprintf('%08d', (string)$userID2) . sprintf('%08d', (string)$userID1);
        } elseif ($userID2 > $userID1) {
            $tableName = sprintf('%08d', (string)$userID1) . sprintf('%08d', (string)$userID2);
        } else {
            echo "you dumb";
        }
        echo $tableName;

        $sql = "SHOW TABLES WHERE $tableName NOT LIKE '\_%' AND $tableName NOT LIKE '%\_xrefs'; ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo $row["Tables_in_eltlws"];
        if ($row["Tables_in_eltlws"] == $tableName) {
            echo "contact already added";
        } else {
            $sql = "CREATE TABLE `$tableName`(`messageID` INT NOT NULL AUTO_INCREMENT, `message` TEXT(65535) NOT NULL, PRIMARY KEY (`messageID`));";
            $result = mysqli_query($conn, $sql);
        }
}
?>