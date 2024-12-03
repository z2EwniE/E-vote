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

    <script>
        // Function to handle the barcode scan
        function handleBarcodeScan(barcode) {
            // Fill the student_id field with the scanned barcode
            document.getElementById('student_id').value = barcode;
        }

        // Set up the AJAX request to scan and autofill student_id
        function scanBarcode() {
            // Make the AJAX request to scan the barcode
            fetch('http://localhost:5000/scan')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        handleBarcodeScan(data.barcode); // Autofill the student_id field
                    } else {
                        console.log("No barcode scanned");
                    }
                })
                .catch(error => {
                    console.error('Error scanning barcode:', error);
                });
        }

        // Trigger barcode scan on page load (you can adjust this based on your actual scanning method)
        window.onload = function() {
            scanBarcode();
        }
    </script>
</body>

</html>
