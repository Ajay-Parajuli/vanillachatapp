<?php
include_once "header.php"; ?>

<body>
    <div class="container">
        <section class="users">
            <header>
                <div class="content">
                    <img src="" alt="user_img">
                    <div class="details">
                        <span>
                            Ajay Parajuli
                        </span>
                        <p>Offline now</p>
                    </div>
                </div>
                <a href="php/logout.php>" class="logout">Logout</a>

            </header>
            <div class="search">
                <span class="text">Select an user to start chat</span>
                <input type="text" placeholder="Enter name to search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users-list">
            </div>
        </section>
    </div>
    <script src="./js/users.js"></script>
</body>

</html>