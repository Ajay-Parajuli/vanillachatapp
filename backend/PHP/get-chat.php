<?php
session_start();

if (isset($_SESSION['unique_id'])) {
    include_once "env.php";

    $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);

    $output = "";

    $sql = "SELECT * FROM chats 
            LEFT JOIN members ON members.unique_id = chats.outgoing_msg_id
            WHERE (outgoing_msg_id = ? AND incoming_msg_id = ?) 
            OR (outgoing_msg_id = ? AND incoming_msg_id = ?) 
            ORDER BY msg_id ASC";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiii", $outgoing_id, $incoming_id, $incoming_id, $outgoing_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $imgSrc = isset($row['img']) ? "/backend/PHP/images/{$row['img']}" : "default-image.jpg";

            if ($row['outgoing_msg_id'] == $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="' . $imgSrc . '" alt="img">
                                <div class="details">
                                    <p>' . $row['msg'] . '</p>
                                </div>
                            </div>';
            }
        }
    } else {
        // Handle query error
        $output = "Error in query: " . mysqli_error($conn);
    }

    echo $output;
} else {
    header("location: ../../frontend/login.php");
}
