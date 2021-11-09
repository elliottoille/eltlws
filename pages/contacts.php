<?php
session_start();
?>
<link rel="stylesheet" href="../styles/pages.css">
<link rel="stylesheet" href="../styles/contacts.css">
<ul>
    <li><span>new contact</span><form method="POST" action="../php/newContact.php">
        <label for="username">username:</label>
        <input type="text" name="username"/>
        <input type="submit" value="search"/>
    </form></li> 
    <?php
        include '../php/fetchContacts.php';
    ?>
</ul>
<iframe name="messages" src="messages.php" frameborder="0"></iframe>
