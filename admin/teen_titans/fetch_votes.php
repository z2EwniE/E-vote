        <?php
        include_once __DIR__ . '/../../config/init.php';

        header('Content-Type: application/json');

        try {
            // Fetch votes data based on dynamic filters (optional)
            $department = isset($_GET['department']) ? $_GET['department'] : '';
            $course = isset($_GET['course']) ? $_GET['course'] : '';
            $year_level = isset($_GET['year_level']) ? $_GET['year_level'] : '';

            // Base query with join to the students table
            $query = "
                SELECT v.candidate_id, COUNT(*) as vote_count 
                FROM votes v
                LEFT JOIN students s ON v.student_id = s.student_id
                WHERE 1=1
            ";

            // Add conditions dynamically
            $conditions = [];
            $params = [];

            if (!empty($department)) {
                $conditions[] = "s.department = :department";
                $params[':department'] = $department;
            }
            if (!empty($course)) {
                $conditions[] = "s.course = :course";
                $params[':course'] = $course;
            }
            if (!empty($year_level)) {
                $conditions[] = "s.year_level = :year_level";
                $params[':year_level'] = $year_level;
            }

            // Append conditions if there are any
            if (count($conditions) > 0) {
                $query .= ' AND ' . implode(' AND ', $conditions);
            }

            $query .= " GROUP BY v.candidate_id";

            $stmt = $db->prepare($query);

            // Bind parameters dynamically
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value, PDO::PARAM_STR);
            }

            $stmt->execute();
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
