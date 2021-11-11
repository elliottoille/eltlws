<?php
include 'dbconnect.php'; # include code from dbconnect.php in this file
$userID = $_SESSION['userID']; # set the variable userID to the logged in user's userID
$sql = "SELECT `high` FROM `userscontacts` WHERE `low`='$userID';"; # Select records where the low variable matches userID
$result = mysqli_query($conn, $sql); # Query the database for this
while ($row = mysqli_fetch_assoc($result)) { # While there are unchecked rows
    $contact = $row['high']; # set $contact to the fetched value
    $sql = "SELECT `username` FROM `users` WHERE userID=$contact;"; # Select the username associated with this userID
    $resultName = mysqli_query($conn, $sql); # Query the database with the SQL statement
    $contactName = mysqli_fetch_assoc($resultName); # set the contactName variable to the username fetched from query
    $contactName = $contactName['username']; # Redefine contactName with the actual username
    $contactBox = '<li>
    <form action="..\php\setCurrentCont.php" method="POST">
        <button name="contact" value=' . $contactName . ' type="submit">' . $contactName . '</button>
    </form>
</li>'; # Set this variable to some html code that renders a button inside of a list item, named for each contact
    echo $contactBox; # Print this HTML code on the site
}
$sql = "SELECT `low` FROM `userscontacts` WHERE `high`='$userID';"; # Do the same as the first section for the otherside of the column
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $contact = $row['low'];
    $sql = "SELECT `username` FROM `users` WHERE userID=$contact;";
    $resultName = mysqli_query($conn, $sql);
    $contactName = mysqli_fetch_assoc($resultName);
    $contactName = $contactName['username'];
    $contactBox = '<li>
    <form action="..\php\setCurrentCont.php" method="POST">
        <button name="contact" value=' . $contactName . ' type="submit">' . $contactName . '</button>
    </form>
</li>';
    echo $contactBox;
}
?>