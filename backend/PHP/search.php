<?php
session_start();
include_once "env.php";
$outgoing_id = $_SESSION['unique_id'];
$searchTerm = mysqli_real_escape_string($conn, $_POST['searchTerm']);
$output = "";
$sql = mysqli_query($conn, "SELECT * FROM members  WHERE name LIKE '%{$searchTerm}%' OR lastname LIKE '%{$searchTerm}%'"); // get all the users  
if (mysqli_num_rows($sql) > 0) { // if there are more than one user
    include_once "data.php";
} else {
    $output .= "No users founde related to your search term";
}

echo $output;
