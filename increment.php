<?php
$servername = "localhost";
$username = "capitama_user";
$password = "marti08139110216";
$dbname = "capitama_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Package details with total return percentage (keys converted to lowercase)
$packages = [
    "basic" => ["return_percentage" => 6],
    "standard" => ["return_percentage" => 8],
    "pro" => ["return_percentage" => 10],
    "advance" => ["return_percentage" => 12],
];

// Function to increment balances
function increment_balances($conn, $packages) {
    $sql = "SELECT id, package, balance, profit, last_update FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $package = strtolower($row["package"]); // Convert to lowercase
            $balance = $row["balance"];
            $profit = $row["profit"];
            $last_update = new DateTime($row["last_update"]);
            $now = new DateTime();
            $interval = $now->diff($last_update);
            $days = $interval->days;

            // Debugging: Check if package exists in the packages array
            if (isset($packages[$package])) {
                $return_percentage = $packages[$package]["return_percentage"];
                
                // Calculate the daily increment based on the total return percentage
                $daily_increment_percentage = $return_percentage;
                $daily_increment = $balance * ($daily_increment_percentage / 100);
                $new_profit = $profit + $daily_increment;

                // Update the profit and last_update date
                $update_sql = "UPDATE users SET profit = $new_profit, last_update = NOW() WHERE id = " . $row["id"];
                if ($conn->query($update_sql) === TRUE) {
                    echo "Record updated successfully for user ID " . $row["id"] . "\n";
                } else {
                    echo "Error updating record for user ID " . $row["id"] . ": " . $conn->error . "\n";
                }
            } else {
                echo "Package " . $package . " not found in the packages array.\n";
            }
        }
    } else {
        echo "0 results";
    }
}

// Increment balances
increment_balances($conn, $packages);

// Close connection
$conn->close();
?>
