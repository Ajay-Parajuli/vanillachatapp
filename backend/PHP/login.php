<?php
session_start();
include_once 'env.php';

$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($email) && !empty($password)) {
    // Retrieve user data based on email
    $sql = mysqli_query($conn, "SELECT * FROM members WHERE email = '{$email}'");

    if (mysqli_num_rows($sql) > 0) {
        $rows = mysqli_fetch_assoc($sql);
        // Verify the entered password against the hashed password in the database
        if (password_verify($password, $rows['password'])) {
            $status = "Active now"; // once the user logged in, his status will be active now
            $sql2 = mysqli_query($conn, "UPDATE members SET status = '{$status}' WHERE unique_id = {$rows['unique_id']}");

            if ($sql2) {
                $_SESSION['unique_id'] = $rows['unique_id']; // using this session we used user unique_id in other php file
                echo 'success';
            }
        } else {
            echo 'Email or Password is incorrect!';
        }
    } else {
        echo 'Email or Password is incorrect!';
    }
} else {
    echo 'All input fields are required!';
}
