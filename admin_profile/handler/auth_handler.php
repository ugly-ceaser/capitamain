<?php

session_start();

include"./conn.php";







if(isset($_POST['login'])){
    $username = $_POST['username'];

    $password = $_POST['password'];

    $sql = "SELECT * FROM `admin` WHERE `Username` = '$username'";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // output data of each row
        
       
        while($row = $result->fetch_assoc()) {
            
           
            $_SESSION['Admin'] = $row["id"];
            

            header("location:../dashboard.php");
        }
    } else {
        header("location:../index.php?msg=invalid details");
    }
    $conn->close();
}