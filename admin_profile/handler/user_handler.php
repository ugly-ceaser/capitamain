<?php

session_start();
require("./conn.php");

// Function to get user details (updated to remove email reference)
function getDetails($userTable, $conn, $id)
{
    $sql = "SELECT * FROM `$userTable` WHERE `id` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    

    $data = $result->fetch_assoc();
    
    
    
    return $data;
}


function getDetailsByEmail($userTable, $conn, $email)
{
    // Prepare the SQL query with a placeholder for the email
    $sql = "SELECT * FROM `$userTable` WHERE `email` = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    // Bind the email parameter as a string (s)
    $stmt->bind_param("s", $email);

    // Execute the prepared statement
    if (!$stmt->execute()) {
        die('Execute failed: ' . $stmt->error);
    }

    // Get the result of the query
    $result = $stmt->get_result();

    if ($result === false) {
        die('Get result failed: ' . $stmt->error);
    }

    // Fetch the associative array from the result
    $data = $result->fetch_assoc();

    // Free the result and close the statement
    $result->free();
    $stmt->close();

    // Return the fetched data
    return $data;
}


// Function to redirect with a message
function redirectWithMessage($location, $message, $type = 'msg') {
    header("Location: $location?$type=" . urlencode($message));
    exit();
}

// Update available balance
if (isset($_POST['update'])) {
    $id = $_POST['update'];
    $amount = floatval($_POST['amount']);

    $query = "UPDATE `verifiedUser` SET `availableBalance` = ? WHERE `id` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("di", $amount, $id);
    
    if ($stmt->execute()) {
        redirectWithMessage('../dashboard.php', 'Update successful', 'suc');
    } else {
        redirectWithMessage('../dashboard.php', 'Update failed', 'err');
    }
}

// this is annoying

// Approve request
if (isset($_GET["approve"])) {
    $id = $_GET["approve"];
    $status = "approved";
    $action = $_GET['action'];

    $query = "UPDATE `$action` SET `status` = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        redirectWithMessage('../pages/reports/pending_requests.php', 'Request approved successfully', 'suc');
    } else {
        redirectWithMessage('../pages/reports/pending_requests.php', 'Approval failed', 'err');
    }
}

// Decline request
if (isset($_GET["decline"])) {
    $id = $_GET["decline"];
    $status = "declined";
    $action = $_GET['action'];

    $query = "UPDATE `$action` SET `status` = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        redirectWithMessage('../pages/reports/pending_requests.php', 'Request declined successfully', 'suc');
    } else {
        redirectWithMessage('../pages/reports/pending_requests.php', 'Decline failed', 'err');
    }
}

// Perform status update
if (isset($_POST["perform"])) {
    $status = $_POST["action"];
    $id = $_POST["user"];

    $query = "UPDATE `users` SET `status` = ? WHERE registration_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        redirectWithMessage('../dashboard.php', 'Status updated successfully', 'suc');
    } else {
        redirectWithMessage('../dashboard.php', 'Status update failed', 'err');
    }
}

// Deposit user
if (isset($_POST['depositUser'])) {
    // Check if all required POST data is set
    if (isset($_POST['amount']) && isset($_POST['userId'])) {
        $amount = floatval($_POST['amount']);
        $userId = $_POST['userId'];

        // Get user details by email (or by user ID, based on your function)
        $details = getDetailsByEmail("users", $conn, $userId);

        // Check if user details were found
        if ($details) {
            $name = $details['fname'];
            $id = $details['id'];
            $email = $details['email'];

            // Generate transaction ID
            $number2 = "01234567890";
            $ran = substr(str_shuffle($number2), 0, 9);
            $transaction_id = "Admin" . $ran;
            $trxtyp = "deposit";
            $status = "approved";
            $coin = "Usdt";
            $network = "Trc20";
            $date = date("Y/m/d");

            // Prepare SQL statement
            $sql = "INSERT INTO `transactions`(`name`, `transaction_id`, `trxType`, `trxStatus`, `trxDate`, `Amount`, `coin`, `network`, `id`, `email`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                // Handle statement preparation error
                redirectWithMessage('../dashboard.php', 'Statement preparation failed: ' . $conn->error, 'err');
                exit();
            }

            // Bind parameters correctly
            $stmt->bind_param("ssssdsdsss", $name, $transaction_id, $trxtyp, $status, $date, $amount, $coin, $network, $id, $email);

            // Execute statement
            if ($stmt->execute()) {
                // Redirect with success message
                redirectWithMessage('../dashboard.php', 'Deposit successful', 'suc');
            } else {
                // Redirect with error message
                redirectWithMessage('../dashboard.php', 'Deposit failed: ' . $stmt->error, 'err');
            }

            // Close the statement
            $stmt->close();
        } else {
            // Redirect with error message if user details not found
            redirectWithMessage('../dashboard.php', 'User not found', 'err');
        }
    } else {
        // Redirect with error message if required POST data is not set
        redirectWithMessage('../dashboard.php', 'Invalid input data', 'err');
    }
}


function deleteUserAndTransactions($conn, $email)
{
    // Start a transaction
    $conn->begin_transaction();

    try {
        // Delete the user from the users table
        $deleteUserSql = "DELETE FROM `users` WHERE `email` = ?";
        $deleteUserStmt = $conn->prepare($deleteUserSql);
        $deleteUserStmt->bind_param("s", $email);
        $deleteUserStmt->execute();

        // Check if the user was deleted
        if ($deleteUserStmt->affected_rows === 0) {
            throw new Exception("No user found with the specified email.");
        }

        // Delete the user's transactions from the transactions table
        $deleteTransactionsSql = "DELETE FROM `transactions` WHERE `email` = ?";
        $deleteTransactionsStmt = $conn->prepare($deleteTransactionsSql);
        $deleteTransactionsStmt->bind_param("s", $email);
        $deleteTransactionsStmt->execute();

        // Commit the transaction
        $conn->commit();

        return true;

    } catch (Exception $e) {
    
       
        $conn->rollback();

        return false;
    } finally {
        // Check if the statements are set before attempting to close them
        if (isset($deleteUserStmt)) {
            $deleteUserStmt->close();
        }
        if (isset($deleteTransactionsStmt)) {
            $deleteTransactionsStmt->close();
        }
    }
}



if (isset($_POST['deleteUser'])) {
    $email = $_POST['email'];

    if (empty($email)) {
        redirectWithMessage('../dashboard.php', 'Please select a user', 'err');
        exit();
    }

    $result = deleteUserAndTransactions($conn, $email);

    if ($result) {
        redirectWithMessage('../dashboard.php', 'User deleted successfully', 'suc');
    } else {
        redirectWithMessage('../dashboard.php', 'Failed to delete user', 'err');
    }
}








// Add profit
if (isset($_POST['userProfit'])) {
    $amount = floatval($_POST['amount']);
    $email = $_POST['email'];

    echo($email);
    echo("<br>");

    $details = getDetailsByEmail("users", $conn, $email);

    var_dump($details);
    echo("<br>");

   
  
    
    $profit = floatval($details["profit"]) + $amount;
    
    $id = $details['id'];

    echo($id);
    die();
    
    

    $query = "UPDATE `users` SET `profit` = ? WHERE `id` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("di", $profit, $id);
    
    if ($stmt->execute()) {
        redirectWithMessage('../dashboard.php', 'Profit added successfully', 'suc');
    } else {
        redirectWithMessage('../dashboard.php', 'Add profit failed', 'err');
    }
}

// Minus profit
if (isset($_POST['minus_profit'])) {
   $amount = floatval($_POST['amount']);
    $email = $_POST['userId'];

   
    try {
        $details = getDetailsByEmail("users", $conn, $email);
        
        $profit = floatval($details["profit"]) - $amount;
        
        $id = $details['id'];

        $query = "UPDATE `users` SET `profit` = ? WHERE `id` = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("di", $profit, $id);
        
        if ($stmt->execute()) {
            redirectWithMessage('../dashboard.php', 'Profit deducted successfully', 'suc');
        } else {
            redirectWithMessage('../dashboard.php', 'Deduct profit failed', 'err');
        }
    } catch (Exception $e) {
        redirectWithMessage('../dashboard.php', 'An error occurred: ' . $e->getMessage(), 'err');
    }
}

// KYC verification
if (isset($_POST['KycVerify'])) {
    $email = $_POST['userId'];
    $status = $_POST['kycAction'];

    $query = "UPDATE `users` SET `kycstatus` = ? WHERE `email` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $status, $email);
    
    if ($stmt->execute()) {
        redirectWithMessage('../dashboard.php', 'KYC status updated successfully', 'suc');
    } else {
        redirectWithMessage('../dashboard.php', 'KYC update failed', 'err');
    }
}

// Update package
if (isset($_POST['updatePackage'])) {
    
    $package = $_POST['package'];
    $email = $_POST['userId'];
    
     $details = getDetailsByEmail("users", $conn, $email);
     
     $id = $details['id'];

    $query = "UPDATE `users` SET `package` = ? WHERE `id` = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("si", $package, $id);
    
    if ($stmt->execute()) {
        redirectWithMessage('../dashboard.php', 'Package updated successfully', 'suc');
    } else {
        redirectWithMessage('../dashboard.php', 'Package update failed', 'err');
    }
}

?>
