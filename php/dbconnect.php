<?php

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";

    $database = "eltlws";

    $connect = mysqli_connect($servername, $username, $password, $database);

    if($connect) {
        echo "success";
    } else {
        die("Error". mysqli_connect_error());
    }
?>