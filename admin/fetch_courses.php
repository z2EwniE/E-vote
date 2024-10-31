        <?php

        include_once __DIR__ . "/config/init.php";

        try {
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if (isset($_POST['department_id'])) {
                $department_id = $_POST['department_id'];
                
                // Fetch courses based on the selected department
                $sql = "SELECT * FROM course WHERE course_department = :department_id";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
                $stmt->execute();
                $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (count($courses) > 0) {
                    foreach ($courses as $row) {
                        echo '<option value="' . htmlspecialchars($row['course_id']) . '">' . htmlspecialchars($row['course_name']) . '</option>';
                    }
                } else {
                    echo '<option value="">No courses available</option>';
                }
            }
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        ?>