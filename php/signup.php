<?php
    $displayAlert = false;

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'dbconnect.php';

        $username = $_POST["username"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirmPassword"];

        $sql = "select * from `users` where username=$username";

        $result = mysqli_query($conn, $sql);

        $num = mysqli_num_rows($result);

        if ($num == 0) {
            echo "no other users with this username in table<br>";
            if ($password == $confirmPassword) {
                echo "entered passwords do match<br>";
                $hash = password_hash($password, PASSWORD_DEFAULT);
                echo "$hash<br>";
                $sql = "insert into `users` ('username', 'password') values ($username, $hash)";
                echo "$sql<br>";
                $result = mysqli_query($conn, $sql);
                echo "it made it past the execution of the sql";
            } else {
                echo "passwords do not match";
            }
        } else {
            echo "username not available";
        }
        $sql = "select * from users where username=$username";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        echo $row['username'];
    }
?>