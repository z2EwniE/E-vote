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
        SELECT v.candidate_id, s.course, s.year_level, COUNT(*) as vote_count 
        FROM votes v
        LEFT JOIN students s ON v.student_id = s.id
        WHERE 1=1
    ";

    // Add conditions dynamically
    $params = [];

    if (!empty($department)) {
        $query .= " AND s.department = :department";
        $params[':department'] = $department;
    }
    if (!empty($course)) {
        $query .= " AND s.course = :course";
        $params[':course'] = $course;
    }
    if (!empty($year_level)) {
        $query .= " AND s.year_level = :year_level";
        $params[':year_level'] = $year_level;
    }

    // Group by candidate_id, course, and year_level
    $query .= " GROUP BY v.candidate_id, s.course, s.year_level";

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
            'course' => $row['course'],
            'year_level' => $row['year_level'],
            'vote_count' => $row['vote_count']
        ];
    }

    echo json_encode(['votes' => $votesData]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
