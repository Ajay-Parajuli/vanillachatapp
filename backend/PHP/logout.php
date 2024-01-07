<?php
session_start();
if (isset($_SESSION['unique_id'])) { // if the user is logged in, destroy the session
    include_once "env.php";
    $logout_id = mysqli_real_escape_string($conn, $_GET['logout_id']);
    if (isset($logout_id)) { // if the logout_id is set in the URL
        $status = "Offline now";
        // once the user is logged out, update the status to "Offline now"
        $sql = mysqli_query($conn, "UPDATE members SET status = '{$status}' 
        WHERE unique_id = {$logout_id}"); // update the status to "Offline now" once the user is logged out
        if ($sql) {
            session_unset();
            session_destroy();
            header("location: ../../frontend/login.php");
        }
    } else { // if the logout_id is not set in the URL
        header("location: ../../frontend/users.php");
    }
}
