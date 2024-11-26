    <?php
   
   $host = '139.99.97.250'; 
    $dbname = 'evote'; 
    $username = 'evote';   
    $password = 'TacHIuuWOuhPS!Oh';      

    try {
        // Create a new PDO instance
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        
        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit();
    }


    function isCandidate()
    {
        global $conn;

        $candidateId = $_SESSION['id'];
    
        // SQL query to check if the candidate exists
        $sql = "SELECT * FROM candidates WHERE student_id = :candidateId";
    
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':candidateId', $candidateId, PDO::PARAM_INT);
            $stmt->execute();
                if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    
    ?>
