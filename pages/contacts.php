<?php
session_start();
?>
<link rel="stylesheet" href="../styles/pages.css">
<link rel="stylesheet" href="../styles/contacts.css">
<ul>
    <li>new contact<form method="POST" action="../php/newContact.php">
        <label for="username">username:</label>
        <input type="text" name="username"/>
        <input type="submit" value="search"/>
    </form></li> 
    <li><a href="#" target="messages">contact one</a></li>
    <li><a href="#" target="messages">contact two</a></li>
</ul>
<iframe name="messages" src="messages.html" frameborder="0"></iframe>
