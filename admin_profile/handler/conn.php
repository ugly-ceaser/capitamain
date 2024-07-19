<?php


// // commented out te former database
$servername = "localhost";
$username = "fusionfl_user";
$password = "marti08139110216";
$dbname = "fusionfl_data";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>