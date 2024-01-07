<?php
include_once "header.php"; ?>

<body>
    <div class="container">
        <section class="form signup">
            <header>ChatUp</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"></div>
                <div class="name-details">
                    <div class="field input ">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" placeholder="First Name" required>
                    </div>
                    <div class="field input">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" placeholder="Last Name" required>
                    </div>
                </div>
                <div class=" field input">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" placeholder="Enter your email" required>
                </div>
                <div class=" field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field image">
                    <label for="image">Select Image</label>
                    <input type="file" name="image" id="image" required>
                </div>
                <div class="field button">
                    <input type="submit" value="Sign Up">
                </div>
            </form>
            <div class="link">Already Signed up? <a href="login.php">Login Now</a></div>
        </section>
    </div>
</body>
<script src="./js/password-hide.js"></script>
<script src="./js/signup.js"></script>

</html>