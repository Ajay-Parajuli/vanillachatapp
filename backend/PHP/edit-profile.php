<?php
session_start();
include_once 'env.php';

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];

if (!empty($fname) && !empty($lname)) {
    // Fetch the current status from the database
    $stmt_fetch_status = $conn->prepare("SELECT status FROM members WHERE unique_id = ?");
    $stmt_fetch_status->bind_param("i", $_SESSION['unique_id']);
    $stmt_fetch_status->execute();
    $stmt_fetch_status->bind_result($current_status);
    $stmt_fetch_status->fetch();
    $stmt_fetch_status->close();

    // check if user uploaded a file
    if (isset($_FILES['image'])) { // if file is uploaded
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $img_explode = explode('.', $img_name);
        $img_text = end($img_explode);

        $extensions = ['png', 'jpeg', 'jpg'];

        if (in_array($img_text, $extensions) === true) {
            $time = time();
            $new_img_name = $time . $img_name;

            if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                // Update query for existing user with image and the current status
                $stmt_update_member = $conn->prepare("UPDATE members SET name = ?, lastname = ?, img = ?, status = ? WHERE unique_id = ?");
                $stmt_update_member->bind_param("ssssi", $fname, $lname, $new_img_name, $current_status, $_SESSION['unique_id']);
                $stmt_update_member->execute();
                $stmt_update_member->close();

                echo 'success';
            }
        } else {
            echo 'Please select an image file - jpeg, jpg, png!';
        }
    } else {
        // Update query for existing user without updating the image and using the current status
        $stmt_update_member = $conn->prepare("UPDATE members SET name = ?, lastname = ?, status = ? WHERE unique_id = ?");
        $stmt_update_member->bind_param("sssi", $fname, $lname, $current_status, $_SESSION['unique_id']);
        $stmt_update_member->execute();
        $stmt_update_member->close();

        echo 'success';
    }
} else {
    echo 'First name and last name are required!';
}
