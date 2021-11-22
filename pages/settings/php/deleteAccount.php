<?php
session_start(); # Start a session
if ($_SERVER["REQUEST_METHOD"] == "POST") { # If the server receives a POST request
    include '..\..\..\php\dbconnect.php'; # Include code from dbconnect.php in this file
    
    $username = $_SESSION["username"]; # Set the username to the one of the logged in user
    $password = mysqli_real_escape_string($conn, $_POST["password"]); # Set password to the one the user entered
    $confirmPassword = mysqli_real_escape_string($conn, $_POST["confirmPassword"]); # Set confirmPassword to the one the user entered

    $sql = "SELECT `password` FROM `users` WHERE username='$username';"; # SQL statement to fetch the password stored for the logged in user
    $result = mysqli_query($conn, $sql); # query the database

    $row = mysqli_fetch_assoc($result); # Store the returned results in variable row
    if ($password == $confirmPassword) { # If the two passwords the user entered match then
        if (password_verify($password, $row["password"])) { # If the password the user entered matches the one stored in the database
            echo "correct password"; # Echo correct password
            
            $sql = "DELETE FROM `users` WHERE username='$username';"; # SQL statement to delte the associated user from the users table

            $result = mysqli_query($conn, $sql); # Query the database
            echo "account deleted"; # Tell the user that their account was deleted

            session_destroy(); # Log the user out
            echo "you are now logged out"; # Tell the user that they are no longer logged in
        }
    }
}
?>