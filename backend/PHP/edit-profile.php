<?php
session_start();
include_once 'env.php';

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];

if (!empty($fname) && !empty($lname)) {
    // Fetch the current status and old image name from the database
    $stmt_fetch_data = $conn->prepare("SELECT status, img FROM members WHERE unique_id = ?");
    $stmt_fetch_data->bind_param("i", $_SESSION['unique_id']);
    $stmt_fetch_data->execute();
    $stmt_fetch_data->bind_result($current_status, $old_img_name);
    $stmt_fetch_data->fetch();
    $stmt_fetch_data->close();

    // Check if user uploaded a new file
    if (isset($_FILES['image'])) {
        $img_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];

        $img_explode = explode('.', $img_name);
        $img_text = end($img_explode);

        $extensions = ['png', 'jpeg', 'jpg'];

        if (in_array($img_text, $extensions) === true) {
            $time = time();
            $new_img_name = $time . $img_name;

            // Delete the old image file if it exists
            if (!empty($old_img_name) && file_exists("images/" . $old_img_name)) {
                unlink("images/" . $old_img_name);
            }

            // Move the newly uploaded file
            if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                // Update query for existing user with the new image and the current status
                $stmt_update_member = $conn->prepare("UPDATE members SET name = ?, lastname = ?, img = ?, status = ? WHERE unique_id = ?");
                $stmt_update_member->bind_param("ssssi", $fname, $lname, $new_img_name, $current_status, $_SESSION['unique_id']);
                $stmt_update_member->execute();
                $stmt_update_member->close();

                echo 'success';
            } else {
                echo 'Failed to move the uploaded file!';
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
    echo 'Firstname and lastname are required!';
}
