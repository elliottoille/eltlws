<?php
session_start();
?>
<link rel="stylesheet" href="../../styles/settings.css">
Your username is: 
<?php
if (isset($_SESSION['username'])) {
    echo $_SESSION["username"];
} else {
    echo "you not log in";
}
?>
<br>
Your userID is: 
<?php 
if (isset($_SESSION['username'])) {
    echo $_SESSION["userID"];
} else {
    echo "you not log in";
}
?>
<br><br>
Your private key is: <br>
<?php 
if (isset($_SESSION['username'])) {
    echo $_SESSION["privateKey"];
} else {
    echo "you not log in";
}
?>
<br><br>
Your public key is: <br>
<?php 
if (isset($_SESSION['username'])) {
    echo $_SESSION["publicKey"];
} else {
    echo "you not log in";
}
?>
<br><br>
Delete account:
<form action="php/deleteAccount.php" method="POST">
    <label for="password">password</label>
    <input id="password" type="password" placeholder="password" name="password" required>

    <label for="confirmPassword">confirm password</label>
    <input id="confirmPassword" type="password" placeholder="confirm password" name="confirmPassword" onkeyup="checkPasswordMatch();" required>

    <p id="passwordMatchAlert"></p>

    <button id="btn" type="submit">sign up</button>
</form>