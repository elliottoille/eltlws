<?php
session_start();

    if($_SERVER["REQUEST_METHOD"] == "POST") { # If the server recieves a POST request then
        include 'dbconnect.php'; # Include code from dbconnect.php in this document

        $username = mysqli_real_escape_string($conn, $_POST["username"]); # Set the username equal to the username passed by the POST method
        $password = mysqli_real_escape_string($conn, $_POST["password"]); # Set the password equal to the password passed by the POST method
        
        $sql = "SELECT `password` FROM `users` WHERE username='$username';"; # Create an SQL statement that fetches the password from the database where the username matches the entered username

        $result = mysqli_query($conn, $sql); # Query the database with the previous SQL statement

        $num = mysqli_num_rows($result);
        
        echo $num;
        
        if (password_verify($password, $result)) { # If the given password matches the password from the database (checks hashes of the passwords) then
            echo "passwords match"; # Display that the entered passwords match on the webpage
            $_SESSION["username"] = $username;
            $sql = "SELECT `userid` FROM `users` WHERE `username`=`$username`;";
            $result = mysqli_query($conn, $sql);
            $_SESSION["userID"] = $result;
            header('location: ../pages/settings.php');
        } else {
            echo "what the fuck";
        }
    }
?>