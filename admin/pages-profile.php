<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

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
			<main class="content">
				<div class="container-fluid p-0">

					<div class="row mb-2 mb-xl-3">
						<div class="col-auto d-none d-sm-block">
							<h3><strong>Profile</strong></h3>
						</div>

                        <div class="row justify-content-center">
    <div class="col-md-3 col-xl-3">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Profile Details</h5>
            </div>
            <div class="card-body text-center">
                <img src="img/avatars/qoshima.jpg" alt="qoshima" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                <h5 class="card-title mb-0">qoshima</h5>
                <div class="text-muted mb-2">Lead ajax</div>
                <div>
                    <a class="btn btn-primary btn-sm" href="#">Follow</a>
                    <a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span> Message</a>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">Skills</h5>
                <a href="#" class="badge bg-primary me-1 my-1">HTML</a>
                <a href="#" class="badge bg-primary me-1 my-1">JavaScript</a>
                <a href="#" class="badge bg-primary me-1 my-1">Sass</a>
                <a href="#" class="badge bg-primary me-1 my-1">Angular</a>
                <a href="#" class="badge bg-primary me-1 my-1">Vue</a>
                <a href="#" class="badge bg-primary me-1 my-1">React</a>
                <a href="#" class="badge bg-primary me-1 my-1">Redux</a>
                <a href="#" class="badge bg-primary me-1 my-1">UI</a>
                <a href="#" class="badge bg-primary me-1 my-1">UX</a>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">About</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#">Jan lang sa gedli</a></li>
                    <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Works at <a href="#">PH.com</a></li>
                    <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> From <a href="#">Under the sea</a></li>
                </ul>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">Elsewhere</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1"><span class="fas fa-globe fa-fw me-1"></span> <a href="#">staciehall.co</a></li>
                    <li class="mb-1"><span class="fab fa-twitter fa-fw me-1"></span> <a href="#">Twitter</a></li>
                    <li class="mb-1"><span class="fab fa-facebook fa-fw me-1"></span> <a href="#">Facebook</a></li>
                    <li class="mb-1"><span class="fab fa-instagram fa-fw me-1"></span> <a href="#">Instagram</a></li>
                </ul>
            </div>
        </div>
    </div>

          <div class="col-md-4 col-xl-3">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Profile Details</h5>
            </div>
            <div class="card-body text-center">
                <img src="img/avatars/qoshima.jpg" alt="qoshima" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                <h5 class="card-title mb-0">qoshima</h5>
                <div class="text-muted mb-2">Lead ajax</div>
                <div>
                    <a class="btn btn-primary btn-sm" href="#">Follow</a>
                    <a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span> Message</a>
                </div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">Skills</h5>
                <a href="#" class="badge bg-primary me-1 my-1">HTML</a>
                <a href="#" class="badge bg-primary me-1 my-1">JavaScript</a>
                <a href="#" class="badge bg-primary me-1 my-1">Sass</a>
                <a href="#" class="badge bg-primary me-1 my-1">Angular</a>
                <a href="#" class="badge bg-primary me-1 my-1">Vue</a>
                <a href="#" class="badge bg-primary me-1 my-1">React</a>
                <a href="#" class="badge bg-primary me-1 my-1">Redux</a>
                <a href="#" class="badge bg-primary me-1 my-1">UI</a>
                <a href="#" class="badge bg-primary me-1 my-1">UX</a>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">About</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span> Lives in <a href="#">Jan lang sa gedli</a></li>
                    <li class="mb-1"><span data-feather="briefcase" class="feather-sm me-1"></span> Works at <a href="#">PH.com</a></li>
                    <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span> From <a href="#">Under the sea</a></li>
                </ul>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">Elsewhere</h5>
                <ul class="list-unstyled mb-0">
                    <li class="mb-1"><span class="fas fa-globe fa-fw me-1"></span> <a href="#">staciehall.co</a></li>
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

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
			var gradientLight = ctx.createLinearGradient(0, 0, 0, 225);
			gradientLight.addColorStop(0, "rgba(215, 227, 244, 1)");
			gradientLight.addColorStop(1, "rgba(215, 227, 244, 0)");
			var gradientDark = ctx.createLinearGradient(0, 0, 0, 225);
			gradientDark.addColorStop(0, "rgba(51, 66, 84, 1)");
			gradientDark.addColorStop(1, "rgba(51, 66, 84, 0)");
			// Line chart
			new Chart(document.getElementById("chartjs-dashboard-line"), {
				type: "line",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "Voter",
						fill: true,
						backgroundColor: window.theme.id === "light" ? gradientLight : gradientDark,
						borderColor: window.theme.primary,
						data: [
							2115,
							1562,
							1584,
							1892,
							1587,
							1923,
							2566,
							2448,
							2805,
							3438,
							2917,
							3327
						]
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					tooltips: {
						intersect: false
					},
					hover: {
						intersect: true
					},
					plugins: {
						filler: {
							propagate: false
						}
					},
					scales: {
						xAxes: [{
							reverse: true,
							gridLines: {
								color: "rgba(0,0,0,0.0)"
							}
						}],
						yAxes: [{
							ticks: {
								stepSize: 1000
							},
							display: true,
							borderDash: [3, 3],
							gridLines: {
								color: "rgba(0,0,0,0.0)",
								fontColor: "#fff"
							}
						}]
					}
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Pie chart
			new Chart(document.getElementById("chartjs-dashboard-pie"), {
				type: "pie",
				data: {
					labels: ["CAS", "CBME", "CTE", "Other"],
					datasets: [{
						data: [4306, 3801, 1689, 3251],
						backgroundColor: [
							window.theme.primary,
							window.theme.warning,
							window.theme.danger,
							"#E8EAED"
						],
						borderWidth: 5,
						borderColor: window.theme.white
					}]
				},
				options: {
					responsive: !window.MSInputMethodContext,
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					cutoutPercentage: 70
				}
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Bar chart
			new Chart(document.getElementById("chartjs-dashboard-bar"), {
				type: "bar",
				data: {
					labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
					datasets: [{
						label: "This year",
						backgroundColor: window.theme.primary,
						borderColor: window.theme.primary,
						hoverBackgroundColor: window.theme.primary,
						hoverBorderColor: window.theme.primary,
						data: [54, 67, 41, 55, 62, 45, 55, 73, 60, 76, 48, 79],
						barPercentage: .75,
						categoryPercentage: .5
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						yAxes: [{
							gridLines: {
								display: false
							},
							stacked: false,
							ticks: {
								stepSize: 20
							}
						}],
						xAxes: [{
							stacked: false,
							gridLines: {
								color: "transparent"
							}
						}]
					}
				}
			});
		});
	</script>


	<script>
    function fetchVoteCount() {
       
        fetch('/api/votes')
            .then(response => response.json())
            .then(data => {
                
                document.getElementById('voteCount').textContent = data.count;
            })
            .catch(error => console.error('Error fetching vote count:', error));
    }

    // Fetch the vote count every 5 seconds
    setInterval(fetchVoteCount, 5000);
    
   
    fetchVoteCount();
	</script>

	<!--
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			var markers = [{
					coords: [17.352061, 120.455900],
           			name: "ISPSC Main Campus"
				},
				{
					coords: [28.704060, 77.102493],
					name: "Delhi"
				},
				{
					coords: [6.524379, 3.379206],
					name: "Lagos"
				},
				{
					coords: [35.689487, 139.691711],
					name: "Tokyo"
				},
				{
					coords: [23.129110, 113.264381],
					name: "Guangzhou"
				},
				{
					coords: [40.7127837, -74.0059413],
					name: "New York"
				},
				{
					coords: [34.052235, -118.243683],
					name: "Los Angeles"
				},
				{
					coords: [41.878113, -87.629799],
					name: "Chicago"
				},
				{
					coords: [51.507351, -0.127758],
					name: "London"
				},
				{
					coords: [40.416775, -3.703790],
					name: "Madrid "
				}
			];
			var map = new jsVectorMap({
				map: "philippines",
				selector: "#world_map",
				zoomButtons: true,
				markers: markers,
				markerStyle: {
					initial: {
						r: 9,
						stroke: window.theme.white,
						strokeWidth: 7,
						stokeOpacity: .4,
						fill: window.theme.primary
					},
					hover: {
						fill: window.theme.primary,
						stroke: window.theme.primary
					}
				},
				regionStyle: {
					initial: {
						fill: window.theme["gray-200"]
					}
				},
				zoomOnScroll: false
			});
			window.addEventListener("resize", () => {
				map.updateSize();
			});
			setTimeout(function() {
				map.updateSize();
			}, 250);
		});
	</script>
	-->
	<script>
		    document.addEventListener("DOMContentLoaded", function() {
        // Get the current date
        var currentDate = new Date();
        var formattedDate = currentDate.getFullYear() + "-" +
                            ("0" + (currentDate.getMonth() + 1)).slice(-2) + "-" +
                            ("0" + currentDate.getDate()).slice(-2);
        
        // Initialize flatpickr with the current date
        document.getElementById("datetimepicker-dashboard").flatpickr({
            inline: true,
            prevArrow: "<span class=\"fas fa-chevron-left\" title=\"Previous month\"></span>",
            nextArrow: "<span class=\"fas fa-chevron-right\" title=\"Next month\"></span>",
            defaultDate: formattedDate
        });
    });
	</script>

<script>
  document.addEventListener("DOMContentLoaded", function(event) { 
    setTimeout(function(){
      if(localStorage.getItem('popState') !== 'shown'){
        window.notyf.open({
          type: "success",
          message: "Welcome to Admin Site. <u><a class=\"text-white\" " target=\"_blank\">More info</a></u> 🚀",
          duration: 10000,
          ripple: true,
          dismissible: false,
          position: {
            x: "left",
            y: "bottom"
          }
        });

        localStorage.setItem('popState','shown');
      }
    }, 15000);
  });
</script></body>

</html>