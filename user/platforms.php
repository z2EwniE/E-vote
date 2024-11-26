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
    <script src="https://cdn.tiny.cloud/1/s1zhsk9a77bb6jujpqu2nhrpnr7b1t7hxzjuawrdlj68aps4/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
    <script>
    </script>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">
        <div class="main">
            <?php include_once 'includes/navbar.php'; ?>

            <main class="content">
                <div class="container">
                    <h2 class="mb-4">Candidate Platforms</h2>

                    <div class="card mb-5">
                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="platform_title" name="platform_title" placeholder="Platform Title"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Content</label>
                                    <textarea id="platform_content" name="platform_content" class="form-control" id="content" rows="2"
                                        placeholder="Describe your platform..." required></textarea>
                                </div>
                                <button type="submit" id="postPlatformButton" class="btn btn-primary">Post Platform</button>
                            </form>
                        </div>
                    </div>

                    <div class="post-list">
                        <div class="card mb-3">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <img src="images/candidates/profile1.jpg" alt="Candidate Image"
                                        class="rounded-circle me-3" width="50" height="50">
                                    <div>
                                        <h5 class="mb-0">Platform Title</h5>
                                        <small>by Candidate Name (Partylist Name)</small>
                                    </div>
                                </div>
                                <small class="text-muted">Posted on 2023-01-01</small>
                            </div>
                            <div class="card-body">
                                <p>This is an example of a platform post content where the candidate describes their
                                    platform in detail...</p>
                            </div>
                        </div>
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
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
    tinymce.init({
        selector: 'textarea',
        plugins: [
            // Core editing features
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media',
            'searchreplace', 'table', 'visualblocks', 'wordcount',
            // Your account includes a free trial of TinyMCE premium features
            // Try the most popular premium features until Dec 5, 2024:
            'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker',
            'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage',
            'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags',
            'autocorrect', 'typography', 'inlinecss', 'markdown',
            // Early access to document converters
            'importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject(
            'See docs to implement AI Assistant')),
        exportpdf_converter_options: {
            'format': 'Letter',
            'margin_top': '1in',
            'margin_right': '1in',
            'margin_bottom': '1in',
            'margin_left': '1in'
        },
        exportword_converter_options: {
            'document': {
                'size': 'Letter'
            }
        },
        importword_converter_options: {
            'formatting': {
                'styles': 'inline',
                'resets': 'inline',
                'defaults': 'inline',
            }
        },
    });
   
        $(document).ready(function() {
            $("#postPlatformButton").on('click', function(e){
                e.preventDefault();
                    let platform_title = $("#platform_title").val()
                    let platform_content = tinymce.get('platform_content').getContent();
                $.ajax({
                    type: "POST",
                    url: ""
                })

            });
        });
    </script>

</body>

</html>