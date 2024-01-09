<?php
session_start();
if (!isset($_SESSION['unique_id'])) {
    header("location: users.php");
    exit();
}
?>

<?php
include_once "header.php";
include_once "../backend/PHP/profile.php"; ?>

<body>
    <div class="container">
        <section class="form edit">
            <header>
                <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <span>| Edit Profile</span>
            </header>
            <form id="editForm" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input ">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" placeholder="First Name" required value="<?php echo isset($user_data['name']) ? $user_data['name'] : ''; ?>">
                    </div>
                    <div class="field input">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Last Name" required value="<?php echo isset($user_data['lastname']) ? $user_data['lastname'] : ''; ?>">
                    </div>
                </div>
                <div class="field image">
                    <label for="image">Select Image</label>
                    <input type="file" name="image" id="image" onchange="displaySelectedImage()">
                    <?php
                    if (isset($user_data['img']) && !empty($user_data['img'])) {
                        $imagePath = '../backend/PHP/images/' . $user_data['img']; // Adjust the path as needed
                        echo '<div id="currentImageContainer">';
                        if (file_exists($imagePath)) {
                            echo '<img src="' . $imagePath . '" alt="Current Image" style="width: 45px; height: 45px; border-radius: 100px;">';
                        } else {
                            echo '<p>No file available</p>';
                        }
                        echo '</div>';
                    }
                    ?>
                </div>

                <div class="field button">
                    <input type="submit" id="submitBtn" value="Confirm">
                </div>
            </form>
        </section>
    </div>
    <script src="./js/profile.js"></script>
</body>

</html>