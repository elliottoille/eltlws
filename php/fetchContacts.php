<?php
include 'dbconnect.php';
$userID = $_SESSION['userID'];
$sql = "SELECT `high` FROM `userscontacts` WHERE `low`='$userID';";
$result = mysqli_query($conn, $sql);
#$row = mysqli_fetch_assoc($result);
while ($row = mysqli_fetch_assoc($result)) {
    $contact = $row['high'];
    $sql = "SELECT `username` FROM `users` WHERE userID=$contact;";
    $resultName = mysqli_query($conn, $sql);
    $contactName = mysqli_fetch_assoc($resultName);
    $contactName = $contactName['username'];
    $contactBox = '<li><a href=' . $contactName . ' target="messages">' . $contactName . '</a></li>';
    echo $contactBox;
}
$sql = "SELECT `low` FROM `userscontacts` WHERE `high`='$userID';";
$result = mysqli_query($conn, $sql);
#$row = mysqli_fetch_assoc($result);
while ($row = mysqli_fetch_assoc($result)) {
    $contact = $row['low'];
    $sql = "SELECT `username` FROM `users` WHERE userID=$contact;";
    $resultName = mysqli_query($conn, $sql);
    $contactName = mysqli_fetch_assoc($resultName);
    $contactName = $contactName['username'];
    $contactBox = '<li><a href=' . $contactName . ' target="messages">' . $contactName . '</a></li>';
    echo $contactBox;
}
?>