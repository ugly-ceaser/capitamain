<?php

include 'header.php';

$error_message = isset($_GET['msg']) ? $_GET['msg'] : '';

?>

   <section class="hero" id="hero" data-aos="fade-down">
    <div class="container">
        <form action="./scripts/funct.php" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputFullName">Full Name</label>
                    <input type="text" class="form-control" id="inputFullName" placeholder="Enter Your Full Name" name="fname" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputUsername">Username</label>
                    <input type="text" class="form-control" id="inputUsername" placeholder="Enter Your Unique Username" name="username" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword">Password</label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputConfirmPassword">Confirm Password</label>
                    <input type="password" class="form-control" id="inputConfirmPassword" placeholder="Confirm Password" name="confirmPassword" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputReferee">Referee</label>
                    <input type="text" class="form-control" id="inputReferee" placeholder="Enter Your Referee Code" name="referalCode">
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPackage">Package</label>
                    <select id="inputPackage" class="form-control" name="package" required>
                        <option selected>Choose...</option>
                        <option value="basic">Basic</option>
                        <option value="standard">Standard</option>
                        <option value="pro">Pro</option>
                        <option value="advance">Advance</option>
                    </select>
                </div>
                <div class="form-check col-md-12 mt-3 mb-3">
                    <input type="checkbox" class="form-check-input" id="inputTerms" name="terms" required>
                    <label class="form-check-label" for="inputTerms">I agree to the <a href="#">Terms and Conditions</a> of the investment</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="register">Sign up</button>
            <small id="emailHelp" class="form-text text-muted">Already have an account? <a href="login.php">Login here</a>.</small>
            <?php if (!empty($error_message)) : ?>
                <div class="alert alert-danger mt-3" role="alert">
                    <?php echo htmlspecialchars($error_message); ?>
                </div>
            <?php endif; ?>
        </form>
    </div>
</section>





<?php

include 'footer.php';

?>



