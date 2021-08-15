<?php
    $servername = "127.0.0.1";
    $username = "root";
    $password = '';

    $database = "eltlws";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if(!$conn) {
        die("Error: ". mysqli_connect_error());
    }
?>