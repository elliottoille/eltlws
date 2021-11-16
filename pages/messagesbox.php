<html>
    <head>
        <link rel="stylesheet" href="../styles/messagesbox.css">
    </head>
    <body>
        <?php
            session_start();

            $contactUID = $_SESSION["contactUID"];
            $userID = $_SESSION["userID"];
            $table = $_SESSION["currentContactTable"];
            $privKey = $_SESSION["privateKey"];
            $contPrivKey = $_SESSION["currentContactPrivKey"];
            $pubKey = $_SESSION["publicKey"];
            $contPubKey = $_SESSION["currentContactPubKey"];

            include '../php/dbconnect.php';
            $sql = "SELECT `message`, `userID` FROM `$table`";
            $result = mysqli_query($conn, $sql);
            
            while ($row = mysqli_fetch_assoc($result)) {
                $message = $row['message'];
                $message = hex2bin($message);
                $sender = $row['userID'];
                echo $sender;
                if ($sender == $userID) {
                    openssl_private_decrypt($message, $decrypted, $contPrivKey);
                    $html = '
                    <div id="right" styles="background: aqua;">
                    ' . $decrypted . '
                    </div>
                    ';
                } elseif ($sender == $contactUID) {
                    openssl_private_decrypt($message, $decrypted, $privKey);
                    $html = '
                    <div id="left" styles="background: white;">
                    ' . $decrypted . '
                    </div>
                    ';
                }
                echo $html;
            }
        ?>
    </body>
</html>