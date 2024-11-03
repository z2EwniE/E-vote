<?php

   include 'db.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to get all positions
    $positionsQuery = "SELECT * FROM positions";
    $positionsStmt = $pdo->query($positionsQuery);
    $positions = $positionsStmt->fetchAll(PDO::FETCH_ASSOC);

    $result = [];

    foreach ($positions as $position) {
        $position_id = $position['position_id'];
        $position_name = $position['position_name'];

        // Updated Query to get candidates for each position (with correct table name: partylists)
        $candidatesQuery = "SELECT candidates.*,   department.*,          CONCAT(students.first_name, ' ', students.middle_name, ' ', students.last_name) AS candidate_name, partylists.partylist_name, partylists.partylist_id 
                            FROM candidates
                            INNER JOIN students ON candidates.student_id = students.id
                            INNER JOIN department ON candidates.department = department.department_id
                            INNER JOIN partylists ON candidates.partylist_id = partylists.partylist_id
                            WHERE candidates.candidate_position = :position_id";

        $candidatesStmt = $pdo->prepare($candidatesQuery);
        $candidatesStmt->bindParam(':position_id', $position_id);
        $candidatesStmt->execute();
        $candidates = $candidatesStmt->fetchAll(PDO::FETCH_ASSOC);

        // Add position and candidates to the result array
        $result[] = [
            'position_id' => $position_id,
            'position_name' => $position_name,
            'candidates' => $candidates
        ];
        }

        // Return result as JSON
        echo json_encode(['positions' => $result]);

    } catch (PDOException $e) {
        echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
    }
    ?>