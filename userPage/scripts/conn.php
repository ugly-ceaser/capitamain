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
//echo "Connected successfully";
?>
