<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'dbconnect.php';

        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $sql = "select 'password' where 'username'='$username' from users";

        $result = mysqli_query($conn, $sql);

        if (password_verify($password, $result)) {
            echo "passwords match";
        }
    }
?>