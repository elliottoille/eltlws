<?php
    $displayAlert = false;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'dbconnect.php';

        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        $sql = "SELECT * FROM users WHERE username='$username'";

        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);

        if ($num == 0) {
            echo "no other users with this username in table<br>";
            if ($password == $confirmPassword) {
                echo "entered passwords do match<br>";
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$hash')";

                $result = mysqli_query($conn, $sql);
            } else {
                echo "passwords do not match";
            }
        }
        if ($num > 0) {
            echo "username not available";
        }
    }
?>