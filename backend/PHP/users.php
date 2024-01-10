<?php
session_start();
include_once "env.php";
$outgoing_id = $_SESSION['unique_id'];
$sql = mysqli_query($conn, "SELECT * FROM members WHERE unique_id != '$outgoing_id'");
$output = "";
if (mysqli_num_rows($sql) == 0) {
    $output .= "No other users are available to chat";
} elseif (mysqli_num_rows($sql) > 0) {
    include_once "data.php";
}

echo $output;
