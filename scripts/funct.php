<?php
session_start();
include './conn.php';

// To avoid SQL injections and sanitize input
function test_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Function to generate random numbers
function randomGen($min, $max, $quantity)
{
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}

// Function to encrypt and decrypt strings
function encrypt_decrypt($string, $action = 'encrypt')
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'AA74CDCCrferefesc2BBRT935136HH7B63C27'; // User-defined private key
    $secret_iv = '5fgf54645dsfdfsfc5HJ5g27'; // User-defined secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);

    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } elseif ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }

    return $output;
}

// Registration process
if (isset($_POST["register"])) {
    $fname = test_input($_POST['fname']);
    $username = test_input($_POST['username']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $confirm_password = test_input($_POST['confirmPassword']);
    $referree_code = test_input($_POST['referalCode']);
    $package = test_input($_POST['package']);
    $terms = test_input($_POST['terms']);
    $registration_date = date('Y-m-d');

    // Validate password match
    if ($password != $confirm_password) {
        header("location:../Register.php?msg=" . urlencode("Password not matched"));
        exit;
    }

    // Hash the password
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $check_query = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        header("location:../Register.php?msg=" . urlencode("Email already exists"));
        exit;
    }

    // Insert new user into database
    $insert_query = "INSERT INTO users (fname, email, username, password, package, registration_date, referral) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("sssssss", $fname, $email, $username, $password, $package, $registration_date, $referree_code);

    if ($stmt->execute()) {
        // Send confirmation email
        $from = "support@fusionflexi.com";
        $to = $email;
        $subject = "Congratulations $fname";
        $message = "
            <html>
            <head>
            <title>fusion flexi</title>
            </head>
            <body>
            <img src='https://capitamain.com/userPage/dist/img/logo.png' alt='fusion flexi Logo Image'><br>
            <p>Your registration with fusion flexi has been successfully completed.</p>
            <p>Please log in with the following credentials:</p>
            <p>Username: $username</p>
            <p>Password: (Your chosen password)</p>
            <h4>Thank you</h4>
            <small>Contact Us at support@capitamain.com</small>
            </body>
            </html>";
        
        $headers = "From: $from\r\n";
        $headers .= "Cc: $from\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html\r\n";

        if (mail($to, $subject, $message, $headers)) {
            header("location:../login.php?msg=" . urlencode("Registration successful, please login"));
            exit;
        } else {
            header("location:../login.php?msg=" . urlencode("Registration successful, but failed to send confirmation email. Please contact support."));
            exit;
        }
    } else {
        echo "Error: " . $stmt->error;
        exit;
    }
}

// Login process
if (isset($_POST["login"])) {
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);

    // Prepare the query using prepared statements
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Debugging statement to verify the stored hashed password
        error_log("Stored hash: " . $row["password"]);
        error_log("Provided password: " . $password);

       $feed = $password == $row["password"];
       
      
        if ($feed) {
            // Password is correct, set session variables
            $_SESSION["email"] = $row['email'];
            $_SESSION["name"] = $row['fname'];
            $_SESSION["balance"] = $row['balance']; // Example: adjust as per your database structure

            // Redirect to user page
            header("location:../userPage/index.php");
            exit;
        } else {
            // Incorrect password
            header("location:../login.php?msg=" . urlencode("Wrong password"));
            exit;
        }
    } else {
        // Username not found
        header("location:../login.php?msg=" . urlencode("Wrong Details"));
        exit;
    }
}
?>
