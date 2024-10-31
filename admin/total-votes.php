<?php
    include_once __DIR__ . '/../config/init.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="qoshima">
    <meta name="keywords" content="Admin, dashboard, responsive, css, sass, html, theme, front-end">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png" />
    <title>E-Vote System</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <!-- Choose your preferred color scheme -->
    <link href="css/light.css" rel="stylesheet">

    <style>
        body {
            opacity: 0;
        }

        th.sortable {
            cursor: pointer;
            white-space: nowrap;
        }

        th.sortable i {
            margin-left: 5px;
            font-size: 0.85em;
        }

        th {
            vertical-align: middle;
        }

        /* Add hover effect for better interaction */
        table thead th:hover {
            background-color: #f8f9fa;
        }

        /* Add padding for better spacing */
        table thead th,
        table tbody td {
            padding: 12px;
            vertical-align: middle;
        }

        /* Highlight the active column for better clarity */
        .table-striped tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Align the sort icon next to the text */
        th.sortable i {
            margin-left: 5px;
        }

        /* Custom styling for sort icons */
        th.sortable i.fa-sort-up,
        th.sortable i.fa-sort-down {
            color: #000;
        }
    </style>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">
        <?php include_once 'includes/sidebar.php'; ?>

        <div class="main">
            <?php include_once 'includes/navbar.php'; ?>

            <!-- start here -->
            <main class="content">
                <div class="container-fluid p-0">

                    <div class="card">
                        <div class="card-header">
                        <div class="d-flex float-end w-25 m-2">
                                <select name="year" id="year" class="form-control">
                                    <option value="1">CAS</option>
                                    <option value="2">CTE</option>
                                    <option value="3">CBME</option>
                                </select>
                            </div>
                            <div class="d-flex float-end w-25 m-2">
                                <select name="year" id="year" class="form-control">
                                    <option value="1">First Year</option>
                                    <option value="2">Second Year</option>
                                    <option value="3">Third Year</option>
                                    <option value="4">Fourth Year</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-body">                
                                <div id="chartsContainer" style="display: flex; flex-wrap: wrap; gap: 20px;"></div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>

        <script>
            async function fetchVotesData() {
                try {
                    const response = await fetch('fetch_votes.php');
                    const data = await response.json();
                    return data.votes;
                } catch (error) {
                    console.error('Error fetching votes data:', error);
                    return [];
                }
            }

            async function renderTotalVotesChart() {
                const votesData = await fetchVotesData();

                if (votesData && votesData.length > 0) {
                    const candidates = votesData.map(vote => `Candidate ${vote.candidate_id}`);
                    const votes = votesData.map(vote => vote.vote_count);

                    // Create the plot
                    const ctx = document.getElementById('votesChartTotal').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: candidates,
                            datasets: [{
                                label: 'Total Votes for All Candidates',
                                data: votes,
                                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Candidates'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Number of Votes'
                                    },
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            }

            document.addEventListener('DOMContentLoaded', () => {
                // Add a container for the total votes chart
                const chartsContainer = document.getElementById('chartsContainer');
                const totalVotesChartDiv = document.createElement('div');
                totalVotesChartDiv.innerHTML = `<h3>Total Votes by Candidate</h3><canvas id="votesChartTotal" width="400" height="300"></canvas>`;
                chartsContainer.appendChild(totalVotesChartDiv);

                // Render the total votes chart
                renderTotalVotesChart();

                // Initialize the program-specific charts
                initializeCharts();
            });
        </script>

</body>

</html>
