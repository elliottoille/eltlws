<?php
session_start();
?>
<link rel="stylesheet" href="../styles/main.css">
<form action="../php/login.php" method="POST">
    <label for="username">username</label>
    <input type="text" placeholder="username" name="username">

    <label for="password">password</label>
    <input type="password" placeholder="password" name="password">

    <button type="submit">sign in</button>

    <label for="checkbox">remember me</label>
    <input type="checkbox" name="rememberMe">
</form>
