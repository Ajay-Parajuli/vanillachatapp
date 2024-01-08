<?php
session_start();

if (isset($_SESSION['unique_id'])) {
    // Include database connection settings
    include_once "env.php";

    // Sanitize and validate input data
    $outgoing_id = (int)$_POST['outgoing_id'];
    $incoming_id = (int)$_POST['incoming_id'];
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Check if the message is not empty
    if (!empty($message)) {
        // Use prepared statements to prevent SQL injection
        $stmt = mysqli_prepare($conn, "INSERT INTO chats (incoming_msg_id, outgoing_msg_id, msg) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "iis", $incoming_id, $outgoing_id, $message);

        // Execute the statement and handle errors
        if (mysqli_stmt_execute($stmt)) {
            // Message inserted successfully
            mysqli_stmt_close($stmt);
        } else {
            // Handle the error (log, display, etc.)
            die("Error: " . mysqli_error($conn));
        }
    }
} else {
    // Redirect to login page if the user is not logged in
    header("location: ../../frontend/login.php");
    exit(); // Always exit after a redirect
}
