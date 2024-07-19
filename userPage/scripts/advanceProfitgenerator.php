<?php
// $servername = "localhost";
// $username = "root";
// $password = "root";
// $dbname = "jay";

$servername = "localhost";
$username = "fidenkoq_jay";
$password = "marti08139110216";
$dbname = "fidenkoq_jay";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




function updateProfit($conn, $table_name, $package) {
    // Define the different package RIOs
    $package_rios = array(
      "basic" => 0.10,
      "advance" => 0.15,
      "premium" => 0.20,
      "vip" => 0.30
    );
  
    // Fetch the users from the database, filtered by package
    $query = "SELECT id, fname, package, balance, profit FROM " . $table_name . " WHERE package = '" . $package . "'";
    $result = mysqli_query($conn, $query);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
  
    // Loop through each user and update their profit based on their balance and package RIO
    foreach ($users as &$user) {
      $balance = $user["investedAmount"];
      $rio = $package_rios[$package];
      $profit = $balance * $rio;
  
      // Fetch the user's existing profit from the database
      $existing_profit = $user["profit"];
  
      // Add the calculated profit to the existing profit
      $updated_profit = $existing_profit + $profit;
  
      // Update the user's profit in the database
      $query = "UPDATE " . $table_name . " SET profit = " . $updated_profit . " WHERE id = " . $user["id"];
      mysqli_query($conn, $query);
  
      // Update the "profit" key in the user array
      $user["profit"] = $updated_profit;
    }
  
    // Return the updated user array
    return $users;
  }
  
  // Example usage:
  // Assume $conn is a valid mysqli database connection object
  $table_name = "users";
  $package = "advance";
  
  // Call the function and store the updated user array in a variable
  $users = updateProfit($conn, $table_name, $package);
  
  // Output the updated user array
  print_r($users);
  



