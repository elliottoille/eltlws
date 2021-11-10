<?php
session_start();
?>
<link rel="stylesheet" href="../styles/messages.css">
<form action="..\php\sendMessage.php" method="GET">
    <input type="textbox" placeholder="new message" name="message">
    <button id="sendMsgBtn" type="submit">send</button>
</form>