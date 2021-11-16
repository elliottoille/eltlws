<?php
    session_start(); # Start a session
    if ($_SERVER["REQUEST_METHOD"] == "POST") { # If the recieved request was a POST request
        include 'dbconnect.php'; # Include code from 'dbconnect.php' in this file
        $contactName = $_POST["contact"]; # Set $contactName to the contact that corresponds with the button being pressed
        $userID = $_SESSION["userID"]; # Set $userID to the userID of the logged in user

        $sql = "SELECT `userID`, `pubKey`, `privKey` FROM `users` WHERE username='$contactName';"; # SQL statement to fetch the userID, and public Key of the user with the associated username
        $result = mysqli_query($conn, $sql); # Query the database with the SQL statement
        $row = mysqli_fetch_assoc($result); # Set $row to the associated results from the query
        $contactUID = $row["userID"]; # Set $contactUID to the userID fetched from the table
        $_SESSION["contactUID"] = $contactUID;

        if ($userID > $contactUID) { # If the userID is bigger than the contact's userID
            $tableName = sprintf('%08d', (string)$contactUID) . sprintf('%08d', (string)$userID); # make each userID 8 digits long by padding the front with 0s and create a string with the smaller UID first
        } elseif ($contactUID > $userID) { # if the contact's userID is bigger than userID
            $tableName = sprintf('%08d', (string)$userID) . sprintf('%08d', (string)$contactUID); # format the userIDs again and make the string with smaller UID first
        } else {
            echo "something has gone terribly wrong if you are seeing this"; # Only shows when a user has managed to add themselves as a contact or broke the system
        }
        $_SESSION["currentContactTable"] = $tableName; # Set the session variable "currentContactTable to the tableName we generated
        $_SESSION["currentContactPubKey"] = $row["pubKey"]; # Set the session variable "currentContactPubKey to the public key we fetched from the table
        $_SESSION["currentContactPrivKey"] = $row["privKey"];
        header('Location: ../pages/contacts.php'); # Redirect the user to the contacts.php page
    }
?>