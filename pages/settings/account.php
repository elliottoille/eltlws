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
<br>