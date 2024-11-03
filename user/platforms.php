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
            <div class="container my-5">
        <!-- Forum Header -->
        <h2 class="mb-4">Candidate Platforms</h2>

        <!-- Post Submission Form -->
        <div class="card mb-5">
            <div class="card-header">
                <h5 class="mb-0">Post Your Platform</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" placeholder="Platform Title" required>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea class="form-control" id="content" rows="5" placeholder="Describe your platform..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Post Platform</button>
                </form>
            </div>
        </div>

        <!-- Forum Posts -->
        <div class="post-list">
            <!-- Example Post -->
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="images/candidates/profile1.jpg" alt="Candidate Image" class="rounded-circle me-3" width="50" height="50">
                        <div>
                            <h5 class="mb-0">Platform Title</h5>
                            <small>by Candidate Name (Partylist Name)</small>
                        </div>
                    </div>
                    <small class="text-muted">Posted on 2023-01-01</small>
                </div>
                <div class="card-body">
                    <p>This is an example of a platform post content where the candidate describes their platform in detail...</p>
                </div>
            </div>

            <!-- Another Example Post -->
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <img src="images/candidates/profile2.jpg" alt="Candidate Image" class="rounded-circle me-3" width="50" height="50">
                        <div>
                            <h5 class="mb-0">Platform Title</h5>
                            <small>by Another Candidate (Another Partylist)</small>
                        </div>
                    </div>
                    <small class="text-muted">Posted on 2023-02-15</small>
                </div>
                <div class="card-body">
                    <p>Another candidate's platform details, explaining their goals and plans...</p>
                </div>
            </div>
            <!-- Add more posts as needed -->
        </div>
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