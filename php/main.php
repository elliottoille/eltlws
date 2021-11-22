<?php
session_start();

function databaseConnect() {
    $servername = "localhost"; # Name of the server
    $username = "root"; # Username to access database
    $password = "xe5Y_U),xOrdw{Ku#iXD"; # Password of user 'root' to access database

    $database = "eltlws"; # The name of the database to be accessed on the server

    $conn = mysqli_connect($servername, $username, $password, $database); # Create a connection to the database using these variables
    if( !$conn ) { # If the connection fails then
        die("Error: ". mysqli_connect_error()); # Quit and report the error to the terminal
    }
}

function compareStrings($str1, $str2) {
    if ( $str1 == $str2 ) { # If the two inputted strings match then
        return TRUE; # Return true
    } else { # Otherwise
        return FALSE; # Return false
    }
}

function prepUserInput($input) {
    databaseConnect();
    $input = mysqli_real_escape_string($conn, $input);
}

function userSignUp($username, $password, $confirmPassword) {
    databaseConnect();

    if ( compareStrings($password, $confirmPassword) ) {

        $SQL = "SELECT `username` FROM `users` WHERE `username`='$username';";
        $resultOfQuery = mysqli_query($conn, $SQL);
        $numberOfRows = mysqli_num_rows($result);

        if ( $numberOfRows == 0 ) {
            generateEncryptionKeys();
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $SQL = "INSERT INTO `users` ( `username`, `password`, `privKey`, `pubKey`) VALUES ('$username', '$hash', '$private_key', '$public_key');";
            $resultOfQuery = mysqli_query($conn, $SQL);
            userLogIn($username, $password);
        } else {
            echo "a user with that username already exists";
        }
    } else {
        echo "the passwords you entered did not match";
    }
}

function userLogIn($username, $password) {
    databaseConnect();
    
    $SQL = "SELECT * FROM `users` WHERE `username`='$username';";
    $resultOfQuery = mysqli_query($conn, $SQL);
    $dataOfQuery = mysqli_fetch_assoc($resultOfQuery);
    
    if password_verify($password, $dataOfQuery["password"]) {
        echo "the username and password you entered were a valid combination";

        $userID = $dataOfQuery["userID"];
        $publicKey = $dataOfQuery["publicKey"];
        $privateKey = $dataOfQuery["privateKey"];

        $$userID = new user($username, $userID, $publicKey, $privateKey);
    }
}

class user {
    public $username;
    public $userID;
    public $publicKey;

    private $privateKey;

    function __construct($username, $userID, $publicKey, $privateKey) {
        $this->username = $username;
        $this->userID = $userID;
        $this->publicKey = $publicKey;
        $this->privateKey = $privateKey;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function 
}
?>