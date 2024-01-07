<?php
session_start();
include_once "env.php";
$outgoing_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM members"); // get all the users
$output = "";
if (mysqli_num_rows($sql) == 1) { // if there is only one user
    $output .= "No users are available to chat";
} elseif (mysqli_num_rows($sql) > 0) { // if there are more than one user
    include_once "data.php";
}

echo $output;
