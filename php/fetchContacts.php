<?php
session_start();
include 'dbconnect.php';
$sql = "SELECT `high` FROM `userscontacts` WHERE `low`='(int)$_SESSION[`userID`]';";
$result = mysqli_query($conn, $sql);
# $row = mysqli_fetch_assoc($result);
while ($row = mysqli_fetch_assoc($result)) {
    echo var_dump($row);
}
?>