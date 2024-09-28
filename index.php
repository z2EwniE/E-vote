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
							<h3><strong>Analytics</strong> Dashboard</h3>
						</div>

					
					</div>
					<div class="row">
						<div class="col-xl-6 col-xxl-5 d-flex">
							<div class="w-100">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Enrollees</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="users"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">2382</h1>
											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Unregistered Students</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="user-x"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">1300</h1>

											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Total Registered Students</h5>
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="check-circle"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3">5230</h1>

											</div>
										</div>
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col mt-0">
														<h5 class="card-title">Votes At This Time</h5>
														
													</div>

													<div class="col-auto">
														<div class="stat text-primary">
															<i class="align-middle" data-feather="clipboard"></i>
														</div>
													</div>
												</div>
												<h1 class="mt-1 mb-3" id="voteCount">0</h1>

											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-xl-6 col-xxl-7">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<div class="float-end">
										<form class="row g-2">
											<div class="col-auto">
												<select class="form-select form-select-sm bg-light border-0">
													<option>2024-2025</option>
													<option>2023-2024</option>
												</select>
											</div>
											<div class="col-auto">
												<input type="text" class="form-control form-control-sm bg-light rounded-2 border-0" style="width: 100px;"
													placeholder="Search..">
											</div>
										</form>
									</div>
									<h5 class="card-title mb-0">Yearly Voters</h5>
								</div>
								<div class="card-body pt-2 pb-3">
									<div class="chart chart-sm">
										<canvas id="chartjs-dashboard-line"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-6 col-md-6 col-xxl-6 d-flex order-1 order-xxl-3">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<div class="card-actions float-end">
										<div class="dropdown position-relative">
											<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
												<i class="align-middle" data-feather="more-horizontal"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-end">
												<a class="dropdown-item" href="#">Action</a>
												<a class="dropdown-item" href="#">Another action</a>
												<a class="dropdown-item" href="#">Something else here</a>
											</div>
										</div>
									</div>
									<h5 class="card-title mb-0">Total Votes</h5>	
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="py-3">
											<div class="chart chart-xs">
												<canvas id="chartjs-dashboard-pie"></canvas>
											</div>
										</div>

										<table class="table mb-0">
											<tbody>
												<tr>
													<td><i class="fas fa-circle text-primary fa-fw"></i> CAS <span
															class="badge badge-success-light">+12%</span></td>
													<td class="text-end">4306</td>
												</tr>
												<tr>
													<td><i class="fas fa-circle text-warning fa-fw"></i> CBME <span
															class="badge badge-danger-light">-3%</span></td>
													<td class="text-end">3801</td>
												</tr>
												<tr>
													<td><i class="fas fa-circle text-danger fa-fw"></i>CTE</td>
													<td class="text-end">1689</td>
												</tr>
												<tr>
													<td><i class="fas fa-circle text-dark fa-fw"></i> Other</td>
													<td class="text-end">3251</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
                        <div class="col-6 col-lg-6 col-xxl-6 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">
                                    <div class="card-actions float-end">
                                        <div class="dropdown position-relative">
                                            <a href="#" data-bs-toggle="dropdown" data-bs-display="static">
                                                <i class="align-middle" data-feather="more-horizontal"></i>
                                            </a>

                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                            </div>
                                        </div>
                                    </div>
                                    <h5 class="card-title mb-0">Monthly Registered Students</h5>
                                </div>
                                <div class="card-body d-flex w-100">
                                    <div class="align-self-center chart chart-lg">
                                        <canvas id="chartjs-dashboard-bar"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

					</div>

					<div class="row">
						<div class="col-12 col-lg-12 col-xxl-12 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<div class="card-actions float-end">
										<div class="dropdown position-relative">
											<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
												<i class="align-middle" data-feather="more-horizontal"></i>
											</a>

											<div class="dropdown-menu dropdown-menu-end">
												<a class="dropdown-item" href="#">Action</a>
												<a class="dropdown-item" href="#">Another action</a>
												<a class="dropdown-item" href="#">Something else here</a>
											</div>
										</div>
									</div>
									<h5 class="card-title mb-0">Vote Logs</h5>
								</div>
								<table class="table table-borderless my-0">
									<thead>
										<tr>
											<th>Student Name</th>
											<th class="d-none d-xxl-table-cell">ID Number</th>
											<th class="d-none d-xl-table-cell">Year Level</th>
											<th>Course</th>
											<th class="d-none d-xl-table-cell">Action</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="d-flex">
													<div class="flex-shrink-0">
														<div class="bg-light rounded-2">
															<img class="p-2" src="img/icons/brand-1.svg">
														</div>
													</div>
													<div class="flex-grow-1 ms-3">
														<strong>Project Apollo</strong>
														<div class="text-muted">
															Web, UI/UX Design
														</div>
													</div>
												</div>
											</td>
											<td class="d-none d-xxl-table-cell">
												<strong>Lechters</strong>
												<div class="text-muted">
													Real Estate
												</div>
											</td>
											<td class="d-none d-xl-table-cell">
												<strong>Vanessa Tucker</strong>
												<div class="text-muted">
													HTML, JS, React
												</div>
											</td>
											<td>
												<div class="d-flex flex-column w-100">
													<span class="me-2 mb-1 text-muted">65%</span>
													<div class="progress progress-sm bg-success-light w-100">
														<div class="progress-bar bg-success" role="progressbar" style="width: 65%;"></div>
													</div>
												</div>
											</td>
											<td class="d-none d-xl-table-cell">
												<a href="#" class="btn btn-light">View</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex">
													<div class="flex-shrink-0">
														<div class="bg-light rounded-2">
															<img class="p-2" src="img/icons/brand-2.svg">
														</div>
													</div>
													<div class="flex-grow-1 ms-3">
														<strong>Project Bongo</strong>
														<div class="text-muted">
															Web
														</div>
													</div>
												</div>
											</td>
											<td class="d-none d-xxl-table-cell">
												<strong>Cellophane Transportation</strong>
												<div class="text-muted">
													Transportation
												</div>
											</td>
											<td class="d-none d-xl-table-cell">
												<strong>William Harris</strong>
												<div class="text-muted">
													HTML, JS, Vue
												</div>
											</td>
											<td>
												<div class="d-flex flex-column w-100">
													<span class="me-2 mb-1 text-muted">33%</span>
													<div class="progress progress-sm bg-danger-light w-100">
														<div class="progress-bar bg-danger" role="progressbar" style="width: 33%;"></div>
													</div>
												</div>
											</td>
											<td class="d-none d-xl-table-cell">
												<a href="#" class="btn btn-light">View</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex">
													<div class="flex-shrink-0">
														<div class="bg-light rounded-2">
															<img class="p-2" src="img/icons/brand-3.svg">
														</div>
													</div>
													<div class="flex-grow-1 ms-3">
														<strong>Project Canary</strong>
														<div class="text-muted">
															Web, UI/UX Design
														</div>
													</div>
												</div>
											</td>
											<td class="d-none d-xxl-table-cell">
												<strong>Clemens</strong>
												<div class="text-muted">
													Insurance
												</div>
											</td>
											<td class="d-none d-xl-table-cell">
												<strong>Sharon Lessman</strong>
												<div class="text-muted">
													HTML, JS, Laravel
												</div>
											</td>
											<td>
												<div class="d-flex flex-column w-100">
													<span class="me-2 mb-1 text-muted">50%</span>
													<div class="progress progress-sm bg-warning-light w-100">
														<div class="progress-bar bg-warning" role="progressbar" style="width: 50%;"></div>
													</div>
												</div>
											</td>
											<td class="d-none d-xl-table-cell">
												<a href="#" class="btn btn-light">View</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex">
													<div class="flex-shrink-0">
														<div class="bg-light rounded-2">
															<img class="p-2" src="img/icons/brand-4.svg">
														</div>
													</div>
													<div class="flex-grow-1 ms-3">
														<strong>Project Edison</strong>
														<div class="text-muted">
															UI/UX Design
														</div>
													</div>
												</div>
											</td>
											<td class="d-none d-xxl-table-cell">
												<strong>Affinity Investment Group</strong>
												<div class="text-muted">
													Finance
												</div>
											</td>
											<td class="d-none d-xl-table-cell">
												<strong>Vanessa Tucker</strong>
												<div class="text-muted">
													HTML, JS, React
												</div>
											</td>
											<td>
												<div class="d-flex flex-column w-100">
													<span class="me-2 mb-1 text-muted">80%</span>
													<div class="progress progress-sm bg-success-light w-100">
														<div class="progress-bar bg-success" role="progressbar" style="width: 80%;"></div>
													</div>
												</div>
											</td>
											<td class="d-none d-xl-table-cell">
												<a href="#" class="btn btn-light">View</a>
											</td>
										</tr>
										<tr>
											<td>
												<div class="d-flex">
													<div class="flex-shrink-0">
														<div class="bg-light rounded-2">
															<img class="p-2" src="img/icons/brand-5.svg">
														</div>
													</div>
													<div class="flex-grow-1 ms-3">
														<strong>Project Indigo</strong>
														<div class="text-muted">
															Web, UI/UX Design
														</div>
													</div>
												</div>
											</td>
											<td class="d-none d-xxl-table-cell">
												<strong>Konsili</strong>
												<div class="text-muted">
													Retail
												</div>
											</td>
											<td class="d-none d-xl-table-cell">
												<strong>Christina Mason</strong>
												<div class="text-muted">
													HTML, JS, Vue
												</div>
											</td>
											<td>
												<div class="d-flex flex-column w-100">
													<span class="me-2 mb-1 text-muted">78%</span>
													<div class="progress progress-sm bg-primary-light w-100">
														<div class="progress-bar bg-primary" role="progressbar" style="width: 78%;"></div>
													</div>
												</div>
											</td>
											<td class="d-none d-xl-table-cell">
												<a href="#" class="btn btn-light">View</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

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
          message: "Welcome to Admin Site. <u><a class=\"text-white\" target=\"_blank\">More info</a></u> 🚀",
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