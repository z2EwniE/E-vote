    <?php
    include_once __DIR__ . '/../config/init.php';

    header('Content-Type: application/json');

    try {
        // Reuse the $pdo connection from init.php
        $query = "SELECT candidate_id, COUNT(*) as vote_count 
                FROM votes 
                GROUP BY candidate_id";

        $stmt = $pdo->query($query);
        $votesData = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $votesData[] = [
                'candidate_id' => $row['candidate_id'],
                'vote_count' => $row['vote_count']
            ];
        }

        echo json_encode(['votes' => $votesData]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
    ?>
