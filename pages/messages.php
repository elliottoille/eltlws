<?php
session_start();
?>
<link rel="stylesheet" href="../styles/messages.css">
<iframe src="messagesbox.php" frameborder="0"></iframe>
<form action="..\php\sendMessage.php" method="GET">
    <input type="textbox" placeholder="new message" name="message">
    <button id="sendMsgBtn" type="submit">send</button>
</form>