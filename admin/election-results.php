<?php
include_once __DIR__ . "/../config/init.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Election Results - E-Vote System</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="css/light.css" rel="stylesheet">
    
    <style>
        @media print {
            .no-print {
                display: none !important;
            }
            .print-only {
                display: block !important;
            }
            body {
                padding: 0;
                margin: 0;
            }
            .main {
                margin: 0 !important;
                padding: 0 !important;
            }
            .content {
                padding: 0 !important;
            }
        }

        .print-only {
            display: none;
        }

        .result-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }

        .result-table th,
        .result-table td {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
            text-align: left;
        }

        .result-table th {
            background-color: #f8f9fa;
        }

        .signature-section {
            margin-top: 3rem;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1rem;
        }

        .signature-box {
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #000;
            margin-top: 2rem;
            margin-bottom: 0.5rem;
        }

        .editable {
            border: none;
            background: transparent;
            width: 100%;
            text-align: inherit;
        }

        .editable:focus {
            outline: 1px solid #007bff;
            background: #fff;
        }
    </style>
</head>

<body data-theme="default" data-layout="fluid" data-sidebar-position="left" data-sidebar-layout="default">
    <div class="wrapper">
        <?php include_once 'includes/sidebar.php'; ?>

        <div class="main">
            <?php include_once 'includes/navbar.php'; ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="mb-3 no-print">
                        <h1 class="h3 d-inline align-middle">Election Results</h1>
                        <button onclick="window.print()" class="btn btn-primary float-end">
                            <i class="fas fa-print"></i> Print Results
                        </button>

                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="../assets/images/logo/ispsc_logo_small.png" alt="ISPSC Logo" height="60" class="mb-2S">
                                <h4>ILOCOS SUR POLYTECHNIC STATE COLLEGE</h4>
                                <h5>TAGUDIN CAMPUS, TAGUDIN, ILOCOS SUR</h5>
                                <h2 class="mt-4">ELECTION RESULT</h2>
                                <h5 class="mt-3">SSC <?php echo date('Y'); ?></h5>
                            </div>

                            <table class="result-table" id="resultTable">
                                <thead>
                                    <tr>
                                        <th>Position</th>
                                        <th>Candidate</th>
                                        <th>Votes</th>
                                        <th>Rank</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Update the SQL query section
                                    $sql = "SELECT 
                                            p.position_name,
                                            p.position_id,
                                            CONCAT(COALESCE(s.first_name, ''), ' ', COALESCE(s.middle_name, ''), ' ', COALESCE(s.last_name, '')) AS candidate_name,
                                            c.candidate_id,
                                            pl.partylist_name,
                                            COUNT(v.vote_id) as vote_count,
                                            CASE 
                                                WHEN c.candidate_id IS NOT NULL THEN
                                                    DENSE_RANK() OVER (PARTITION BY p.position_id ORDER BY COUNT(v.vote_id) DESC)
                                                ELSE NULL 
                                            END as candidate_rank
                                        FROM positions p
                                        LEFT JOIN candidates c ON p.position_id = c.candidate_position
                                        LEFT JOIN students s ON c.student_id = s.id
                                        LEFT JOIN partylists pl ON c.partylist_id = pl.partylist_id
                                        LEFT JOIN votes v ON c.candidate_id = v.candidate_id
                                        GROUP BY 
                                            p.position_id, 
                                            p.position_name, 
                                            c.candidate_id,
                                            s.first_name,
                                            s.middle_name,
                                            s.last_name,
                                            pl.partylist_name
                                        ORDER BY p.position_id, candidate_rank";

                                    // Debug the results
                                    try {
                                        $stmt = $db->prepare($sql);
                                        $stmt->execute();
                                        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                        
                                        // Add debug output
                                        if (empty($results)) {
                                            echo "<!-- No results found -->";
                                        } else {
                                            echo "<!-- Found " . count($results) . " results -->";
                                        }
                                    } catch (PDOException $e) {
                                        echo "<!-- Query error: " . $e->getMessage() . " -->";
                                    }

                                    // Update the table display section to handle null values
                                    foreach ($results as $row):
                                    ?>
                                    <tr>
                                        <td><input type="text" class="editable" value="<?= htmlspecialchars($row['position_name'] ?? '') ?>" readonly></td>
                                        <td>
                                            <?php if (!empty($row['candidate_name'])): ?>
                                                <input type="text" class="editable" value="<?= htmlspecialchars(trim($row['candidate_name'])) ?>" readonly>
                                                <?php if (!empty($row['partylist_name'])): ?>
                                                    <div class="small text-muted"><?= htmlspecialchars($row['partylist_name']) ?></div>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <span class="text-muted">No candidate</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><input type="number" class="editable" value="<?= $row['vote_count'] ?? 0 ?>" readonly></td>
                                        <td><input type="number" class="editable" value="<?= $row['candidate_rank'] ?? '' ?>" readonly></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <div class="signature-section mt-5">
                                <div class="signature-box">
                                    <p>Approved by:</p>
                                    <div class="signature-line"></div>
                                    <input type="text" class="editable text-center" value="Dennis T. Millare" style="font-weight: bold">
                                    <input type="text" class="editable text-center" value="SSC Adviser">
                                </div>
                                <div class="signature-box">
                                    <p>Approved by:</p>
                                    <div class="signature-line"></div>
                                    <input type="text" class="editable text-center" value="MARY ROSE S. ABANIZ" style="font-weight: bold">
                                    <input type="text" class="editable text-center" value="OSA Coordinator">
                                </div>
                                <div class="signature-box">
                                    <p>Prepared by:</p>
                                    <div class="signature-line"></div>
                                    <input type="text" class="editable text-center" value="Dr. GEORGE R. VILLANEUVA, JR." style="font-weight: bold">
                                    <input type="text" class="editable text-center" value="Technical Working Group">
                                </div>
                                <div class="signature-box">
                                    <p>Extracted by:</p>
                                    <div class="signature-line"></div>
                                    <input type="text" class="editable text-center" value="JIM_MAR F. DE LOS REYES" style="font-weight: bold">
                                    <input type="text" class="editable text-center" value="Technical Working Group">
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <div class="signature-box" style="max-width: 300px; margin: 0 auto;">
                                    <p>Noted by:</p>
                                    <div class="signature-line"></div>
                                    <input type="text" class="editable text-center" value="EDERLINA M. SUMAIL" style="font-weight: bold">
                                    <input type="text" class="editable text-center" value="CAMPUS ADMINISTRATOR">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <script src="js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    
    <script>
    function saveChanges() {
        // Collect all the signature data instead of table data since it's readonly
        const signatures = {
            ssc_advisor: {
                name: document.querySelector('.signature-box:nth-child(1) input[type="text"]:nth-child(3)').value,
                position: document.querySelector('.signature-box:nth-child(1) input[type="text"]:nth-child(4)').value
            },
            dsa_coordinator: {
                name: document.querySelector('.signature-box:nth-child(2) input[type="text"]:nth-child(3)').value,
                position: document.querySelector('.signature-box:nth-child(2) input[type="text"]:nth-child(4)').value
            },
            technical_group: {
                name: document.querySelector('.signature-box:nth-child(3) input[type="text"]:nth-child(3)').value,
                position: document.querySelector('.signature-box:nth-child(3) input[type="text"]:nth-child(4)').value
            },
            extractor: {
                name: document.querySelector('.signature-box:nth-child(4) input[type="text"]:nth-child(3)').value,
                position: document.querySelector('.signature-box:nth-child(4) input[type="text"]:nth-child(4)').value
            },
            administrator: {
                name: document.querySelector('.signature-box:last-child input[type="text"]:nth-child(3)').value,
                position: document.querySelector('.signature-box:last-child input[type="text"]:nth-child(4)').value
            }
        };

        // Send the signature data to the server
        fetch('process/update-election-results.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ signatures: signatures })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Signatures saved successfully!');
            } else {
                alert('Error saving signatures: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error saving signatures. Please try again.');
        });
    }
    </script>
</body>
</html> 