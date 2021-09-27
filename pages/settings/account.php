<?php
session_start();
?>
<link rel="stylesheet" href="../../styles/settings.css">
Your username is: 
<?php echo $_SESSION["username"]; ?>
Your userID is: 
<?php echo $_SESSION["userID"]; ?>