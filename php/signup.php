<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") { # If the server recieves a POST request then
        include 'dbconnect.php'; # Include code from dbconnect.php in this document
        $username = mysqli_real_escape_string($conn, $_POST["username"]); # Sets username equal to the username passed by the POST method
        $password = mysqli_real_escape_string($conn, $_POST["password"]); # Sets password equal to the password passed by the POST method
        $confirmPassword = mysqli_real_escape_string($conn, $_POST["confirmPassword"]); # Sets confirmPassword to the confirm password passed by the POST method

        $sql = "SELECT * FROM `users` WHERE username='$username';"; # Create an SQL statement that fetches all the data from the database where the username equals the entered username

        $result = mysqli_query($conn, $sql); # Query the database with the previous SQL statement
        $num = mysqli_num_rows($result); # Store the amount of rows fetched from the previous SQL query

        if ($num == 0) { # If the amount of rows returned is 0 (username doesn't already exist) then
            if ($password == $confirmPassword) { # If both the entered passwords match each other then
                include 'genKeys.php';
                $hash = password_hash($password, PASSWORD_DEFAULT); # Set hash equal to the entered password but hashed

                $sql = "INSERT INTO `users` ( `username`, `password`, `privKey`, `pubKey`) VALUES ('$username', '$hash', '$private_key', '$public_key');";
                # ^^ Create an SQL query that enters the username and hashed password into the table
                $result = mysqli_query($conn, $sql); # Query the database with the SQL statement!
                header('Location: ../index.html'); # Redirect the page to the homepage
            } else {
                echo "passwords do not match"; # This will display on the webpage if both passwords do not match
            }
        } else {
            echo "username not available"; # This will display on the webpage if something is returned in the initial query
        }
    }
?>