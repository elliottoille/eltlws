<?php
    $servername = "localhost";
    $username = "root";
    $password = "xe5Y_U),xOrdw{Ku#iXD";

    $database = "eltlws";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if(!$conn) {
        die("Error: ". mysqli_connect_error());
    } else {
        echo "connection succeeded<br>";
    }
?>