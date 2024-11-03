<?php
        include_once __DIR__ . '/../../config/init.php';

header('Content-Type: application/json');


try {

    $sql = "SELECT 
                DATE_FORMAT(date_created, '%b') AS month,
                MONTH(date_created) AS month_number,
                COUNT(id) AS total_students_registered
            FROM students
            GROUP BY YEAR(date_created), MONTH(date_created)
            ORDER BY MONTH(date_created)";
    
    $stmt = $db->prepare($sql);
    $stmt->execute();

    $labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    $data = array_fill(0, 12, 0); 

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data[$row['month_number'] - 1] = (int) $row['total_students_registered'];
    }

    echo json_encode([
        "labels" => $labels,
        "data" => $data
    ]);

} catch (PDOException $e) {
    // Handle the error if the connection fails
    echo json_encode([
        "error" => "Database connection failed: " . $e->getMessage()
    ]);
}
