<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="qoshima">
	<meta name="keywords" content=" Admin, dashboard, responsive, css, sass, html, theme, front-end">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="img/icons/icon-48x48.png" />
	<title>E-Vote System</title>

	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

	<!-- Choose your prefered color scheme -->
	 <link href="css/light.css" rel="stylesheet">
    

	<style>
		body {
			opacity: 0;
		}

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 15px;
            background-color: #CCCCCC;
        }
        .card-body {
            text-align: left;
        }
        .card-title{
            color: green;
        }
        .card-header{
            background: #CCCCCC;
        }
    
	</style>
</head>


<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
	<div class="wrapper">

        <?php
            include_once 'includes/sidebar.php';
        ?>

		<div class="main">

            <?php
                include_once 'includes/navbar.php';
            ?>
			<main class="content" style="background-color: #1A1A1A;">
				<div class="container-fluid p-0">

					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block">
							<h3 style="color: #FFAC1C;"><strong>Partylist Name</strong></h3>
						</div>

                        <div class="container-fluid p-0">
    <!-- First row centered -->
    <div class="row justify-content-center mb-3">
        <!-- First card -->
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3" style="border: 2px solid #CCCCCC;">
                <div class="card-header">
                    <h5 class="card-title mb-0" style="color: #F28C28;">Candidate Detail</h5>
                </div>
                <div class="card-body text-center">
                    <img src="img/avatars/qoshima.jpg" alt="qoshima" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    <h5 class="card-title mb-0">goofy</h5>
                    
                    
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">About</h5>
                    <div class="text-muted mb-2">Candidate position:</div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Elsewhere</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a href="#">Twitter</a></li>
                        <li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a href="#">Facebook</a></li>
                        <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Second card -->
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                <h5 class="card-title mb-0" style="color: #F28C28;">Candidate Detail</h5>
                </div>
                <div class="card-body text-center">
                    <img src="img/avatars/qoshima.jpg" alt="qoshima" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    <h5 class="card-title mb-0">siakol</h5>
                    
                    
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">About</h5>
                    <div class="text-muted mb-2">Candidate position:</div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Elsewhere</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a href="#">Twitter</a></li>
                        <li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a href="#">Facebook</a></li>
                        <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Third card -->
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                <h5 class="card-title mb-0" style="color: #F28C28;">Candidate Detail</h5>
                </div>
                <div class="card-body text-center">
                    <img src="img/avatars/qoshima.jpg" alt="qoshima" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    <h5 class="card-title mb-0">ezwifi</h5>
                    
                    
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">About</h5>
                    <div class="text-muted mb-2">Candidate position:</div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Elsewhere</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a href="#">Twitter</a></li>
                        <li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a href="#">Facebook</a></li>
                        <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Second row centered -->
    <div class="row justify-content-center">
        <!-- 1st card here -->
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                <h5 class="card-title mb-0" style="color: #F28C28;">Candidate Detail</h5>
                </div>
                <div class="card-body text-center">
                    <img src="img/avatars/qoshima.jpg" alt="qoshima" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    <h5 class="card-title mb-0">balls</h5>
                    
                    
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">About</h5>
                    <div class="text-muted mb-2">Candidate position:</div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Elsewhere</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a href="#">Twitter</a></li>
                        <li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a href="#">Facebook</a></li>
                        <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
          <!-- 2nd card here -->
                          <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                <h5 class="card-title mb-0" style="color: #F28C28;">Candidate Detail</h5>
                </div>
                <div class="card-body text-center">
                    <img src="img/avatars/qoshima.jpg" alt="qoshima" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    <h5 class="card-title mb-0">notcan</h5>
                    
                    
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">About</h5>
                    <div class="text-muted mb-2">Candidate position:</div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Elsewhere</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a href="#">Twitter</a></li>
                        <li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a href="#">Facebook</a></li>
                        <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
            <!-- 3rd card -->
            <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                <h5 class="card-title mb-0" style="color: #F28C28;">Candidate Detail</h5>
                </div>
                <div class="card-body text-center">
                    <img src="img/avatars/qoshima.jpg" alt="qoshima" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    <h5 class="card-title mb-0">ticnap</h5>
                    
                      
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">About</h5>
                    <div class="text-muted mb-2">Candidate position:</div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Elsewhere</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a href="#">Twitter</a></li>
                        <li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a href="#">Facebook</a></li>
                        <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="container-fluid p-0">
 <!-- Third row centered -->
 <div class="row justify-content-center">
         <!-- 1st card here -->
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                <h5 class="card-title mb-0" style="color: #F28C28;">Candidate Detail</h5>
                </div>
                <div class="card-body text-center">
                    <img src="img/avatars/qoshima.jpg" alt="qoshima" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    <h5 class="card-title mb-0">Ishowcong</h5>
                    
                    
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">About</h5>
                    <div class="text-muted mb-2">Candidate position:</div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Elsewhere</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a href="#">Twitter</a></li>
                        <li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a href="#">Facebook</a></li>
                        <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
          <!-- 2nd card here -->
                          <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header" >
                <h5 class="card-title mb-0" style="color: #F28C28;">Candidate Detail</h5>
                </div>
                <div class="card-body text-center">
                    <img src="img/avatars/qoshima.jpg" alt="qoshima" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    <h5 class="card-title mb-0">penguins</h5>
                    
                    
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">About</h5>
                    <div class="text-muted mb-2">Candidate position:</div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Elsewhere</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a href="#">Twitter</a></li>
                        <li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a href="#">Facebook</a></li>
                        <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 3rd card here -->
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                <h5 class="card-title mb-0" style="color: #F28C28;">Candidate Detail</h5>
                </div>
                <div class="card-body text-center">
                    <img src="img/avatars/qoshima.jpg" alt="qoshima" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    <h5 class="card-title mb-0">julaks</h5>
                    
                    
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">About</h5>
                    <div class="text-muted mb-2">Candidate position:</div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    <h5 class="h6 card-title">Elsewhere</h5>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a href="#">Twitter</a></li>
                        <li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a href="#">Facebook</a></li>
                        <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

                    <!--end of pages -->

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a href="https://github.com/z2EwniE" target="_blank" class="text-muted"><strong>Calvskie</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
    <script src="js/app.js"></script>   
</body>

</html>