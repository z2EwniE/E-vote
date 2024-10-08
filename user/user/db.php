<?php
$host = 'localhost';  // Replace with your database host
$dbname = 'evote'; // Replace with your database name
$username = 'root';   // Replace with your MySQL username
$password = '';       // Replace with your MySQL password

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
