<?php
include_once __DIR__ . "/../config/init.php";
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

     <link rel="stylesheet" href="https://atugatran.github.io/FontAwesome6Pro/css/all.min.css" >

	<style>
		body {
			opacity: 0;
		}

      th.sortable{
        cursor: pointer;
        white-space: nowrap;
      }
    
    th.sortable i{
        
        margin-left: 5px;
        font-size: 0.85em;
    }

    th{
        vertical-align: middle;
    }

    /* Add hover effect for better interaction */
    table thead th:hover {
        background-color: #f8f9fa;
    }

    /* Add padding for better spacing */
    table thead th, table tbody td {
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

        <?php
            include_once 'includes/sidebar.php';
        ?>

		<div class="main">

            <?php
                include_once 'includes/navbar.php';
            ?>
			<!-- start here -->
            <main class="content">
				<div class="container-fluid p-0">

                

					<div class="mb-3">
						<h1 class="h3 d-inline align-middle">Candidates</h1>
							
					</div>

					<div class="row">
						<div class="col-xl-12">
							<div class="card">
								<div class="card-header pb-0">
									<div class="card-actions float-end">
										<div class="dropdown position-relative">
											<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
												<i class="align-middle" ></i>
											</a>
									
										</div>
									</div>
									<h5 class="card-title mb-0">Registered Candidates</h5>
								</div>  
								<div class="card-body">
                                    <!--
                                <div class="row mb-3">
                                  <div class="col-md-6">
                             <input type="text" id="searchStudent" class="form-control" 
                                    placeholder="Search by Student ID Number ONLY" onkeyup="restrictInput(event); searchTable()"
                                    maxlength="9">
                              </div> -->
                             </div>
                             <div class="container mt-5">
                             <table class="table table-responsive table-striped" id="studentTable" style="width:100%">
    <thead class="thead-dark">
        <tr>
            <th onclick="sortTable(1)" class="sortable">Student ID No.</th>
            <th onclick="sortTable(2)" class="sortable">Name <i class="fas fa-sort"></i></th>
            <th class="d-none d-md-table-cell sortable" onclick="sortTable(3)">Year Level <i class="fas fa-sort"></i></th>
            <th>Department</th>
            <th>Partylist</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <?php
// Define SQL query with JOINs to get data from related tables
$sql = "SELECT students.student_id, students.first_name, students.middle_name, students.last_name, students.course, students.year_level, 
               department.department_name, partylists.partylist_name 
        FROM `candidates` 
        INNER JOIN students ON students.id = candidates.candidate_id 
        INNER JOIN positions ON positions.position_id = candidates.candidate_position 
        INNER JOIN department ON candidates.department = department.department_id 
        INNER JOIN partylists ON partylists.partylist_id = candidates.partylist_id";

// Prepare and execute the statement
$stmt = $db->prepare($sql);
$stmt->execute();

// Initialize row number
$row_number = 1;

// Loop through the results and populate each row
foreach ($stmt as $row) {
    
// Construct full name and year level/course
    $name = $row['first_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
    $course = preg_replace('/[^A-Z]/', '', $row['course']);
    $year = $course . ' ' . $row['year_level'];
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['student_id']) . "</td>";
    echo "<td>" . htmlspecialchars($name) . "</td>";
    echo "<td class='d-none d-md-table-cell'>" . htmlspecialchars($year) . "</td>";
    echo "<td>" . htmlspecialchars($row['department_name']) . "</td>";
    echo "<td>" . htmlspecialchars($row['partylist_name']) . "</td>";
    echo "<td>
            <div class='btn-group'>
                <button class='btn btn-danger delete-candidate' 
                        data-id='" . htmlspecialchars($row['student_id']) . "'
                        data-name='" . htmlspecialchars($name) . "'>
                    <i class='fa fa-trash'></i>
                </button>
            </div>
          </td>";
    echo "</tr>";
}
?>

    </tbody>
</table>

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
								<a href="" target="_blank" class="text-muted"><strong>eVote System</strong></a> &copy;
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
	<script src="js/app.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
<!-- Custom Script for Search and Sort -->
        <script>
        
    function restrictInput(event) {
        let input = event.target.value;

        
        let formattedInput = input.replace(/[^0-9E-]/g, '');
        let eCount = (formattedInput.match(/[E]/g) || []).length;
        if (eCount > 1) {
            formattedInput = formattedInput.slice(0, formattedInput.lastIndexOf('E') + 1);
        }

        if (formattedInput.length > 9) {
            formattedInput = formattedInput.slice(0, 9);  // Limit to 9 characters
        }

        event.target.value = formattedInput;  // Update the input field
    }

    function searchTable() {
        let input = document.getElementById("searchStudent").value;

        let table = document.getElementById("studentTable");
        let tr = table.getElementsByTagName("tr");

        for (let i = 1; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName("td")[1];  // Assuming you're searching in the second column

            if (td) {
                let txtValue = td.textContent || td.innerText;

                // Display row only if input matches, no need to wait for exactly 8 characters
                tr[i].style.display = (txtValue.indexOf(input) > -1) ? "" : "none";
            }
        }
    }


         let currentSortOrder = {}; // Track sorting direction for each column

    function sortTable(columnIndex) {
    let table = document.getElementById("studentTable");
    let rows = Array.from(table.rows).slice(1); // Skip the header row

    // Determine if the column is currently sorted in ascending order
    let isAscending = currentSortOrder[columnIndex] === 'asc';

    // Sort the rows based on the column index
    let sortedRows = rows.sort((a, b) => {
        let aText = a.cells[columnIndex].innerText.toLowerCase();
        let bText = b.cells[columnIndex].innerText.toLowerCase();

        if (columnIndex === 0 || columnIndex === 1) {
            // Sort the "No." or "Student ID No." column as numbers
            let aValue = parseInt(aText);
            let bValue = parseInt(bText);
            return isAscending ? aValue - bValue : bValue - aValue;
        } else {
            // For text-based columns (like Name), sort alphabetically
            return isAscending ? aText.localeCompare(bText) : bText.localeCompare(aText);
        }
        });

    // Toggle the sort order for next click
    currentSortOrder[columnIndex] = isAscending ? 'desc' : 'asc';

    // Rebuild the table with sorted rows
    let tbody = table.querySelector('tbody');
    sortedRows.forEach(row => tbody.appendChild(row));

    // Update sorting icons
    updateSortIcons(columnIndex, isAscending);
    }

// Function to update the sort icons based on the sorting direction
        function updateSortIcons(columnIndex, isAscending) {
    let thElements = document.querySelectorAll('.sortable i');
    thElements.forEach((icon, idx) => {
        icon.className = 'fas fa-sort'; // Reset all icons to neutral sort icon
        if (idx === columnIndex) {
            icon.className = isAscending ? 'fas fa-sort-up' : 'fas fa-sort-down'; // Update the clicked column icon
         }
    });
        }

    </script>

    <script>
    $(document).ready(function() {
        $('.delete-candidate').click(function() {
            const studentId = $(this).data('id');
            const studentName = $(this).data('name');
            const row = $(this).closest('tr');
            
            if (confirm(`Are you sure you want to delete ${studentName} from candidates?`)) {
                $.ajax({
                    url: 'process/delete_candidate.php',
                    type: 'POST',
                    data: {
                        student_id: studentId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            row.fadeOut(400, function() {
                                $(this).remove();
                            });
                            alert('Candidate deleted successfully');
                        } else {
                            alert(response.message || 'Error deleting candidate');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Ajax Error:', {
                            status: status,
                            error: error,
                            response: xhr.responseText
                        });
                        alert('Error connecting to the server. Please try again.');
                    }
                });
            }
        });
    });
    </script>

    </body>

    </html> 