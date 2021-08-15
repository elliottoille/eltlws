<?php
    echo "if you see this dbconnect ran";
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";

    $database = "eltlws";

    $conn = mysqli_connect($servername, $username, $password, $database);
    echo "if you see this then database established?";
    if($conn) {
        echo "success";
    } else {
        die("Error". mysqli_connect_error());
    }
?>