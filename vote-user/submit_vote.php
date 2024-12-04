<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['student_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

// Include the database connection
require 'db.php';

// Get the student_id from the session (e.g., "E21-00731")
$student_id = $_SESSION['student_id'];
error_log("Current Student ID: " . $student_id); // Debugging line

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the request data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Check if votes array exists
    $votes = $data['votes'] ?? null;

    if ($votes && $student_id) {
        // Begin a transaction
        $conn->beginTransaction();

        try {
            // Fetch the numeric id of the student using student_id from the session
            $sql_fetch_student_id = "SELECT id FROM students WHERE student_id = :student_id";
            $stmt_fetch_student_id = $conn->prepare($sql_fetch_student_id);
            $stmt_fetch_student_id->bindParam(':student_id', $student_id);
            $stmt_fetch_student_id->execute();
            $student_db_id = $stmt_fetch_student_id->fetchColumn();

            if (!$student_db_id) {
                throw new Exception("Student ID $student_id does not exist.");
            }

            // Check if the student has already voted
            $sql_check_vote = "SELECT COUNT(*) FROM votes WHERE student_id = :student_id";
            $stmt_check_vote = $conn->prepare($sql_check_vote);
            $stmt_check_vote->bindParam(':student_id', $student_db_id);
            $stmt_check_vote->execute();
            $alreadyVoted = $stmt_check_vote->fetchColumn();

            if ($alreadyVoted > 0) {
                throw new Exception("You have already voted.");
            }

            // Insert the votes into the database
            foreach ($votes as $vote) {
                // Validate candidate_id
                $sql_check_candidate = "SELECT COUNT(*) FROM candidates WHERE candidate_id = :candidate_id";
                $stmt_check_candidate = $conn->prepare($sql_check_candidate);
                $stmt_check_candidate->bindParam(':candidate_id', $vote['candidate_id']);
                $stmt_check_candidate->execute();
                $candidateExists = $stmt_check_candidate->fetchColumn();

                if ($candidateExists == 0) {
                    throw new Exception("Candidate ID {$vote['candidate_id']} does not exist.");
                }

                // Validate position_id
                $sql_check_position = "SELECT COUNT(*) FROM positions WHERE position_id = :position_id";
                $stmt_check_position = $conn->prepare($sql_check_position);
                $stmt_check_position->bindParam(':position_id', $vote['position_id'], PDO::PARAM_INT);
                $stmt_check_position->execute();
                $positionExists = $stmt_check_position->fetchColumn();

                if ($positionExists == 0) {
                    throw new Exception("Position ID {$vote['position_id']} does not exist.");
                }

                // Validate partylist_id (it can be NULL, so we check only if it's provided)
                if (!is_null($vote['partylist_id'])) {
                    $sql_check_partylist = "SELECT COUNT(*) FROM partylists WHERE partylist_id = :partylist_id";
                    $stmt_check_partylist = $conn->prepare($sql_check_partylist);
                    $stmt_check_partylist->bindParam(':partylist_id', $vote['partylist_id']);
                    $stmt_check_partylist->execute();
                    $partylistExists = $stmt_check_partylist->fetchColumn();

                    if ($partylistExists == 0) {
                        throw new Exception("Partylist ID {$vote['partylist_id']} does not exist.");
                    }
                }

                // Insert the vote
                $sql_insert_vote = "INSERT INTO votes (student_id, candidate_id, position_id, partylist_id) 
                                    VALUES (:student_id, :candidate_id, :position_id, :partylist_id)";
                $stmt_insert_vote = $conn->prepare($sql_insert_vote);
                $stmt_insert_vote->bindParam(':student_id', $student_db_id); // Use the numeric ID from the database
                $stmt_insert_vote->bindParam(':candidate_id', $vote['candidate_id']);
                $stmt_insert_vote->bindParam(':position_id', $vote['position_id']);
                $stmt_insert_vote->bindParam(':partylist_id', $vote['partylist_id']); // This can be NULL
                $stmt_insert_vote->execute();
            }

            // Commit the transaction
            $conn->commit();

            echo json_encode(['status' => 'success', 'message' => 'Vote submitted successfully.']);
        } catch (Exception $e) {
            // Roll back the transaction on error
            $conn->rollBack();
            error_log("Vote submission error: " . $e->getMessage()); // Log the error
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}

?>