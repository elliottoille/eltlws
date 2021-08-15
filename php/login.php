<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'dbconnect.php';

        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $sql = "SELECT 'password' WHERE 'username' = '$username'";

        $result = mysqli_query($conn, $sql);

        echo $result;

        if (password_verify($password, $result)) {
            echo "passwords match";
        }
    }
?>