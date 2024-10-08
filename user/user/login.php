<?php
// Include database connection
include 'connect.php';

// Start the session
session_start();

$message = ""; // Variable to hold messages

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $student_id = $_POST['student_id'];

    // Validate student ID format
    if (!preg_match("/^[A-Za-z0-9\-]+$/", $student_id)) {
        $message = "Invalid Student ID format! Please use alphanumeric characters and dashes.";
    } else {
        // Check if the student_id exists in the database
        $sql = "SELECT * FROM students WHERE student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch user data
            $student = $result->fetch_assoc();
            
            // Check if the student has already voted
            $student_db_id = $student['id']; // Assuming 'id' is the primary key in students table
            $sql_votes = "SELECT * FROM votes WHERE student_id = ?";
            $stmt_votes = $conn->prepare($sql_votes);
            $stmt_votes->bind_param("i", $student_db_id);
            $stmt_votes->execute();
            $result_votes = $stmt_votes->get_result();

            if ($result_votes->num_rows > 0) {
                // Student has already voted
                $message = "You have already voted! You cannot vote again.";
            } else {
                // Set session variables and allow login
                $_SESSION['student_id'] = $student['student_id'];
                $_SESSION['first_name'] = $student['first_name'];
                $_SESSION['last_name'] = $student['last_name'];

                header('Location: index.php'); // Redirect to voting page
                exit();
            }
        } else {
            $message = "Invalid Student ID!";
        }

        $stmt->close();
        $stmt_votes->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }

        .login-title {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 700;
            color: #343a40;
        }

        .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            color: #6c757d;
        }

        .register-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 class="login-title">Login</h2>
        <div id="message" class="alert <?php echo $message ? 'alert-warning' : 'd-none'; ?>">
            <?php echo $message; ?>
        </div>
        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID:</label>
                <input type="text" id="student_id" name="student_id" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="register.php" class="link-primary">Register here</a></p>
        </div>
        <div class="footer">
            <p>© 2024 Evote. All rights reserved.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
