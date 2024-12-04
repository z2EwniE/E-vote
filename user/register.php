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
        <title>Register - E-Vote System</title>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <link rel="stylesheet" href="svg/sign-up-styles.css">
        <link rel="stylesheet" href="css/register.css">
    </head>

    <body>
        <div class="main-container">
            <div class="left-section">
                <div class="left-content">
                    <img src="svg/sign-up-not-css.svg" alt="Registration illustration">
                    <h1>Register to Vote</h1>
                    <p>Make your voice heard! Join and participate in shaping the future of student leadership.</p>
                    <div class="features">
                        <div class="feature-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                <polyline points="22 4 12 14.01 9 11.01"></polyline>
                            </svg>
                            <span>Quick and easy registration</span>
                        </div>
                        <div class="feature-item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            </svg>
                            <span>Secure and confidential</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="right-section">
                <h2>Create Account</h2>
                <form method="POST" action="">
                    <div class="input-group-half">
                        <div class="input-group">
                            <label for="student_id">Student ID</label>
                            <input type="text" id="student_id" name="student_id" placeholder="Use valid Student ID"
                                required>
                        </div>
                        <div class="input-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" required>
                        </div>
                    </div>

                    <div class="input-group-half">
                        <div class="input-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" id="middle_name" name="middle_name">
                        </div>
                        <div class="input-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" required>
                        </div>
                    </div>

                    <div class="input-group-half">
                        <div class="input-group">
                            <label for="suffix_name">Suffix Name</label>
                            <input type="text" id="suffix_name" name="suffix_name" placeholder="N/A if none">
                        </div>
                        <div class="input-group">
                            <label for="year_level">Year Level</label>
                            <select id="year_level" name="year_level" required>
                                <option value="">Select Year Level</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-group-half">
                        <div class="input-group">
                            <label for="department">Department</label>
                            <select id="department" name="department" required>
                                <option value="">Select Department</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="course">Course</label>
                            <select id="course" name="course" required>
                                <option value="">Select Course</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit">Register</button>
                </form>
                <p>Already have an account? <a href="login.php">Log in</a></p>
            </div>
        </div>

        <!-- Keep the existing JavaScript code -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

        <script>
                   $(document).ready(function () {
            // Cache DOM elements
            const $studentIdField = $('#student_id');
            const $firstNameField = $('#first_name');
            const $lastNameField = $('#last_name');
            const $year_level = $('#year_level');
            const $middleNameField = $('#middle_name');
            const $suffixNameField = $('#suffix_name');
            const $registerForm = $('#registerForm');
            const $registerButton = $('#registerButton');
            const $spinner = $('#spinner');

            let isStudentInfoFetched = false; // Flag to prevent multiple fetches

            // Function to handle the barcode scan
            function handleBarcodeScan(barcode) {
                // Normalize hyphen to standard hyphen-minus
                const normalizedBarcode = barcode.replace(/−/g, '-').toUpperCase(); // Replace all '−' with '-' and convert to uppercase
                const regex = /^[A-Za-z0-9\-]{1,}$/; // Adjust regex based on your Student ID format

                if (regex.test(normalizedBarcode)) {
                    if (!$studentIdField.val()) { // Only auto-fill if the field is empty
                        $studentIdField.val(normalizedBarcode);
                        fetchStudentInfo(normalizedBarcode);
                    }
                } else {
                    displayMessage('Invalid Student ID format.', 'danger');
                }
            }

            // Function to fetch student info via AJAX
            function fetchStudentInfo(student_id) {
                $.ajax({
                    url: 'get_student_info.php', // Ensure this path is correct
                    method: 'GET',
                    data: { student_id: student_id },
                    dataType: 'json',
                    beforeSend: function() {
                        // Show spinner if desired
                        $spinner.show();
                    },
                    success: function(response) {
                        if (response.success && response.data) {
                            const student = response.data;
                            $firstNameField.val(student.firstName);
                            $lastNameField.val(student.lastName);
                            $middleNameField.val(student.middleName);
                            $year_level.val(student.yearLevel);
                            $suffixNameField.val(student.suffixName !== 'N/A' ? student.suffixName : '');
                            displayMessage('Student information auto-filled successfully!', 'success');
                            isStudentInfoFetched = true;
                        } else {
                            displayMessage(response.message || 'Student ID not found.', 'warning');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        displayMessage('Error fetching student information.', 'danger');
                    },
                    complete: function() {
                        // Hide spinner after request completes
                        $spinner.hide();
                    }
                });
            }

            // Function to display messages
            function displayMessage(message, type) {
                let $existingMessage = $('#registerMessage');

                if ($existingMessage.length === 0) {
                    // If the message div doesn't exist, create it
                    $existingMessage = $('<div>', {
                        id: 'registerMessage',
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
                    // Prepend the message to the form
                    $registerForm.prepend($existingMessage);
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

            // Function to submit the form
            function submitForm() {
                // Disable the register button to prevent multiple submissions
                $registerButton.prop('disabled', true);
                // Show the loading spinner
                $spinner.show();

                // Submit the form after a short delay to show the spinner
                setTimeout(function () {
                    $registerForm.submit();
                }, 500);
            }

            // Function to scan barcode via AJAX
            function scanBarcode() {
                $.ajax({
                    url: 'http://192.168.0.109:5000/scan', // Update this URL if necessary
                    method: 'GET',
                    dataType: 'json',
                    success: function (data) {
                        if (data.success && data.barcode) {
                            handleBarcodeScan(data.barcode); // Auto-fill Student ID and fetch info
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

            // Allow manual submission with validation
            $registerForm.on('submit', function (event) {
                const form = this;

                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                $(form).addClass('was-validated');

                // If the form is valid, show the spinner
                if (form.checkValidity()) {
                    $spinner.show();
                } else {
                    // Prevent form submission if invalid
                    event.preventDefault();
                    event.stopPropagation();
                }
            });

            // Optionally, stop scanning once the student info is fetched
            // Uncomment the following lines if you want to stop scanning after auto-fill
            /*
            if (isStudentInfoFetched) {
                clearInterval(scanInterval);
            }
            */
        });


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
                                    data: {
                                        department_id: departmentID
                                    },
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