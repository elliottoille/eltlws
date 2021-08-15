<?php
    $displayAlert = false;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'dbconnect.php';

        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        $sql = "Select * from users where username='$username'";

        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);

        if ($num == 0) {
            if ($password == $confirmPassword) {
                $hash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$hash')";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $displayAlert = true;
            } else {
                echo "passwords dont match";
            }
        }
        if ($num > 0) {
            echo "username not available";
        }
    }
    }

?>