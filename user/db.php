    <?php
   
   error_reporting(E_ALL);
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

    function fetchStudent($id)
    {
        global $conn;

        $stmt = $conn->prepare("SELECT * FROM students WHERE student_id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    function hasStudentApplied() {
        try {
            global $conn;

            $student_id = $_SESSION['id'];

            $stmt = $conn->prepare("
                SELECT COUNT(*) 
                FROM candidates 
                WHERE student_id = :student_id
            ");
            
            // Execute the query with parameters
            $stmt->execute([
                ':student_id' => $student_id
            ]);
    
            // Fetch the count
            $count = $stmt->fetchColumn();
    
            // Return true if count is greater than 0 (student has applied), false otherwise
            return $count > 0;
        } catch (PDOException $e) {
            // Log the error and return false as a fallback
            error_log("Error checking if student applied: " . $e->getMessage());
            return false;
        }
    }
    
    


    function hasVoted()
    {

        global $conn;
    
        $student_id = $_SESSION['id'];
    
        $sql = "SELECT COUNT(*) AS vote_count FROM votes WHERE student_id = :student_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $hasVoted = $result['vote_count'] == 0;
    
        return $hasVoted;
    
    }
    