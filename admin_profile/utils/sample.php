<?php

include("../../../publicScript/conn.php");








if(isset($_POST['adminAcountt'])){

  function test_input($data) {

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;

  };

  $wallet_typ = test_input($_POST["wallet_typ"]);
  $Address = test_input($_POST['Address']);
  $file = $_FILES["file"];


  



  
  


    if(!$file["file"]["error"]){
      try{
        $filename = $file["name"];
        $des = "../../../publicScript/uploads/";
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $rand = time();
        $filename = $rand . "." . $extension;
      
        $main_file = $file["tmp_name"];
      
        $moved = move_uploaded_file($main_file, $des.$filename);
        
        if($moved) {

          $sql = "UPDATE `admin` SET `Address`='$Address',`file`='$filename' WHERE `wallet_typ`='$wallet_typ'";

          $stmt = $conn->prepare($sql);

          


          // execute the query
          $stmt->execute();

          // echo a message to say the UPDATE succeeded
          echo $stmt->rowCount();
          header('Location:../pages/reports/transactions.php?suc= Successful');
        } else {
              

              header("Location:../pages/reports/transactions.php?msg=failed to upload");
              die();
        }
        

        } catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    

  



};

















function getUsers($conn)
{
    $query = "SELECT * FROM users";
    $result = $conn->prepare($query);
    $result->execute();

    return $result->fetchAll();
}

function getAmount($conn, $type,$tableName)
{
    $query = "SELECT SUM(amount) as amount FROM $tableName WHERE trxType = ?";
    $result = $conn->prepare($query);
    $result->execute([$type]);

    return $result->fetch()['amount'];
}

function getAmountPending($conn,$tableName)
{
    $query = "SELECT SUM(amount) as amount FROM $tableName WHERE trxStatus = ?";
    $result = $conn->prepare($query);
    $result->execute(["pending"]);

    return $result->fetch()['amount'];
}








function pendingTransact($conn, $type,$tableName)
{
    $query = "SELECT * FROM $tableName WHERE trxType = ? AND trxStatus = ?";
    $result = $conn->prepare($query);
    $result->execute([$type, "pending"]);

    return $result->fetchAll();
}




function allTransact($conn, $type)
{
    $query = "SELECT * FROM deposits ";
    $result = $conn->prepare($query);
    

    return $result->fetchAll();
}




function getUser($conn, $id)
{
    $query = "SELECT * FROM users WHERE id = ?";
    $result = $conn->prepare($query);
    $result->execute([$id]);

    return $result->fetch();
}

if(isset($_POST['sendMessage'])){


    function test_input($data) {

      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;

     }


$senderId = test_input($_POST["senderId"]);
$recieverId = test_input($_POST["recieverId"]);
$subject = test_input($_POST["subject"]);
$message = test_input($_POST["message"]);
$mesgStat = test_input($_POST["messageStatus"]);
$date = date("Y/m/d");




$sql = "INSERT INTO `messages` ( `senderId`, `recieverId`, `msgSubject`, `message`, `messageStatus`, `datee`) 
  VALUES ( '$senderId', '$recieverId', '$subject', '$message', '$mesgStat', '$date')";

$conn->exec($sql);

header("Location:../send_msg.php");



  
};

function getUsersentMessage ($conn, $userId) {
  $query = "SELECT * FROM messages WHERE senderId = ?";
  $result = $conn->prepare($query);
  $result->execute([$userId]);
  
  return $result->fetchAll();
  }


  function getUserMessage ($conn, $userId) {
  
    $query = "SELECT * FROM messages WHERE recieverId = ?";
    $result = $conn->prepare($query);
    $result->execute([$userId]);
    
    return $result->fetchAll();
    }
    
    
    

