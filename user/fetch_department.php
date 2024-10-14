<?php
include 'connect.php';


$connection = new mysqli($host, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch departments
$sql = "SELECT * FROM department";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<option value="'.$row['department_id'].'">'.$row['department_name'].'</option>';
    }
} else {
    echo '<option value="">No departments available</option>';
}

$connection->close();
?>
