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
                        <select type="text" id="course" name="course" class="form-control" required>
                    <option value="">Select Course</option> 
                   
                    </select>
                            </div>
   
                            <div class="d-flex float-end w-25 m-2">
                                <select name="year_level" id="year_level" class="form-control">
                                    <option value="">Select a year level</option>
                                </select>
                            </div>
                                <div class="d-flex float-end w-25 m-2">
                                <select id="department" name="department" class="form-select" required>
                        <option value="">Select Department</option>
                        
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
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function() {
    // Fetch departments on page load
    $.ajax({
        url: 'teen_titans/fetch_department.php',
        method: 'GET',
        dataType: 'html',
        success: function(response) {
            $('#department').append(response);
        },
        error: function(xhr, status, error) {
            console.error('Error fetching departments:', xhr.responseText);
        }
    });

    // Fetch courses when a department is selected
    $('#department').on('change', function() {
        var departmentID = $(this).val();
        if (departmentID) {
            $.ajax({
                type: 'POST',
                url: 'teen_titans/fetch_courses.php',
                data: { department_id: departmentID },
                dataType: 'html',
                success: function(response) {
                    $('#course').html('<option value="">Select Course</option>').append(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching courses:', xhr.responseText);
                }
            });
        } else {
            $('#course').html('<option value="">Select Course</option>');
        }

        // Update the chart based on the new selection
        renderTotalVotesChart();
    });

    // Fetch year levels on page load
    fetch('teen_titans/fetch_year_levels.php')
        .then(response => response.json())
        .then(data => {
            const yearLevels = data.year_levels;
            const selectElement = document.getElementById('year_level');
            selectElement.innerHTML = '<option value="">Select a year level</option>'; // Reset year level dropdown

            // Populate the select dropdown with the year levels
            yearLevels.forEach(level => {
                const option = document.createElement('option');
                option.value = level;
                option.textContent = level;
                selectElement.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching year levels:', error));

    // Fetch and render votes when year level or course is changed
    $('#year_level, #course').on('change', function() {
        renderTotalVotesChart();
    });

    // Fetch votes data and render chart
    async function fetchVotesData() {
        try {
            const department = $('#department').val();
            const course = $('#course').val();
            const year_level = $('#year_level').val();

            const response = await fetch(`teen_titans/fetch_votes.php?department=${department}&course=${course}&year_level=${year_level}`);
            const data = await response.json();
            return data.votes;
        } catch (error) {
            console.error('Error fetching votes data:', error);
            return [];
        }
    }

    async function renderTotalVotesChart() {
        const votesData = await fetchVotesData();

        // Remove the previous chart if it exists
        $('#votesChartTotal').remove();
        $('#chartsContainer').append('<canvas id="votesChartTotal" width="400" height="300"></canvas>');

        if (votesData && votesData.length > 0) {
            const candidates = votesData.map(vote => `Candidate ${vote.candidate_id}`);
            const votes = votesData.map(vote => vote.vote_count);

            // Create the chart
            const ctx = document.getElementById('votesChartTotal').getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: candidates,
                    datasets: [{
                        label: 'Total Votes for All Candidates',
                        data: votes,
                        backgroundColor: ['rgba(54, 162, 235, 0.6)', 'rgba(255, 99, 132, 0.6)', 'rgba(255, 206, 86, 0.6)'],
                        borderColor: ['rgba(54, 162, 235, 1)', 'rgba(255, 99, 132, 1)', 'rgba(255, 206, 86, 1)'],
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
                    }
                }
            });
        } else {
            console.log('No votes data available for the selected filters.');
        }
    }

    // Initial render of the chart on page load
    renderTotalVotesChart();
});

    </script>

</body>

</html>
