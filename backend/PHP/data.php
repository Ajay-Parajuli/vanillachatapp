<?php
while ($row = mysqli_fetch_assoc($sql)) { // loop through all the rows
    $sql2 = "SELECT * FROM chats WHERE (incoming_msg_id = {$row['unique_id']} 
            OR outgoing_msg_id = {$row['unique_id']}) AND (outgoing_msg_id = {$outgoing_id}
            OR incoming_msg_id = {$outgoing_id}) ORDER BY msg_id DESC LIMIT 1"; // get the last message

    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);

    if ($row2 !== null) { // Check if $row2 is not null
        if (mysqli_num_rows($query2) > 0) {
            $result = $row2['msg'];
        } else {
            $result = "No message available";
        }

        (strlen($result) > 28) ? $msg = substr($result, 0, 28) . '...' : $msg = $result; // if the message is longer than 28 characters, truncate it

        ($outgoing_id == $row2['outgoing_msg_id']) ? $you = "You: " : $you = ""; // if the message is from the user, add "You: " before the message

    } else {
        $msg = "No message available";
        $you = "";
    }

    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = ""; // if the user is offline, add "offline" to the class list

    $query2 = mysqli_query($conn, $sql2);
    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] . '">
                   <div class="content">
                       <img src="/backend/PHP/images/' . $row['img'] . '" alt="user_img">
                       <div class="details">
                         <span>' . $row['name'] . " " . $row['lastname'] . '</span>
                         <p>' . $you . $msg . '</p>
                       </div>
                  </div>
                  <div class="status-dot ' . $offline . '">
                      <i class="fas fa-circle"></i>
                  </div>
               </a>';
}
