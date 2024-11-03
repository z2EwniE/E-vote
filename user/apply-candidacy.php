<?php
session_start();

include_once __DIR__ . '/db.php';




// Redirect to login page if not logged in
if (!isset($_SESSION['student_id'])) {
    header('Location: login.php'); 
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="e-vote, voting system, secure voting, elections">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/professional-icon.png" />
    <title>E-Vote System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="css/light.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script>
    </script>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">
        <div class="main">
            <?php include_once 'includes/navbar.php'; ?>

            <main class="content">
                <div class="container">
                    <h2 class="mb-4">Apply for Candidacy</h2>

                    <form action="apply-candidacy.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>

                                <?php
                        include_once __DIR__ . '/db.php'; // Include your database connection file

                        // Fetch all positions from the database
                        $stmt = $conn->prepare("SELECT * FROM `positions`");
                        $stmt->execute();
                        $positions = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <!-- Dropdown form field for selecting a position -->
                        <div class="mb-3">
                            <label for="position" class="form-label">Position Applying For</label>
                            <select class="form-select" id="position" name="position" required>
                                <option value="">Select Position</option>
                                <?php foreach ($positions as $position): ?>
                                    <option value="<?php echo $position['position_id']; ?>"><?php echo htmlspecialchars($position['position_name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="partylist" class="form-label">Partylist (Optional)</label>
                            <input type="text" class="form-control" id="partylist" name="partylist"
                                placeholder="Enter party name if applicable">
                        </div>

                        <div class="mb-3">
                            <label for="manifesto" class="form-label">Manifesto</label>
                            <textarea class="form-control" id="manifesto" name="manifesto" rows="4" required
                                placeholder="Explain why you are a good candidate for this position"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="profile_photo" class="form-label">Profile Photo</label>
                            <input type="file" class="form-control" id="profile_photo" name="profile_photo"
                                accept="image/*" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </form>
                </div>
            </main>


            <footer class="footer">
                <div class="container-fluid">
                    <div class="text-muted">
                        <div class="text-center">
                            <a class="text-muted"><strong>ISPSC-Tagudin Campus</strong></a> &copy;
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="js/app.js"></script>



</body>

</html>