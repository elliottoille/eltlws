<?php
session_start(); # Start a session

    if($_SERVER["REQUEST_METHOD"] == "POST") { # If the server recieves a POST request then
        include 'dbconnect.php'; # Include code from dbconnect.php in this document

        $username = mysqli_real_escape_string($conn, $_POST["username"]); # Set the username equal to the username passed by the POST method
        $password = mysqli_real_escape_string($conn, $_POST["password"]); # Set the password equal to the password passed by the POST method
        
        $sql = "SELECT * FROM `users` WHERE username='$username';"; # Create an SQL statement that fetches the password from the database where the username matches the entered username

        $result = mysqli_query($conn, $sql); # Query the database with the previous SQL statement

        $num = mysqli_num_rows($result); # Fetch the number of rows that were returned with the previous SQL statement
        
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row["password"])) { # If the given password matches the password from the database (checks hashes of the passwords) then
            echo "passwords match"; # Display that the entered passwords match on the webpage
            $_SESSION["username"] = $username; # Set the session variable username to the username variable
            $_SESSION["userID"] = $row["userID"]; # Set the session variable userID to the generated userID
            $_SESSION["publicKey"] = $row["pubKey"]; # Set the session variable publicKey to the generated pubKey
            $_SESSION["privateKey"] = $row["privKey"]; # Set the session variable privateKey to the generated privKey
            header('location: ../pages/settings.php'); # Redirect the user to the settings page
        } else { # If the passwords entered do not match then
            echo "wrong password"; # Display message "wrong password"
        }
    }
?>