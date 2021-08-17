<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'dbconnect.php';

        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $sql = "select 'password' from users where username='$username';";

        $result = mysqli_query($conn, $sql);

        if (password_verify($password, $result)) {
            echo "passwords match";
        }
    }
?>