<?php
// Database connection parameters
$servername = "localhost";  // Replace with your database server name (e.g., localhost)
$username = "root";         // Replace with your MySQL username
$password = "EDscMIJndts4lAo8";             // Replace with your MySQL password
$dbname = "evote";          // Replace with the name of your database (e.g., 'evote')

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
