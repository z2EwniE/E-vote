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
                $message = "You have already voted.";
            } else {
                // Set session variables
                $_SESSION['id'] = $student['id'];
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
    <title>Login - E-Vote System</title>
    <link rel="stylesheet" href="svg/login-styles.css">
    <link rel="stylesheet" href="css/register.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        .scanner-info {
            background: rgba(79, 70, 229, 0.1);
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 15px;
            border: 1px solid rgba(79, 70, 229, 0.2);
        }

        .scanner-icon {
            background: #0072ff;
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .scanner-icon svg {
            color: white;
        }

        .scanner-text h3 {
            font-size: 16px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 4px;
        }

        .scanner-text p {
            font-size: 14px;
            color: #64748b;
            margin: 0;
        }

        .input-with-icon {
            position: relative;
            display: flex;
            align-items: center;
        }

        .input-icon {
            position: absolute;
            left: 12px;
            color: #64748b;
        }

        .input-with-icon input {
            padding-left: 40px;
        }

        button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #0072ff;
            transition: all 0.3s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        button svg {
            transition: transform 0.3s ease;
        }

        button:hover svg {
            transform: translateX(3px);
        }

        .register-prompt {
            text-align: center;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #e2e8f0;
        }

        .register-prompt a {
            color: #0072ff;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .register-prompt a:hover {
            color: #3730a3;
            text-decoration: underline;
        }

        .alert {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0.5rem;
            background-color: #fff3cd;
            border: 1px solid #ffeeba;
            color: #856404;
        }

        @media (max-width: 768px) {
            .scanner-info {
                flex-direction: column;
                text-align: center;
            }
            
            .scanner-icon {
                margin: 0 auto;
            }
        }

        /* Loading Spinner */
        .spinner-overlay {
            position: fixed; /* Changed to fixed to cover the entire viewport */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999; /* Ensure it overlays all content */
            display: none; /* Hidden by default */
        }
    </style>
</head>

<body>
    <div class="main-container d-flex flex-wrap">
        <div class="left-section flex-grow-1 p-4">
            <div class="left-content">
                <img src="svg/login-not-css.svg" alt="Login illustration" class="img-fluid">
                <h1>Welcome Back!</h1>
                <p>Login to access your voting dashboard and make your voice heard.</p>
                <div class="features">
                    <div class="feature-item d-flex align-items-center mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                            <polyline points="22 4 12 14.01 9 11.01"></polyline>
                        </svg>
                        <span class="ms-2">Quick login with barcode</span>
                    </div>
                    <div class="feature-item d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                             stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                        <span class="ms-2">Secure and confidential</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="right-section flex-grow-1 p-4">
            <h2>Login to E-Vote</h2>
            <div class="scanner-info">
                <div class="scanner-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 7V5a2 2 0 0 1 2-2h2"></path>
                        <path d="M17 3h2a2 2 0 0 1 2 2v2"></path>
                        <path d="M21 17v2a2 2 0 0 1-2 2h-2"></path>
                        <path d="M7 21H5a2 2 0 0 1-2-2v-2"></path>
                        <rect x="7" y="7" width="10" height="10"></rect>
                    </svg>
                </div>
                <div class="scanner-text">
                    <h3>Quick Login Available</h3>
                    <p>Simply tap your ID card on the scanner to login instantly</p>
                </div>
            </div>

            <!-- Display PHP Messages -->
            <?php if ($message): ?>
            <div class="alert alert-warning">
                <?php echo htmlspecialchars($message); ?>
            </div>
            <?php endif; ?>
            
            <form method="POST" action="" id="loginForm" class="needs-validation" novalidate>
                <div class="input-group mb-3">
                    <label for="student_id" class="form-label">Student ID</label>
                    <div class="input-with-icon position-relative">
                        <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" width="20" 
                             height="20" viewBox="0 0 24 24" fill="none" 
                             stroke="currentColor" stroke-width="2" 
                             stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="16" rx="2"/>
                            <line x1="7" y1="8" x2="17" y2="8"/>
                            <line x1="7" y1="12" x2="17" y2="12"/>
                            <line x1="7" y1="16" x2="12" y2="16"/>
                        </svg>
                        <input type="text" id="student_id" name="student_id" 
                               class="form-control" placeholder="Enter your Student ID" 
                               required>
                        <div class="invalid-feedback">
                            Please enter your Student ID.
                        </div>
                    </div>
                </div>
                <button type="submit" id="loginButton" class="btn btn-primary w-100">
                    <span>Login</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" 
                         viewBox="0 0 24 24" fill="none" stroke="currentColor" 
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                        <polyline points="10 17 15 12 10 7"/>
                        <line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                </button>
            </form>
            <div class="register-prompt">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div class="spinner-overlay" id="spinner">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle (Includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
           ></script>

    <!-- jQuery CDN (Only one version) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" 
            ></script>
    
    <!-- Custom JavaScript for Auto-Login -->
    <script>
        $(document).ready(function () {
            // Cache DOM elements for better performance
            const $studentIdField = $('#student_id');
            const $loginForm = $('#loginForm');
            const $loginButton = $('#loginButton');
            const $spinner = $('#spinner');

            // Function to handle the barcode scan
            function handleBarcodeScan(barcode) {
                // Normalize hyphen to standard hyphen-minus
                const normalizedBarcode = barcode.replace(/−/g, '-').toUpperCase(); // Replace all '−' with '-' and convert to uppercase
                const regex = /^[Ee]{1}\d{2}-\d{5}$/; // Adjust regex based on your Student ID format

                if (regex.test(normalizedBarcode)) {
                    $studentIdField.val(normalizedBarcode);
                    // Automatically submit the form
                    submitForm();
                } else {
                    displayMessage('Invalid Student ID format.', 'danger');
                }
            }

            // Function to submit the form
            function submitForm() {
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
                let $existingMessage = $('#message');

                if ($existingMessage.length === 0) {
                    // If the message div doesn't exist, create it
                    $existingMessage = $('<div>', {
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
                    // Prepend the message to the form or a specific container
                    $loginForm.prepend($existingMessage);
                } else {
                    // Update existing message div
                    $existingMessage.removeClass().addClass(`alert alert-${type} alert-dismissible fade show`);
                    $existingMessage.text(message);
                    $existingMessage.append(
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
                    $existingMessage.alert('close');
                }, 5000);
            }

            // Set up the AJAX request to scan and autofill student_id
            function scanBarcode() {
                $.ajax({
                    url: 'http://192.168.0.109:5000/scan', // Update this URL if necessary
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data.success && data.barcode) {
                            handleBarcodeScan(data.barcode); // Autofill and possibly submit the form
                            console.log('Scanned Barcode:', data.barcode);
                        } else {
                            console.warn('No barcode scanned or scan failed.');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('Error scanning barcode:', textStatus, errorThrown);
                        displayMessage('Error scanning barcode. Please try again.', 'danger');
                    }
                });
            }

            // Trigger barcode scan at regular intervals (e.g., every 5 seconds)
            const scanInterval = setInterval(function(){
                scanBarcode();
            }, 5000); // Adjust the interval as needed

            // Optional: Allow manual submission with validation
            $loginForm.on('submit', function (event) {
                const form = this;

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                $(form).addClass('was-validated');

                // If the form is valid, show the spinner
                if (form.checkValidity()) {
                    $spinner.show();
                }
            });

            // Optionally, stop scanning once a successful login occurs
            <?php if ($message === "" && $_SERVER["REQUEST_METHOD"] == "POST"): ?>
                clearInterval(scanInterval);
            <?php endif; ?>
        });
    </script>
</body>

</html>
