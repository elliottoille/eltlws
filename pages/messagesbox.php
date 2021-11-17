<html>
    <head>
        <link rel="stylesheet" href="../styles/messagesbox.css"> <!-- Link the CSS style sheet to this file -->
    </head>
    <body>
        <?php
            session_start(); # Start a session

            $contactUID = $_SESSION["contactUID"]; # Fetch contactUID from session variables
            $userID = $_SESSION["userID"]; # Fetch logged in user's ID from session variables
            $table = $_SESSION["currentContactTable"]; # Fetch the name of the current conversation's table from session variables
            $privKey = $_SESSION["privateKey"]; # Fetch the logged in user's private key from session variables
            $contPrivKey = $_SESSION["currentContactPrivKey"]; # Fetch the contact's private key from session variables

            include '../php/dbconnect.php'; # Include 'dbconnect.php' in this file
            $sql = "SELECT `message`, `userID` FROM `$table`"; # SQL statement to select every message and userID from the current table
            $result = mysqli_query($conn, $sql); # Query the database with the previous SQL statement
            
            while ($row = mysqli_fetch_assoc($result)) { # For every set of results returned by the query
                $message = $row['message']; # Set message to this loop's message
                $message = hex2bin($message); # Convert the message from hexidecimal to binary
                $sender = $row['userID']; # Set sender to the user who sent the message
                if ($sender == $userID) { # If the sender is the logged in user then
                    openssl_private_decrypt($message, $decrypted, $contPrivKey); # Decrypt the message with the contacts private key
                    $html = '
                    <div id="stretch">
                        <div id="right" class="message">
                        ' . $decrypted . '
                        </div>
                    </div>
                    '; # HTML code that displays the decrypted message in a DIV element
                } elseif ($sender == $contactUID) { # if the sender was the contact then
                    openssl_private_decrypt($message, $decrypted, $privKey); # Decrypt with the logged in users private key
                    $html = '
                    <div id="stretch">
                        <div id="left" class="message">
                        ' . $decrypted . '
                        </div>
                    </div>
                    '; # HTML code that displays the decrypted message in a DIV element
                }
                echo $html; # Display the HTML code on screen once it has been set
            }
        ?>
    </body>
</html>