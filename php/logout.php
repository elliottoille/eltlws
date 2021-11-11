<?php
session_start(); # Start a session
session_destroy(); # Destroy existing dessions
header('Location: ../index.html'); # redirect them to the home page
exit;
?>