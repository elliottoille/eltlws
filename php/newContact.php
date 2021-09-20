<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { # If the server recieves a POST request then
        include 'dbconnect.php'; # Include code from dbconnect.php in this document

        $username = $_POST["username"]; # Sets username equal to the username passed by the POST method

        $tableName = ord($_SESSION['username']) * ord($username);

        $sql = "SELECT newContact FROM `` WHERE username='$username';"; # Create an SQL statement that fetches all the data from the database where the username equals the entered username

        $result = mysqli_query($conn, $sql); # Query the database with the previous SQL statement

        $num = mysqli_num_rows($result); # Store the amount of rows fetched from the previous SQL query

        if ($num == 0) { # If the amount of rows returned is 0 (username doesn't already exist) then
            if ($password == $confirmPassword) { # If both the entered passwords match each other then
                $hash = password_hash($password, PASSWORD_DEFAULT); # Set hash equal to the entered password but hashed
                $sql = "INSERT INTO `users` ( `username`, `password`) VALUES ('$username', '$hash');"; # Set the SQL statement to insert the entered users details into the database (stores the hashed password)
                $result = mysqli_query($conn, $sql); # Query the database with the SQL statement!
            } else {
                echo "passwords do not match"; # This will display on the webpage if both passwords do not match
            }
        } else {
            echo "username not available"; # This will display on the webpage if something is returned in the initial query
        }
    }
?>