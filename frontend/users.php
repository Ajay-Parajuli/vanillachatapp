<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: login.php");
    exit();
}
?>
<?php
include_once "header.php"; ?>

<body>
    <div class="container">
        <section class="users">
            <header>
                <?php
                include_once "../backend/PHP/env.php";
                $sql = mysqli_query($conn, "SELECT * FROM members WHERE unique_id = {$_SESSION['unique_id']}"); // get the user details
                if (mysqli_num_rows($sql) > 0) {
                    $row = mysqli_fetch_assoc($sql);
                }
                ?>
                <div class="content">
                    <img src="../backend/PHP/images/<?php echo $row['img'] ?>" alt="user_img">
                    <div class="details">
                        <span><?php
                                echo $row['name'] . " " . $row['lastname'];
                                ?></span>
                        <div class="status-link">
                            <p><?php echo $row['status']; ?></p>
                            <span>| <a class="edit-prof" href="profile-edit.php">Edit</a></span>
                        </div>
                    </div>
                </div>
                <a href="../backend/PHP/logout.php?logout_id=<?php echo $row['unique_id'] ?>" class="logout">Logout</a>

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