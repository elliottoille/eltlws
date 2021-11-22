<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'dbconnect.php';
    
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST["confirmPassword"]);

    $sql = "SELECT `password` FROM `users` WHERE username='$username';";
    $result = mysqli_query($conn, $sql);

?>