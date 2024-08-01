<?php
// // commented out te former database
$servername = "localhost";
$username = "capitama_user";
$password = "marti08139110216";
$dbname = "capitama_data";

// // // commented out te former database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "data";

// Create a new PDO instance
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    error_log("Connection failed: " . $e->getMessage());
    exit('Database connection failed');
}

// Check if the test_input function is not defined before defining it
if (!function_exists('test_input')) {
    function test_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
}

if (isset($_POST['accountUpdate'])) {
    $coin = test_input($_POST["coin"]);
    $address = test_input($_POST['walletAddress']);
    $name = test_input($_POST["walletName"]);

    if (isset($_FILES["barcode"]) && $_FILES["barcode"]["error"] == 0) {
        // Define allowed MIME types
        $allowed = array(
            "image/jpg",
            "image/jpeg",
            "image/gif",
            "image/png",
            "image/bmp",
            "image/webp",
            "image/svg+xml",
            "image/tiff",
            "image/vnd.microsoft.icon",
            "image/avif"
        );

        $filename = $_FILES["barcode"]["name"];
        $filetype = $_FILES["barcode"]["type"];
        $filesize = $_FILES["barcode"]["size"];

        // Verify MIME type
        if (!in_array($filetype, $allowed)) {
            header("Location: ../dashboard.php?msg=Invalid file format");
            exit;
        }

        // Verify file size
        if ($filesize > 5 * 1024 * 1024) { // 5MB limit
            header("Location: ../dashboard.php?msg=File size exceeds limit");
            exit;
        }

        // Check if the file already exists
        if (file_exists("./uploads/" . $filename)) {
            header("Location: ../dashboard.php?msg=File already exists");
            exit;
        } else {
            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($_FILES["barcode"]["tmp_name"], "./uploads/" . $filename)) {
                // Build the SQL query
                $sql = "UPDATE `admin` SET ";
                if ($coin == "btc") {
                    $sql .= "`btcAddress` = :address, `btcImg` = :filename";
                } elseif ($coin == "eth") {
                    $sql .= "`ethAddress` = :address, `ethImg` = :filename";
                } elseif ($coin == "usdt") {
                    $sql .= "`usdtAddress` = :address, `usdtImg` = :filename";
                }
                $sql .= " WHERE `id` = :id";

                $id = '1';

                // Prepare and execute the statement
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':filename', $filename);
                $stmt->bindParam(':id', $id); // Assuming you have a session variable for the user ID

                if ($stmt->execute()) {
                    header('Location: ../dashboard.php?suc=Update successful');
                } else {
                    // Output error info for debugging
                    $errorInfo = $stmt->errorInfo();
                    header("Location: ../dashboard.php?msg=Update failed: " . $errorInfo[2]);
                }
                exit;
            } else {
                header("Location: ../dashboard.php?msg=Failed to move uploaded file");
                exit;
            }
        }
    } else {
        header("Location: ../dashboard.php?msg=File upload error");
        exit;
    }
}




// Function to get all users
function getUsers($conn) {
    $query = "SELECT * FROM users";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Function to get a single user by ID
function getUser($conn, $id) {
    $query = "SELECT * FROM users WHERE registration_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Function to get pending transactions
function pendingTransact($conn, $tableName) {
    $query = "SELECT * FROM $tableName WHERE status = 'pending'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

//chilling

// Function to get all transactions (general)
function allTransact($conn) {
    $query = "SELECT * FROM GeneralAccount";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Handle detail updates
if (isset($_POST['detailUpdate'])) {
    $username = test_input($_POST["username"]);
    $password = test_input($_POST["password"]);

    $sql = "UPDATE `admin` SET `Username` = :username, `password` = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        header("Location: ../dashboard.php?msg=Update successful");
    } else {
        header("Location: ../dashboard.php?msg=Update failed");
    }
    exit;
}

// Function to get sent messages for a user
function getUsersentMessage($conn, $userId) {
    $query = "SELECT * FROM messages WHERE senderId = :userId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Function to get received messages for a user
function getUserMessage($conn, $userId) {
    $query = "SELECT * FROM messages WHERE recieverId = :userId";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    return $stmt->fetchAll();
}

// Handle Deposit Approved
if (isset($_POST["DepositApproved"])) {
    $transaction_id = test_input($_POST["transact_id"]);
    $user_id = test_input($_POST["user"]);
    $status = "approved";

    try {
        $query = "UPDATE transactions SET trxStatus = :status WHERE transaction_id = :transaction_id AND email = :user_id AND trxType = 'deposit'";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':transaction_id', $transaction_id);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            header("Location: ../dashboard.php?msg=Deposit approved successfully");
        } else {
            header("Location: ../dashboard.php?msg=Failed to approve deposit");
        }
        exit;
    } catch (PDOException $e) {
        error_log("Error updating transaction status: " . $e->getMessage());
        header("Location: ../dashboard.php?msg=Failed to approve deposit");
    }
}

// Handle Deposit Declined
if (isset($_POST["DepositDeclined"])) {
    $transaction_id = test_input($_POST["transact_id"]);
    $user_id = test_input($_POST["user"]);
    $status = "declined";

    $query = "UPDATE transactions SET trxStatus = :status WHERE transaction_id = :transaction_id AND email = :user_id AND trxType = 'deposit'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':transaction_id', $transaction_id);
    $stmt->bindParam(':user_id', $user_id);

    if ($stmt->execute()) {
        header("Location: ../dashboard.php?msg=Deposit declined successfully");
    } else {
        header("Location: ../dashboard.php?msg=Failed to decline deposit");
    }
    exit;
}

// Handle Withdrawal Approved
if (isset($_POST["WithdrawalApproved"])) {
    $transaction_id = test_input($_POST["transact_id"]);
    $user_id = test_input($_POST["user"]);
    $status = "approved";

    $query = "UPDATE transactions SET trxStatus = :status WHERE transaction_id = :transaction_id AND email = :user_id AND trxType = 'withdraw'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':transaction_id', $transaction_id);
    $stmt->bindParam(':user_id', $user_id);

    if ($stmt->execute()) {
        header("Location: ../dashboard.php?msg=Withdrawal approved successfully");
    } else {
        header("Location: ../dashboard.php?msg=Failed to approve withdrawal");
    }
    exit;
}

// Handle Withdrawal Declined
if (isset($_POST["WithdrawalDeclined"])) {
    $transaction_id = test_input($_POST["transact_id"]);
    $user_id = test_input($_POST["user"]);
    $status = "declined";

    $query = "UPDATE transactions SET trxStatus = :status WHERE transaction_id = :transaction_id AND email = :user_id AND trxType = 'withdraw'";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':transaction_id', $transaction_id);
    $stmt->bindParam(':user_id', $user_id);

    if ($stmt->execute()) {
        header("Location: ../dashboard.php?msg=Withdrawal declined successfully");
    } else {
        header("Location: ../dashboard.php?msg=Failed to decline withdrawal");
    }
    exit;
}

// Function to calculate total amount
function calculateTotalAmount($pdo, $trxType, $trxStatus) {
    $sql = "SELECT SUM(Amount) AS total FROM transactions WHERE trxType = :trxType AND trxStatus = :trxStatus";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':trxType', $trxType);
    $stmt->bindParam(':trxStatus', $trxStatus);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row["total"] ?? 0;
}
?>
