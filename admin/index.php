<?php

include_once __DIR__ . "/../config/init.php";

// Include the fetch_student.php file in index.php
include __DIR__ . '/../user/fetch_student.php';

if (!$login->isLoggedIn()) {
	header('Location: login.php' );
}


function countVotesByDepartment() {
	global $db;
	$stmt = $db->prepare("SELECT  department.department_name, COUNT(*) AS vote_count FROM votes INNER JOIN students ON students.id = votes.student_id RIGHT JOIN department ON department.department_id = students.department WHERE department.department_id GROUP BY department.department_id");
	$stmt->execute();
	$row =  $stmt->fetchAll(PDO::FETCH_ASSOC);
		$data = [];
	foreach($row as $r) {
		$data[] = [
			"department" => preg_replace('/[^A-Z]/', '', $r['department_name']),
			"vote_count" => $r['vote_count']
		];
		
	}

	return $data;

}
$votes = countVotesByDepartment();
$department_labels = array_column($votes, 'department');
$vote_count_labels = array_column($votes, 'vote_count');
?>

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
                                                <h1 class="mt-1 mb-3">
                                                    <?php echo isset($total_count) ? $total_count : 'Data not available'; ?>
                                                </h1>

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
											<select id="yearRangeSelect" class="form-select form-select-sm bg-light border-0">
												<option value="2024-2025">2024-2025</option>
											</select>

                                            </div>
                                            <div class="col-auto">
                                                <input type="text"
                                                    class="form-control form-control-sm bg-light rounded-2 border-0"
                                                    style="width: 100px;" placeholder="Search..">
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
                                                <?php foreach($votes as $row):
													// Determine color class based on department
													$colorClass = '';
													if ($row['department'] === 'CAS') {
														$colorClass = 'text-danger'; // Red for CAS
													} elseif ($row['department'] === 'CTE') {
														$colorClass = 'text-primary'; // Blue for CTE
													} elseif ($row['department'] === 'CBME') {
														$colorClass = 'text-success'; // Green for CBME
													}
												?>
                                                <tr>
                                                    <td><i class="fas fa-circle <?= $colorClass ?> fa-fw"></i>
                                                        <?= $row['department'] ?></td>
                                                    <td class="text-end"><?= $row['vote_count'] ?></td>
                                                </tr>
                                                <?php endforeach; ?>

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
                                            <th>Student ID</th>
                                            <th>Student Name</th>
                                            <th>Department</th>
                                            <th>Course & Year Level</th>
                                            <th>Date Voted</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

										$sql = "SELECT * FROM votes 
													INNER JOIN students ON students.id = votes.student_id
													INNER JOIN course ON students.course = course.course_id
													INNER JOIN department ON department.department_id = students.department
													GROUP BY students.student_id;";
										$stmt = $db->prepare($sql);
										$stmt->execute();
										$row = $stmt->fetchAll(PDO::FETCH_ASSOC);

										foreach($row as $r):

											$name = $r['first_name'] . ' ' . $r['middle_name']. ' '. $r['last_name'];
											$course = preg_replace('/[^A-Z]/', '', $r['course_name']);
											$year =  $course . ' ' .$r['year_level'];

										?>
                                        <tr>
                                            <td>
                                                <?= $r['student_id']; ?>
                                            </td>
                                            <td>
                                                <?= $name; ?>
                                            </td>
                                            <td>
                                                <?= preg_replace('/[^A-Z]/', '',$r['department_name']) ?>
                                            </td>
                                            <td>
                                                <?= $year; ?>
                                            </td>
                                            <td>
                                                <?= date("F j, Y \a\\t h:i A", strtotime($r['voted_at'])); ?>
                                            </td>
                                            <td>
                                                <button data-id="<?= $r['id']; ?>"
                                                    class="btn btn-sm btn-outline-success view-votes"><i
                                                        class="fa fa-eye"></i></button>
                                            </td>
                                        </tr>

                                        <?php endforeach; ?>

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
                            <a target="_blank" class="text-muted"><strong>eVote System</strong></a> &copy;
                            </p>
                        </div>
                        <div class="col-6 text-end">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                <a class="text-muted" href="#">ISPSC - Tagudin Campus</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="view-votes-by-id" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Votes</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table">
                        <thead>
                            <th>Position</th>
                            <th>Candidate Name</th>
                            <th>Candidate Partylist</th>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script src="js/app.js"></script>
    <script src="js/index.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
    var ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");
    var gradientLight = ctx.createLinearGradient(0, 0, 0, 225);
    gradientLight.addColorStop(0, "rgba(215, 227, 244, 1)");
    gradientLight.addColorStop(1, "rgba(215, 227, 244, 0)");
    var gradientDark = ctx.createLinearGradient(0, 0, 0, 225);
    gradientDark.addColorStop(0, "rgba(51, 66, 84, 1)");
    gradientDark.addColorStop(1, "rgba(51, 66, 84, 0)");

    var chart;

    function createChart(labels, data) {
        chart = new Chart(ctx, {
            type: "line",
            data: {
                labels: labels,
                datasets: [{
                    label: "Voter",
                    fill: true,
                    backgroundColor: window.theme.id === "light" ? gradientLight : gradientDark,
                    borderColor: window.theme.primary,
                    data: data
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
    }

    function fetchMonthlyVoterData(yearRange) {
        fetch(`process/getMonthlyVoters.php?yearRange=${yearRange}`) // Adjust the endpoint to receive yearRange
            .then(response => response.json())
            .then(data => {
                const labels = data.labels;
                const chartData = data.data;

                if (chart) {
                    chart.data.labels = labels;
                    chart.data.datasets[0].data = chartData;
                    chart.update();
                } else {
                    createChart(labels, chartData);
                }
            })
            .catch(error => console.error("Error fetching data:", error));
    }

    // Fetch initial data for the default selected year range
    const initialYearRange = document.getElementById("yearRangeSelect").value;
    fetchMonthlyVoterData(initialYearRange);

    // Update chart data on year range selection change
    document.getElementById("yearRangeSelect").addEventListener("change", function() {
        const selectedYearRange = this.value;
        fetchMonthlyVoterData(selectedYearRange);
    });
});



    document.addEventListener("DOMContentLoaded", function() {
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: <?= json_encode($department_labels); ?>,
                datasets: [{
                    data: <?= json_encode($vote_count_labels); ?>,
                    backgroundColor: [
                        window.theme.danger,
                        window.theme.primary,
                        window.theme.success,
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

    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById("chartjs-dashboard-bar").getContext("2d");
        let chart;

        function createChart(labels, data) {
            chart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "This year",
                        backgroundColor: window.theme.primary,
                        borderColor: window.theme.primary,
                        hoverBackgroundColor: window.theme.primary,
                        hoverBorderColor: window.theme.primary,
                        data: data,
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
        }

        function fetchMonthlyRegistrations() {
            fetch('process/monthly-registers.php')
                .then(response => response.json())
                .then(data => {
                    const labels = data.labels;
                    const chartData = data.data;

                    if (chart) {
                        // Update existing chart data
                        chart.data.labels = labels;
                        chart.data.datasets[0].data = chartData;
                        chart.update();
                    } else {
                        // Create chart if it doesn't exist
                        createChart(labels, chartData);
                    }
                })
                .catch(error => console.error("Error fetching data:", error));
        }

        // Initial fetch to load data into the chart
        fetchMonthlyRegistrations();
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
        setTimeout(function() {
            if (localStorage.getItem('popState') !== 'shown') {
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

                localStorage.setItem('popState', 'shown');
            }
        }, 15000);
    });
    </script>
</body>

</html>