<?php
// Include your database connection and any necessary files
include_once "env.php";

if (isset($_SESSION['unique_id'])) {
    $unique_id = $_SESSION['unique_id'];

    // Prepare and execute the query to get user data based on unique_id
    $stmt = $conn->prepare("SELECT * FROM members WHERE unique_id = ?");
    $stmt->bind_param("s", $unique_id);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Fetch the user data
    $user_data = $result->fetch_assoc();

    // Close the statement
    $stmt->close();
}
