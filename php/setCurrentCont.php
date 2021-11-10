<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'dbconnect.php';
        $contactName = $_POST["contact"];
        $userID = $_SESSION["userID"];

        $sql = "SELECT `userID`, `pubKey` FROM `users` WHERE username='$contactName';";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $contactUID = $row["userID"];

        if ($userID > $contactUID) { # If the userID1 is bigger than userID2
            $tableName = sprintf('%08d', (string)$contactUID) . sprintf('%08d', (string)$userID); # make each userID 8 digits long by padding the front with 0s and create a string with the smaller UID first
        } elseif ($contactUID > $userID) { # if userID2 is bigger than userID1
            $tableName = sprintf('%08d', (string)$userID) . sprintf('%08d', (string)$contactUID); # format the userIDs again and make the string with smaller UID first
        } else {
            echo "something has gone terribly wrong if you are seeing this";
        }
        $_SESSION["currentContactTable"] = $tableName;
        $_SESSION["currentContactPubKey"] = $row["pubKey"];
        header('Location: ../pages/contacts.php');
    }
?>