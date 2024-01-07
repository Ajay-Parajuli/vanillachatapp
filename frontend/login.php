<?php
session_start();
if (isset($_SESSION['unique_id'])) {
    header("location: users.php");
    exit();
}
?>

<?php
include_once "header.php"; ?>

<body>
    <div class="container">
        <section class="form login">
            <header>ChatUp</header>
            <form action="#">
                <div class="error-txt"></div>
                <div class=" field input">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class=" field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    <i class="fas fa-eye"></i>
                </div>

                <div class="field button">
                    <input type="submit" value="Login">
                </div>
            </form>

            <div class="link">No Account? <a href="index.php">Sign up</a></div>
        </section>
    </div>
    <script src="./js/password-hide.js"></script>
    <script src="./js/login.js"></script>

</body>

</html>