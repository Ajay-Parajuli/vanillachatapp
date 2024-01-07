<?php
include_once "header.php"; ?>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="" alt="user_img">
                <div class="details">
                    <span>Ajay Parajuli</span>
                    <p>Active Now</p>
                </div>
            </header>
            <div class="chat-box">

            </div>
            <form action="#" class="typing-area">
                <input type="text" name="outgoing_id" value="" hidden>
                <input type="text" name="incoming_id" value="" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here...">
                <button><i class="fab fa-telegram-plane"></i></button>
        </section>
    </div>
    <script src="./js/chat.js"></script>
</body>

</html>