<?php
session_start(); # Start a session
if ($_SERVER["REQUEST_METHOD"] == "GET") { # If the server request was a GET request
    include 'dbconnect.php'; # Include code from 'dbconnect.php'
    $message = $_GET["message"]; # Set $message to an escaped version of the sent message
    if (isset($_SESSION["userID"])) { # Check if the user is logged in
        $contactTable = $_SESSION["currentContactTable"]; # Set $contactTable to the current contact's table name
        $pubKey = $_SESSION["currentContactPubKey"]; # Set $pubKey to the current contact's public key
    } else { # if they aren't logged in
        echo "you are not logged in"; # display this message
        exit; # stop running the code any further
    }

    if ($contactTable == "" OR $pubKey == "") { # if either of these variables are blank then
        echo "you have not selected a contact"; # tell them they haven't selected a contact
        exit; # stop running the code any further
    } else {
        $userID = $_SESSION["userID"]; # Set $userID to the userID of the logged in user
        openssl_public_encrypt($message, $encrypted, $pubKey); # Encrypt the message with the current contacts public key to the variable $encrypted
        $encrypted = mysqli_real_escape_string($conn, bin2hex($encrypted));
        $sql = "INSERT INTO `$contactTable` (`message`, `userID`) VALUES ('$encrypted', '$userID');"; # Write the encrypted message to the contact's table
        echo $sql;
        $result = mysqli_query($conn, $sql); # Execute the SQL query
    }
}
?>