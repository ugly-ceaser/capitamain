<?php

// // commented out te former database
$servername = "localhost";
$username = "capitama_user";
$password = "marti08139110216";
$dbname = "capitama_data";


// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// to avoid sql injections
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//to generate Random numbers
function randomGen($min, $max, $quantity)
{
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}



function update_balance_by_email($email, $new_balance, $conn) {
  $email = mysqli_real_escape_string($conn, $email);
  $new_balance = mysqli_real_escape_string($conn, $new_balance);
  $sql = "UPDATE users SET balance = '{$new_balance}' WHERE email = '{$email}'";
  mysqli_query($conn, $sql);
}


function update_invest_by_email($email, $new_invest, $conn) {
  $email = mysqli_real_escape_string($conn, $email);
  $new_balance = mysqli_real_escape_string($conn, $new_invest);
  $sql = "UPDATE users SET investedAmount = '{$new_invest}' WHERE email = '{$email}'";
  mysqli_query($conn, $sql);
}


function update_plan_by_email($email, $plan, $conn) {
  $email = mysqli_real_escape_string($conn, $email);
  $new_balance = mysqli_real_escape_string($conn, $plan);
  $sql = "UPDATE users SET package = '{$plan}' WHERE email = '{$email}'";
  mysqli_query($conn, $sql);
}


function encrypt_decrypt($string, $action = 'encrypt')
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'AA74CDCCrferefesc2BBRT935136HH7B63C27'; // user define private key
    $secret_iv = '5fgf54645dsfdfsfc5HJ5g27'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}


function getDetails($userTable, $conn,$email)
{




    $sql = "SELECT * FROM `$userTable` WHERE `email` = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
    }


    return $row;
}

function get_total($conn, $transaction_type, $status)
{
    // Start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Ensure email is set in the session
    if (!isset($_SESSION['email'])) {
        return 0; // or handle error appropriately
    }

    // Escape variables to prevent SQL injection
    $email = $_SESSION['email'];
    
    $transaction_type = mysqli_real_escape_string($conn, $transaction_type);
    $status = mysqli_real_escape_string($conn, $status);

    // Prepare SQL statement
    $sql = "SELECT SUM(amount) AS total_deposit FROM `transactions` WHERE email = '$email' AND trxType = '$transaction_type' AND trxStatus = '$status'";

    // Execute statement
    $result = mysqli_query($conn, $sql);

    if (!$result) {
        // Print error message if statement execution failed
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        return 0; // or handle error appropriately
    } else {
        // Fetch result
        $row = mysqli_fetch_assoc($result);
        $total_deposit = $row['total_deposit'] !== null ? $row['total_deposit'] : 0;


        mysqli_free_result($result);
    }


    return $total_deposit;
}


function get_transactions($email, $conn, $table_name)
{
    // prepare SQL statement
    $sql = "SELECT * FROM $table_name WHERE email = '$email'";

    // execute statement
    $result = mysqli_query($conn, $sql);

    // check if any records were returned
    if (mysqli_num_rows($result) > 0) {
        // create empty array to hold records
        $records = array();

        // loop through result set and add each record to array
        while ($row = mysqli_fetch_assoc($result)) {
            $records[] = $row;
        }

        // free result set
        mysqli_free_result($result);

        // return records as object
        return (object) $records;
    } else {
        // no records found, return null
        return null;
    }
}


function get_transactions_by_type($email, $conn, $table_name, $trxType)
{
    // prepare SQL statement
    $sql = "SELECT * FROM $table_name WHERE email = '$email' AND trxType = '$trxType'";

    // execute statement
    $result = mysqli_query($conn, $sql);

    // check if any records were returned
    if (mysqli_num_rows($result) > 0) {
        // create empty array to hold records
        $records = array();

        // loop through result set and add each record to array
        while ($row = mysqli_fetch_assoc($result)) {
            $records[] = $row;
        }

        // free result set
        mysqli_free_result($result);

        // return records as object
        return (object) $records;
    } else {
        // no records found, return null
        return null;
    }
}


function get_transactions_by_type_status($email, $conn, $table_name, $trxType,$trxStatus)
{
    // prepare SQL statement
    $sql = "SELECT * FROM $table_name WHERE email = '$email' AND trxType = '$trxType' AND trxStatus = '$trxStatus' ORDER BY trxDate DESC LIMIT 5";

    // execute statement
    $result = mysqli_query($conn, $sql);

    // check if any records were returned
    if (mysqli_num_rows($result) > 0) {
        // create empty array to hold records
        $records = array();

        // loop through result set and add each record to array
        while ($row = mysqli_fetch_assoc($result)) {
            $records[] = $row;
        }

        // free result set
        mysqli_free_result($result);

        // return records as object
        return (object) $records;
    } else {
        // no records found, return null
        return null;
    }
}



function get_all_transactions($email, $conn, $table_name)
{
    // prepare SQL statement
    $sql = "SELECT * FROM $table_name WHERE email = '$email' AND (trxType = 'deposit' OR trxType = 'withdraw')";

    // execute statement
    $result = mysqli_query($conn, $sql);

    // check if any records were returned
    if (mysqli_num_rows($result) > 0) {
        // create empty array to hold records
        $records = array();

        // loop through result set and add each record to array
        while ($row = mysqli_fetch_assoc($result)) {
            $records[] = $row;
        }

        // free result set
        mysqli_free_result($result);

        // return records as object
        return (object) $records;
    } else {
        // no records found, return null
        return null;
    }
}



if (isset($_POST['deposit'])) {
    session_start();
    $name = $_SESSION['name'];
    $email = filter_var($_SESSION['email'], FILTER_VALIDATE_EMAIL);
    $transaction_id = implode("", randomGen(0, 20, 10));
    $trxtyp = "deposit";
    $status = "pending";
    $date = date('Y-m-d');
    $amount = filter_var(test_input($_POST['amount']), FILTER_VALIDATE_FLOAT);
    $coin = test_input($_POST['coin']);
    $network = test_input($_POST['TransferNetwork']);

    if ($email && $amount && $coin && $network) {
        $stmt = $conn->prepare("INSERT INTO `transactions`(`name`, `transaction_id`, `trxType`, `trxStatus`, `trxDate`, `Amount`, `coin`, `network`,`email`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $transaction_id, $trxtyp, $status, $date, $amount, $coin, $network, $email);

        if ($stmt->execute()) {
            header("Location: ../deposit.php?amount=$amount&trId=$transaction_id");
        } else {
            handleError("Deposit failed");
        }
    } else {
        handleError("Invalid input");
    }
}




if (isset($_POST['withdraw']))
 {

        session_start();



        $name = $_SESSION['name'];
        $email = $_SESSION['email'];

        $walletId = test_input($_POST['walletId']);

        $transaction_id = implode("", randomGen(0, 20, 10));;

        $trxtyp ="withdraw";

        $status = "pending";

        $date = date('Y-m-d');

        $amount = test_input($_POST['amount']);

        if( intval($amount) < 0){
            $amount = 0;
        }



        $coin = test_input($_POST['coin']);

        $network = test_input($_POST['TransferNetwork']);



        // die();

        if ($amount > getDetails("users", $conn,$email)['balance'] ){

            header("location:../index.php?msg=Transaction failed; Can't withdraw more the available balance!!!");

            die();

        }




        $sql = "INSERT INTO `transactions`(`name`, `transaction_id`, `trxType`, `trxStatus`, `trxDate`, `Amount`, `coin`, `network`,`walletID`,`email`) VALUES  ('$name','$transaction_id','$trxtyp','$status','$date','$amount','$coin','$network','$walletId','$email')";




           if ($conn->query($sql)===TRUE){




              $from = "CapitalFlex.com";
            $to = $email;


            $subject= "Congratulations ".$name;

            $message = "
            <html>
            <head>
            <title>Withdraw Request</title>

            </head>
            <body>
            <img src='https://Capitamain.com/userPage/dist/img/logo.png' alt='capital World Profits'>
            <br>
            <h1>Hello $name</h1>

            <p>Your withdrawal request of $amount is been processed and funds will be sent to the provided wallet address $walletId .</p>
            <p> Please wait for admin's approval.</p>

            <br>

            <h4> Thank you</h4>
            <small>Contact Us at support@Capitamain.com</small>

                </body>
                </html>
         ";


         $header = "From:$from \r\n";
         $header .= "Cc:$from \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";

         $retval = mail ($to,$subject,$message,$header);

            header("location:../index.php?msg=withdrawal request Successful");




        } else {

            header("location:../index.php?msg=withdrawal request Failed");
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }
}






if (isset($_POST['tranID'])) {
    $oldTrId = $_POST['oldTrId'];
    $newTrId = $_POST['newTrId'];

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("UPDATE transactions SET transaction_id = ? WHERE transaction_id = ?");
    $stmt->bind_param("ss", $newTrId, $oldTrId);

    if ($stmt->execute()) {
        // Successful update
        // Assuming amount is passed via GET parameter
        header("Location: ./index.php?msg=Deposit Successful");
    } else {
        // Error updating record
        $amount = $_GET['amount']; // Assuming amount is passed via GET parameter
        header("Location: ./index.php?msg=Error&amount=$amount");
    }

    $stmt->close();
} 




if(isset($_POST["updateImage"])){

    session_start();

    $pictureName = "";

    // header("Location: ../profile.php");




    if($_FILES["picture"]["size"] == 0){

       header("Location:../profile.php?msg=please select a file");
    }else{
        $pictureFile = $_FILES["picture"];
        $allowedTypes = ["image/jpeg", "image/png", "image/jpg", "image/jfif"];

        // Check for file type
        if(!in_array($pictureFile["type"], $allowedTypes)) {
            header("Location:../profile.php?msg=please select allowed file type");
        }
        else {
            $pictureName = explode(".", $pictureFile["name"])[0];
            $ext = explode(".", $pictureFile["name"])[1];

            $pictureName .= time();
            $pictureName .= "." . $ext;

            $fileDestination = "../profileImages/";
            $tmpFile = $pictureFile['tmp_name'];

            // The function to upload the file to the destination
             move_uploaded_file($tmpFile, $fileDestination.$pictureName);





        }




        if(!empty($pictureName)){


        $user_email = $_SESSION['email'];
        // echo "<script>alert('$user_email')</script>";

        $sql = "UPDATE users set profile_pic = '$pictureName' WHERE email = '$user_email' ";

        if($conn->query($sql) === TRUE){
            header("Location: ../profile.php");
        }else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }


        // $sqlInsert = mysqli_query($conn, $sql);

        // if($sqlInsert){
        //     header("Location: ../profile.php");
        // }

    }


 }
}
if (isset($_POST["UserProfile"])){

    session_start();



        $email = $_SESSION['email'];



        $phoneNumber = test_input($_POST['phone']);


        if($_POST['phone']){

            $email = $_SESSION['email'];

            $phoneNumber = test_input($_POST['phone']);

            $sql = "UPDATE `users` SET `phoneNumber` = '$phoneNumber' WHERE `email` = '$email'";

            if($conn->query($sql) === TRUE){
                $msg = "Phone number Update Successful";
            }else{
                $msg = "Phone number Update Failed";
            }

        }

        // $password = encrypt_decrypt(test_input($_POST['password']));

        if($_POST['username']){

            $email = $_SESSION['email'];

            $username = test_input($_POST['username']);


            $sql = "UPDATE users SET username='$username' WHERE email='$email'";

            if ($conn->query($sql) === TRUE) {
                $msg = "Username Update Successful";
            }else{
                $msg = "Username Update Failed";
            }

            $conn->close();

        }

        if($_POST['oldPassword'] && $_POST['newPassword']){

            $email = $_SESSION['email'];

            $oldPassword = test_input($_POST['oldPassword']);

            $newPassword = test_input($_POST['newPassword']);

            $crypted = encrypt_decrypt($newPassword, 'encrypt');

            if( $oldPassword  ==  $newPassword){

                $msg = "Password matched; Failed";

            }else{
                $decrypt = getDetails("users", $conn,$email)['password'];
                $decrypt =  encrypt_decrypt($decrypt, 'decrypt');

                    if( $oldPassword != $decrypt){



                        $msg = "Password check Failed";

                    }else{

                        $email = $_SESSION['email'];

                        $sql = "UPDATE `users` SET `password` = '$crypted' WHERE `email` = '$email'";

                        if($conn->query($sql) === TRUE){
                            $msg = "Password Update Successful";
                        }else{
                            $msg = "Password Update Failed";
                        }

                    }

            }



        }

        header("Location: ../profile.php?msg=$msg");

        }

// check if user is logged in
if (isset($_POST["walletUpdate"])) {
            session_start();


        // retrieve email from session variable
            $email = $_SESSION['email'];

            // retrieve inputs from form
            $walletaddress = $_POST['wallet'];
            $coin = $_POST['coin'];
            $network = $_POST['network'];



            // check connection


            // update user record in users table where email matches session variable
            $sql = "UPDATE users SET walletAddress='$walletaddress', coin='$coin', transferNetwork='$network' WHERE email='$email'";
            if ($conn->query($sql) === TRUE) {
                // redirect to member_profile page with success message in URL
                header("Location: ../profile.php?msg=User+record+updated+successfully");
                exit();
            } else {
                // redirect to same page with error message in URL

                //echo "Error: " . $sql . "<br>" . $conn->error;
                header("Location: ../profile.php?msg=User+record+updated+failed");
                exit();
                }

         $conn->close();

}



if(isset($_POST["kyc"])){

    // start session
    session_start();

    // check if user is logged in


    // retrieve email from session variable
    $email = $_SESSION['email'];

    $fname = $_POST['fname'];

    $status = "Processing...";



    // retrieve inputs from form
    $idNumber = $_POST['idNumber'];
    $idtype = $_POST['idtype'];

    // check if files were uploaded successfully
    if (isset($_FILES['passport']) && isset($_FILES['idImage'])) {
        // set file paths and move files to folder
        $passportFileName = $_FILES['passport']['name'];
        $idFileName = $_FILES['idImage']['name'];
        $targetDir = "kyc/";
        $passportTargetFile = $targetDir . basename($passportFileName);
        $idTargetFile = $targetDir . basename($idFileName);
        if (move_uploaded_file($_FILES["passport"]["tmp_name"], $passportTargetFile) && move_uploaded_file($_FILES["idImage"]["tmp_name"], $idTargetFile)) {
            // connect to database


            // update user record in users table where email matches session variable
            $sql = "UPDATE users SET IdNumber='$idNumber', `kycstatus`='$status', idName='$passportFileName', idImage='$idFileName',`idtype`='$idtype' WHERE email='$email'";
            if ($conn->query($sql) === TRUE) {
                // redirect to member_profile page with success message in URL
                header("Location: ../profile.php?msg=User+record+updated+successfully");
                exit();
            } else {
                // redirect to same page with error message in URL
                // echo "Error: " . $sql . "<br>" . $conn->error;
               header("Location: ".$_SERVER['HTTP_REFERER']."?error=Error+updating+user+record%3A+".$conn->error);
                exit();
            }

            // close connection
            $conn->close();
        } else {
            // redirect to same page with error message in URL
             //echo "Error: " . $sql . "<br>" . $conn->error;
            header("Location: ".$_SERVER['HTTP_REFERER']."?error=Error+uploading+files");
            exit();
        }
    } else {
        // redirect to same page with error message in URL
         //echo "Error: " . $sql . "<br>" . $conn->error;
        header("Location: ".$_SERVER['HTTP_REFERER']."?error=Files+not+uploaded");
        exit();
    }


}



if (isset($_POST['invest'])) {
    session_start();

    if (!isset($_SESSION['email'])) {
        header("location:../index.php?msg=Session expired, please log in again.");
        exit();
    }

    $email = $_SESSION['email'];
    $new_invest = test_input($_POST['amount']);
    $plan = test_input($_POST['plan']);

    $userDetails = getDetails("users", $conn, $email);
    if ($userDetails === false) {
        header("location:../profile.php?msg=Failed to fetch user details.");
        exit();
    }

    $previousInvestedAmount = $userDetails['investedAmount'];
    $previousbalanceAmount = $userDetails['balance'];

    // Plan-specific minimum amounts
    $minAmounts = [
        "basic" => 1999,
        "standard" => 4999,
        "pro" => 9999,
        "advance" => 999999
        
    ];

    if (isset($minAmounts[$plan]) && $new_invest < $minAmounts[$plan]) {
        header("location:../profile.php?msg=Please, the amount must reach the minimum amount required for the $plan plan.");
        exit();
    }

    if ($new_invest > $previousbalanceAmount) {
        header("location:../profile.php?msg=Cannot invest more than the available balance.");
        exit();
    }

    $new_total_invest = $new_invest + $previousInvestedAmount;

    try {
        $trxtyp = "withdraw";
        $status = "approved";
        $date = date('Y-m-d');
        $amount = $new_invest;
        $coin = "USDT";
        $network = "TRC20";
        $number2 = "01234567890";
        $ran = substr(str_shuffle($number2), 0, 9);
        $transaction_id = "InvestdAmount " . $ran;

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO `transactions`(`name`, `transaction_id`, `trxType`, `trxStatus`, `trxDate`, `Amount`, `coin`, `network`, `email`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $name, $transaction_id, $trxtyp, $status, $date, $amount, $coin, $network, $email);

        if (!$stmt->execute()) {
            throw new Exception("Error executing query: " . $stmt->error);
        }

        update_invest_by_email($email, $new_total_invest, $conn);
        update_plan_by_email($email, $plan, $conn);

        header("location:../profile.php?msg=Deposit Successful");
        exit();
    } catch (Exception $e) {
        // Log the error message
        error_log($e->getMessage());
        header("location:../profile.php?msg=Failed: " . $e->getMessage());
        exit();
    }
}




if (isset($_GET['invest'])) {
    session_start();

    if (!isset($_SESSION['email'])) {
        header("location:../index.php?msg=Session expired, please log in again.");
        exit();
    }

    $email = $_SESSION['email'];
    $new_invest = 0;

    try {
        // Assuming getDetails is a function that fetches user details
        $userDetails = getDetails("users", $conn, $email);
        if ($userDetails === false) {
            throw new Exception("Failed to fetch user details.");
        }

        $previousInvestedAmount = $userDetails['investedAmount'];

        $new_total_invest = $new_invest + $previousInvestedAmount;

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("UPDATE users SET investedAmount = ? WHERE email = ?");
        $stmt->bind_param("is", $new_total_invest, $email);

        if (!$stmt->execute()) {
            throw new Exception("Error executing query: " . $stmt->error);
        }

        header("location:../profile.php?msg=Investment updated successfully");
        exit();
    } catch (Exception $e) {
        // Log the error message
        error_log($e->getMessage());
        header("location:../profile.php?msg=Failed: " . $e->getMessage());
        exit();
    }
}

?>







