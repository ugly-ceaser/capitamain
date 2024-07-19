<?php

include 'header.php';

$error_message = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<section class="hero" id="hero" data-aos="fade-down">
    <div class="container d-flex justify-content-center">
        <form method="post" action="./scripts/funct.php">
            <div class="form-group">
                <label for="inputUsername">Username</label>
                <input type="text" class="form-control" id="inputUsername" placeholder="Enter Username" name="username" required>
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="inputRememberMe">
                <label class="form-check-label text-secondary" for="inputRememberMe" >Remember Me</label>
            </div>
            <button type="submit" class="btn  mt-3" style="background-color:#B2721C;" name="login">Login</button>
            <br>
            <?php if (!empty($error_message)) : ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
            <small id="emailHelp" class="form-text text-dark">Don't have an account? <a href="./Register.php">Register here</a>.</small>
        </form>
    </div>
</section>



<?php

include 'footer.php';

?>





