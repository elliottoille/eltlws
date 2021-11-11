<?php
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") { # If the server recieves a POST request then
        include 'dbconnect.php'; # Include code from dbconnect.php in this document
        if (!(isset($_SESSION['username']))) { # If the user is not logged in then
            echo "you are not logged in"; # tell the user they aren't logged in
        } else {
            newContact(); # run the function below
        }
    }

function newContact() { # define the new function
    include 'dbconnect.php';
    $username = $_POST["username"]; # Sets username equal to the username passed by the POST method
    $userID1 = $_SESSION["userID"]; # Sets userID1 equal to the userID of the logged in user
    $sql = "SELECT `userID` FROM `users` WHERE `username`='$username';"; # SQL code that fetches the associated userID of the username entered by the user
    $result = mysqli_query($conn, $sql); # query the database 
    $row = mysqli_fetch_assoc($result); # store the associated results in the variable row
    $num = mysqli_num_rows($result); # Store the amount of rows fetched from the previous SQL query

    if ($num != 0) { # If the amount of rows returned is not 0 (username is real) then
        $userID2 = $row["userID"]; # set the userID2 to be equal to the one fetched from the table
    } else {
        echo "username doesn't exist"; # This will display on the webpage if something is returned in the initial query
        return; # End function if the username doesn't exist
    }
    
    if ($userID1 > $userID2) { # If the userID1 is bigger than userID2
        $tableName = sprintf('%08d', (string)$userID2) . sprintf('%08d', (string)$userID1); # make each userID 8 digits long by padding the front with 0s and create a string with the smaller UID first
        $low = $userID2; # Set the variable low to the lower userID
        $high = $userID1; # Set the variable high to the higher userID
    } elseif ($userID2 > $userID1) { # if userID2 is bigger than userID1
        $tableName = sprintf('%08d', (string)$userID1) . sprintf('%08d', (string)$userID2); # format the userIDs again and make the string with smaller UID first
        $low = $userID1; # Set the variable low to the lower userID
        $high = $userID2; # Set the variable high to the higher userID
    } else {
        echo "you cannot add yourself as a contact"; # If the userIDs are the same then the user is trying to add themselves as a contact which isn't allowed
        return; # end function if they do this
    }
    $sql = "INSERT INTO `userscontacts` ( `low`, `high`) VALUES ('$low', '$high');"; # Insert the values of low and high into the userContacts table
    $result = mysqli_query($conn, $sql); # Run the previous query

    $sql = "SHOW TABLES WHERE Tables_in_eltlws LIKE '$tableName';"; # Find all tables where 
    $result = mysqli_query($conn, $sql); # Run the query
    $row = mysqli_fetch_assoc($result); # get the associated results
    if (mysqli_num_rows($result) != 0) { # If the num of rows is not 0 then
        if ($row["Tables_in_eltlws"] == $tableName) { # if one of the results matches the table we want to create
            echo "contact already added"; # then output that we already have that user as a contact
        } else {
            $sql = "CREATE TABLE `$tableName`(`messageID` INT NOT NULL AUTO_INCREMENT, `message` TEXT(65535) NOT NULL, `userID` INT NOT NULL, PRIMARY KEY (`messageID`), FOREIGN KEY (`userID`) REFERENCES `users`(`userID`));";
            $result = mysqli_query($conn, $sql); # otherwise create a new table with the name of the table we just generated
        } 
    } else {
        $sql = "CREATE TABLE `$tableName`(`messageID` INT NOT NULL AUTO_INCREMENT, `message` TEXT(65535) NOT NULL, `userID` INT NOT NULL, PRIMARY KEY (`messageID`), FOREIGN KEY (`userID`) REFERENCES `users`(`userID`));";
        $result = mysqli_query($conn, $sql); # otherwise create a new table with the name of the table we just generated
    }  
}
?>