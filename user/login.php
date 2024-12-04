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
                $_SESSION['id'] = $student['id'];
                $_SESSION['student_id'] = $student['student_id'];
                $_SESSION['first_name'] = $student['first_name'];
                $_SESSION['last_name'] = $student['last_name'];
                header('Location: index.php'); // Redirect to voting page
                exit();
            
        } else {
            $message = "Invalid Student ID!";
        }
        // $stmt->close();
        // $stmt_votes->close();
        // $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            position: relative;
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
            transition: background-color 0.3s ease;
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

        /* Loading Spinner */
        .spinner-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            display: none; /* Hidden by default */
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="spinner-overlay" id="spinner">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
        <h2 class="login-title">Login</h2>
        <!-- PHP Message Handling -->
        <?php if (isset($message) && !empty($message)): ?>
            <div id="message" class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo htmlspecialchars($message); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <!-- Login Form -->
        <form id="loginForm" method="POST" action="login.php">
            <div class="mb-3">
                <label for="student_id" class="form-label">Student ID:</label>
                <input type="text" id="student_id" name="student_id" class="form-control" required pattern="^[Ee]{1}\d{2}-\d{5}$" title="Format: E20-00287">
                <div class="invalid-feedback">
                    Please enter a valid Student ID (e.g., E20-00287).
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100" id="loginButton">Login</button>
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="register.php" class="link-primary">Register here</a></p>
        </div>
        <div class="footer">
            <p>© 2024 Evote. All rights reserved.</p>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function () {
            // Function to handle the barcode scan
                    function handleBarcodeScan(barcode) {
            // Normalize hyphen to standard hyphen-minus
            const normalizedBarcode = barcode.replace(/−/g, '-').toUpperCase(); // Replace all '−' with '-' and convert to uppercase
            const $studentIdField = $('#student_id');
            const $loginForm = $('#loginForm');
            const regex = /^[Ee]{1}\d{2}-\d{5}$/; // Updated regex

            if (regex.test(normalizedBarcode)) {
                $studentIdField.val(normalizedBarcode);
                // Optionally, trigger form submission automatically
                submitForm();
            } else {
                displayMessage('Invalid Student ID format.', 'danger');
            }
        }


            // Function to submit the form
            function submitForm() {
                const $loginButton = $('#loginButton');
                const $spinner = $('#spinner');
                const $loginForm = $('#loginForm');

                // Disable the login button to prevent multiple submissions
                $loginButton.prop('disabled', true);
                // Show the loading spinner
                $spinner.show();

                // Submit the form after a short delay to show the spinner
                setTimeout(function () {
                    $loginForm.submit();
                }, 500);
            }

            // Function to display messages
            function displayMessage(message, type) {
                let $messageDiv = $('#message');

                if ($messageDiv.length === 0) {
                    // If the message div doesn't exist, create it
                    $messageDiv = $('<div>', {
                        id: 'message',
                        class: `alert alert-${type} alert-dismissible fade show`,
                        role: 'alert',
                        text: message
                    }).append(
                        $('<button>', {
                            type: 'button',
                            class: 'btn-close',
                            'data-bs-dismiss': 'alert',
                            'aria-label': 'Close'
                        })
                    );
                    $('.login-container').prepend($messageDiv);
                } else {
                    // Update existing message div
                    $messageDiv.removeClass().addClass(`alert alert-${type} alert-dismissible fade show`);
                    $messageDiv.text(message);
                    $messageDiv.append(
                        $('<button>', {
                            type: 'button',
                            class: 'btn-close',
                            'data-bs-dismiss': 'alert',
                            'aria-label': 'Close'
                        })
                    );
                }

                // Automatically dismiss the alert after 5 seconds
                setTimeout(function () {
                    $messageDiv.alert('close');
                }, 5000);
            }

            // Set up the AJAX request to scan and autofill student_id
            function scanBarcode() {
                $.ajax({
                    url: 'http://192.168.0.109:5000/scan',
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data.success && data.barcode) {
                            handleBarcodeScan(data.barcode); // Autofill and possibly submit the form
                            console.log(data.barcode)
                        } else {
                            displayMessage('No barcode scanned or scan failed.', 'warning');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('Error scanning barcode:', textStatus, errorThrown);
                        displayMessage('Error scanning barcode. Please try again.', 'danger');
                    }
                });
            }

            // Trigger barcode scan on page load (you can adjust this based on your actual scanning method)
            setInterval(function(){
                scanBarcode();
            }, 2000)
            // Optional: Allow manual submission with validation
            $('#loginForm').on('submit', function (event) {
                const form = this;
                const $form = $(form);

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                $form.addClass('was-validated');
            });
        });
    </script>
</body>

</html>
