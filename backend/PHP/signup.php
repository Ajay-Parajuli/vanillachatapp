<?php
session_start();
include_once 'env.php';

$fname = $_POST['firstname'];
$lname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($fname) && !empty($lname) && !empty($email) && !empty($password)) {
    // check users email is valid or not
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // check if email already exists in the database
        $stmt_check_email = $conn->prepare("SELECT email FROM members WHERE email = ?");
        $stmt_check_email->bind_param("s", $email);
        $stmt_check_email->execute();
        $stmt_check_email->store_result();

        if ($stmt_check_email->num_rows > 0) {
            echo "$email - This email already exists!";
        } else {
            // Password validation
            if (strlen($password) >= 7 && preg_match('/[A-Z]/', $password) && preg_match('/[0-9]/', $password)) {
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
                            $status = "Active now";
                            $random_id = rand(time(), 10000000);

                            $hashed_password = password_hash($password, PASSWORD_BCRYPT); // Hash the password

                            $stmt_insert_member = $conn->prepare("INSERT INTO members (unique_id, name, lastname, email, password, img, status) VALUES (?, ?, ?, ?, ?, ?, ?)"); // insert into database
                            $stmt_insert_member->bind_param("issssss", $random_id, $fname, $lname, $email, $hashed_password, $new_img_name, $status);
                            $stmt_insert_member->execute();
                            $stmt_insert_member->close();

                            $stmt_select_member = $conn->prepare("SELECT * FROM members WHERE email = ?");
                            $stmt_select_member->bind_param("s", $email);
                            $stmt_select_member->execute();
                            $result = $stmt_select_member->get_result();

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $_SESSION['unique_id'] = $row['unique_id'];
                                echo 'success';
                            }
                            $stmt_select_member->close();
                        }
                    } else {
                        echo 'Please select an image file - jpeg, jpg, png!';
                    }
                } else {
                    echo 'Please select an image file!';
                }
            } else {
                echo 'Password must be at least 7 characters with at least one uppercase letter and number!';
            }
        }
        $stmt_check_email->close();
    } else {
        echo "$email - This email is not valid!";
    }
} else {
    echo 'All input fields are required!';
}
