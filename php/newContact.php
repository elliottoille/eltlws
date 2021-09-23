<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { # If the server recieves a POST request then
        include 'dbconnect.php'; # Include code from dbconnect.php in this document

        $username = $_POST["username"]; # Sets username equal to the username passed by the POST method
        
        $userID1binary = decbin($_SESSION["userID"]);

        $sql = "SELECT `userid` FROM `users` WHERE `username`=`$username`;";
        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result); # Store the amount of rows fetched from the previous SQL query

        if ($num == 0) { # If the amount of rows returned is 0 (username doesn't already exist) then
            $userID2binary = decbin($result);
        } else {
            echo "username doesn't exist"; # This will display on the webpage if something is returned in the initial query
        }

        $tableName = $userID1binary ^ $userID2binary;
        echo $tableName;

        $sql = "CREATE TABLE $tableName(`messageID` INT NOT NULL AUTO_INCREMENT, `message` TEXT(65535) NOT NULL,PRIMARY KEY (userID));";
        $result = mysqli_query($conn, $sql);
    }
?>