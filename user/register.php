    <?php
    include 'connect.php';
    $departments = [];
    $sql = "SELECT department_id, department_name FROM department";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $departments[] = $row;
        }
    } else {
        echo "No departments found.";
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $student_id = $_POST['student_id'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $suffix_name = $_POST['suffix_name'];
        $course = $_POST['course'];
        $year_level = $_POST['year_level'];
        $department = $_POST['department'];
        $sql = "SELECT * FROM students WHERE student_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            echo "<script>alert('Student ID already exists!');</script>";
        } else {
            $sql = "INSERT INTO students (student_id, first_name, middle_name, last_name, suffix_name, course, year_level, department) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssssi", $student_id, $first_name, $middle_name, $last_name, $suffix_name, $course, $year_level, $department);
            if ($stmt->execute()) {
                echo "<script>alert('Registration successful!');window.location.href='login.php';</script>";
            } else {
                echo "Error: " . $conn->error;
            }
        }
        $stmt->close();
    }
    $conn->close();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
        <style>
            body {background-color: #f8f9fa; font-family: 'Roboto', sans-serif;}
            .register-container {max-width: 600px; margin: auto; padding: 40px; background: #fff; border-radius: 10px; box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); margin-top: 100px; margin-bottom: 50px;}
            .register-title {text-align: center; margin-bottom: 30px; font-weight: 700; color: #343a40;}
            .form-label {font-weight: 600;}
            .form-control {border-radius: 5px; border: 1px solid #ced4da;}
            .btn-primary {background-color: #007bff; border: none; border-radius: 5px; padding: 10px;}
            .btn-primary:hover {background-color: #0056b3;}
            .footer {text-align: center; margin-top: 30px; color: #6c757d;}
            .login-link {text-align: center; margin-top: 15px;}
        </style>
    </head>
    <body>
        <div class="register-container">
            <h2 class="register-title">Register</h2>
            <form method="POST" action="">
                <div class="mb-4">
                    <label for="student_id" class="form-label">Student ID:</label>
                    <input type="text" id="student_id" name="student_id" class="form-control" placeholder="Use valid Student ID" required>
                </div>
                <div class="mb-4">
                    <label for="first_name" class="form-label">First Name:</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="middle_name" class="form-label">Middle Name:</label>
                    <input type="text" id="middle_name" name="middle_name" class="form-control">
                </div>
                <div class="mb-4">
                    <label for="last_name" class="form-label">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="suffix_name" class="form-label">Suffix Name:</label>
                    <input type="text" id="suffix_name" name="suffix_name" class="form-control" placeholder="N/A if none">
                </div>

                <div class="mb-4">
                    <label for="year_level" class="form-label">Year Level:</label>
                    <select type="text" id="year_level" name="year_level" class="form-control" required>
                    <option value="">Select Year Level</option> <!-- Default empty option -->
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="department" class="form-label">Department:</label>
                    <select id="department" name="department" class="form-select" required>
                        <option value="">Select Department</option>
                        
                    </select>
                </div>    
                
                <div class="mb-4">
                    <label for="course" class="form-label">Course:</label>
                    <select type="text" id="course" name="course" class="form-control" required>
                    <option value="">Select Course</option> 
                   
                    </select>
                </div>
           
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </form>
            <div class="login-link">
                <p>Already have an account? <a href="login.php" class="link-primary">Login here</a></p>
            </div>
            <div class="footer">
                <p>© 2024 E-vote. All rights reserved.</p>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        
        <script>
            $(document).ready(function () {
                function fetchBarcode() {
                    // Fetch the scan URL
                    fetch('http://192.168.0.100:5000/scan')
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                $('#student_id').val(data.barcode);
                            } else {
                                $('#message').text('Failed to retrieve barcode.').show();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            $('#message').text('Failed to start login process.').show();
                        });
                }
        
                // Automatically fetch barcode every 2 seconds
                setInterval(fetchBarcode, 2000);
            });
            </script>

            <script>
                    $(document).ready(function() {
                        // Fetch departments on page load
                        $.ajax({
                            url: 'fetch_department.php',
                            method: 'GET',
                            success: function(response) {
                                $('#department').append(response);
                            }
                        });

                        $('#department').on('change', function() {
                            var departmentID = $(this).val();
                            if (departmentID) {
                                $.ajax({
                                    type: 'POST',
                                    url: 'fetch_courses.php', // Assuming your PHP file is named fetch_courses.php
                                    data: { department_id: departmentID },
                                    success: function(html) {
                                        $('#course').html(html);
                                    }
                                });
                            } else {
                                $('#course').html('<option value="">Select Course</option>');
                            }
                        });
                    });
                </script>

    </body>
</html>
