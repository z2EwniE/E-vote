    <?php
   
   $host = 'localhost'; 
    $dbname = 'evote'; 
    $username = 'root';   
    $password = 'EDscMIJndts4lAo8';      

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
