<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    include 'dbconnect.php';
    $message = mysqli_real_escape_string($conn, $_GET["message"]);
    $contactTable = $_SESSION["currentContactTable"];
    $userID = $_SESSION["userID"];
    $pubKey = $_SESSION["currentContactPubKey"];
    $message = openssl_public_encrypt($message, $encrypted, $pubKey);

    //echo $userID;
    //echo $contactTable;
    //echo $message;

    $sql = "INSERT INTO `$contactTable` (`message`, `userID`) VALUES ('$encrypted', '$userID');";
    $result = mysqli_query($conn, $sql);
}
?>