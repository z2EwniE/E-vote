<?php

include_once __DIR__ . '/db.php';

session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['student_id'])) {
    header('Location: login.php'); 
    exit();
}

$sql = "SELECT 
            p.platform_id, 
            p.platform_title, 
            p.platform_content, 
            p.platform_image, 
            p.date_posted, 
            CONCAT(s.first_name, ' ', s.middle_name, ' ', s.last_name) AS candidate_name,
            d.department_name
        FROM platforms p
        INNER JOIN candidates c ON c.candidate_id = p.candidate_id
        INNER JOIN students s ON s.id = c.student_id
        INNER JOIN department d ON d.department_id = s.department";

$stmt = $conn->prepare($sql);
$stmt->execute();

$platforms = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <style>
    /* General Styles */
    body {
        font-family: 'Arial', sans-serif;
    }

    .container {
        max-width: 1200px;
    }

    /* Hero Section */
    .hero-section {
        position: relative;
        height: 400px;
        background-image: url('img/photos/ok.png');
        background-size: cover;
        background-position: center;
        color: white;
        padding: 50px 20px;
        text-align: center;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.4);
        /* Dark overlay */
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-title {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .hero-description {
        font-size: 18px;
        font-weight: 400;
    }

    /* Voting Container */
    .voting-container {
        margin: 30px auto;
        padding: 15px;
    }

    /* Voting Cards */
    .vote-card {
        border: 2px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .vote-card:hover {
        border-color: #007bff;
        box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
    }

    .vote-card img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 10px 10px 0 0;
    }

    .card-body {
        padding: 15px;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
    }

    .card-department,
    .card-partylist {
        font-size: 14px;
        color: #777;
    }

    /* Selected Badge */
    .badge-selected {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: #28a745;
        color: white;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 14px;
        display: none;
        /* Initially hidden */
    }

    .vote-card.selected .badge-selected {
        display: block;
        /* Show the selected badge */
    }

    /* Buttons */
    .submit-btn {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 12px 30px;
        font-size: 18px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #0056b3;
    }

    /* Confirmation Modal */
    .modal-content {
        border-radius: 10px;
        padding: 20px;
    }

    .modal-header {
        border-bottom: none;
    }

    .modal-body {
        padding: 20px;
        max-height: 400px;
        overflow-y: auto;
    }

    .modal-footer {
        border-top: none;
    }

    .modal-footer .btn {
        padding: 10px 25px;
    }

    .row.mb-3 {
        margin-bottom: 15px;
    }

    .img-thumbnail {
        border-radius: 10px;
    }

    /* Mobile Responsiveness */
    @media (max-width: 768px) {
        .hero-section {
            height: 300px;
        }

        .hero-title {
            font-size: 28px;
        }

        .vote-card {
            margin-bottom: 15px;
        }

        .vote-card img {
            height: 150px;
        }

        .submit-btn {
            width: 100%;
        }

        .modal-body {
            padding: 10px;
        }
    }
    </style>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">
        <div class="main">
            <?php include_once 'includes/navbar.php'; ?>
            <main class="content">
    <section class="hero-section text-center mb-4" style="background-image: url('img/photos/ok.png'); background-size: cover; background-repeat: no-repeat; background-position: center;">
        <div class="hero-content" style="background: rgba(0, 0, 0, 0.5); padding: 50px;">
            <div class="hero-text">
                <h1 class="hero-title" style="font-family: 'Roboto', sans-serif; color: #fff;">Welcome to the E-Vote System</h1>
                <p class="hero-description" style="font-family: 'Roboto', sans-serif; color: #fff;">Your vote matters! Cast your vote securely and easily in just a few clicks.</p>
            </div>
            <div class="hero-model">
                <img src="img/icons/click-ezgif.com-gif-maker.gif" alt="3D Model Voting" class="model-animation">
            </div>
        </div>
    </section>

    <section class="vote-section mt-4">
        <div class="container-fluid p-4 mt-4" style="background: #f8f9fa; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <?php if(isset($_GET['success'])): ?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Holy guacamole!</strong> Application for Candidacy Success!
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
            <?php if(hasVoted()): ?>
            <h4 class="section-title mt-4">Vote for Your Candidates</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="container">
                        <div class="voting-section">
                            <div id="positions-container"></div>
                        </div>
                        <div class="text-center mt-4">
                            <button type="button" class="btn submit-btn" id="submitVote">Submit Vote <i class="fas fa-check"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <?php
                $id = $_SESSION['id'];
                $sql = "SELECT positions.position_id, positions.position_name, partylists.partylist_name, CONCAT(students.first_name, ' ', students.middle_name, ' ', students.last_name) AS candidate_name, votes.voted_at, department.department_name, candidates.candidate_id FROM votes INNER JOIN candidates ON candidates.candidate_id = votes.candidate_id INNER JOIN students ON students.id = candidates.student_id INNER JOIN course ON students.course = course.course_id INNER JOIN department ON department.department_id = students.department INNER JOIN positions ON positions.position_id = votes.position_id LEFT JOIN partylists ON partylists.partylist_id = candidates.partylist_id WHERE votes.student_id = :s ORDER BY votes.voted_at";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':s', $id, PDO::PARAM_INT);
                $stmt->execute();
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($row) {
                    foreach ($row as $res):
            ?>
            <div class="voted-item">
                <p><strong>Position:</strong> <?php echo htmlspecialchars($res['position_name']); ?></p>
                <p><strong>Candidate:</strong> <?php echo htmlspecialchars($res['candidate_name']); ?></p>
                <?php if ($res['partylist_name']) { ?>
                <p><strong>Partylist:</strong> <?php echo htmlspecialchars($res['partylist_name']); ?></p>
                <?php } ?>
                <p><strong>Department:</strong> <?php echo htmlspecialchars($res['department_name']); ?></p>
                <p><strong>Voted At:</strong> <?php echo htmlspecialchars($res['voted_at']); ?></p>
                <hr>
            </div>
            <?php
                    endforeach;
                } else {
                    echo "<p>No voting record found.</p>";
                }
            endif;
            ?>
        </div>
    </section>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Your Vote</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalBody">
                    <div id="selectedCandidatesContainer"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-arrow-left"></i> Go Back</button>
                    <button type="button" class="btn btn-primary" id="confirmVote">Confirm Vote</button>
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

    <script>
  const selectedCandidates = {};

function selectCard(positionName, candidateId) {
    const normalizedPositionName = positionName.replace(/\s+/g, '_');

   
    if (selectedCandidates[normalizedPositionName] === candidateId) {
       
        $(`#${normalizedPositionName}-candidate${candidateId}`).removeClass('selected');
        delete selectedCandidates[normalizedPositionName]; // Remove from the selected candidates
    } else {
       
        if (selectedCandidates[normalizedPositionName]) {
            $(`#${normalizedPositionName}-candidate${selectedCandidates[normalizedPositionName]}`).removeClass('selected');
        }

     
        $(`#${normalizedPositionName}-candidate${candidateId}`).addClass('selected');
        selectedCandidates[normalizedPositionName] = candidateId;
    }
}

    // Fetch voting data when the page loads
    $(document).ready(function() {
        fetchVotingData();
    });

    function fetchVotingData() {
        $.ajax({
            url: 'fetch_voting_data.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                response.positions.forEach(position => {
                    const normalizedPositionName = position.position_name.replace(/\s+/g, '_');

                    const positionContainer = `
                        <div class="row mb-2 mb-xl-3">
                            <div class="col-auto d-none d-sm-block">
                                <h4><i class="fas fa-user-tie"></i> <strong>Vote for</strong> ${position.position_name}</h4>
                            </div>
                        </div>
                        <div class="row" id="position-${normalizedPositionName}"></div>`;
                    $('#positions-container').append(positionContainer);

                    position.candidates.forEach(candidate => {
                        console.log(`Candidate Data:`, candidate); // Log candidate data

                        const candidateCard = `
                            <div class="col-md-4">
                                <div class="card vote-card" 
                                     data-position-id="${position.position_id}" 
                                      data-partylist-id="${candidate.partylist_id || 'None'}" 
                                     id="${normalizedPositionName}-candidate${candidate.candidate_id}">
                                    <img src="${candidate.candidate_image_path}" alt="${candidate.name || 'Candidate Image'}" 
                                    onerror="this.src='https://via.placeholder.com/90';">

                                    <div class="card-body">
                                        <h5 class="card-title">${candidate.candidate_name}</h5>
                                        <p class="card-department">${candidate.department_name}</p>
                                        <p class="card-partylist">${candidate.partylist_name}</p>
                                        <span class="badge-selected">Selected</span>
                                    </div>
                                </div>
                            </div>`;
                        $(`#position-${normalizedPositionName}`).append(candidateCard);

                        // Attach click event to select candidate
                        $(`#${normalizedPositionName}-candidate${candidate.candidate_id}`)
                            .on('click', function() {
                                selectCard(position.position_name, candidate
                                    .candidate_id);
                            });
                    });
                });
            },
            error: function(err) {
                console.error('Error fetching voting data:', err);
                alert('Failed to load voting data. Please try again later.');
            }
        });
    }

    // Show confirmation modal
    $('#submitVote').on('click', function() {
        if (Object.keys(selectedCandidates).length === 0) {
            alert('Please select at least One candidate before submitting your vote.');
            return;
        }
        populateConfirmationModal();
        $('#confirmationModal').modal('show');
    });

    // Populate modal with selected candidates
    function populateConfirmationModal() {
        const selectedCandidatesContainer = $('#selectedCandidatesContainer');
        selectedCandidatesContainer.empty();

        Object.keys(selectedCandidates).forEach(positionName => {
            const candidateId = selectedCandidates[positionName];
            const candidateCard = $(`#${positionName}-candidate${candidateId}`);
            const candidateName = candidateCard.find('.card-title').text();
            const department = candidateCard.find('.card-department').text();
            const partyList = candidateCard.find('.card-partylist').text();
            const candidateImage = candidateCard.find('img').attr('src');

            const modalEntry = `
                <div class="row mb-3">
                    <div class="col-auto">
                        <img src="${candidateImage}" class="img-thumbnail" width="60" alt="https://via.placeholder.com/90">
                    </div>
                    <div class="col">
                        <h5 class="mb-0">${candidateName}</h5>
                        <p class="mb-0 text-muted">${department}</p>
                        <p class="mb-0 text-muted">${partyList}</p>
                        <small class="text-muted">Position: ${positionName.replace('_', ' ')}</small>
                    </div>
                </div>`;

            selectedCandidatesContainer.append(modalEntry);
        });
    }

    // Client-side confirmation of vote submission
    $('#confirmVote').on('click', function() {
        const votes = Object.keys(selectedCandidates).map(positionName => {
            const candidateId = selectedCandidates[positionName];
            const candidateCard = $(`#${positionName}-candidate${candidateId}`);

            // Check if the candidateCard exists
            if (!candidateCard.length) {
                console.error(
                    `Candidate card for ${positionName} and candidate ID ${candidateId} does not exist.`
                );
                return null; // Skip if the card does not exist
            }

            const partylistId = candidateCard.data('partylist-id'); // Retrieve partylist ID
            const positionId = candidateCard.data('position-id'); // Get the correct position_id

            // Log values to help debug undefined partylist_id
            console.log(
                `Position: ${positionName}, Candidate ID: ${candidateId}, Partylist ID: ${partylistId}, Position ID: ${positionId}`
            );

            // Validate the partylistId and positionId
            if (!partylistId || !positionId) {
                alert("Error: Partylist ID or Position ID is missing.");
                return null; // Stop execution if IDs are invalid
            }

            return {
                position_id: positionId,
                candidate_id: candidateId,
                partylist_id: partylistId
            };
        }).filter(vote => vote !== null); // Filter out any null values

        if (votes.length === 0) {
            alert("Error: No valid votes found.");
            return; // Stop submission if no valid votes
        }

        $.ajax({
            url: 'submit_vote.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({
                student_id: '<?php echo $_SESSION['student_id']; ?>',
                votes: votes
            }),
            success: function(response) {
                const result = JSON.parse(response);
                alert(result.message);
                if (result.status === 'success') {
                    window.location.href = 'thanks.php';
                    //window.location.reload(); // Reload page after successful vote
                }
            },
            error: function(err) {
                console.error('Error submitting vote:', err);
                alert('An error occurred while submitting your vote. Please try again.');
            }
        });
    });
    </script>

</body>

</html>