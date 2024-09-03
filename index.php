<?php

include_once 'config/init.php';

    if (!$login->isLoggedIn()) {
        header('Location: login.php' );

    } else {

        $user = new User();
        $userDetail = $user->getUserDetails();

        if(!empty($userDetail['birthdate'])){

            $birthyear = date('Y', strtotime($userDetail['birthdate']));
            $birthmonth = date('n', strtotime($userDetail['birthdate']));
            $birthday = date('j', strtotime($userDetail['birthdate']));
        } else {
            $birthmonth = 0;
            $birthyear = 0;
            $birthday = 0;
        }

    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home | <?= APP_NAME ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
    <!--    Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"/>

    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" type="text/css">
    <script>
        let id = <?= htmlentities($userDetail['user_id']) ?>;
    </script>
</head>
<body>


<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
  <a class="navbar-brand" href="#"><?= APP_NAME ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="messages.php"><i class="fas fa-chat"></i> Messages <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
  </div>
</nav>


        <div class="container">
            <div class="jumbotron m-4">
                <img src="<?= htmlspecialchars($userDetail['avatar']) ?>" class="img-thumbnail" width="150px" height="150px">
                <h3>Hello <?= htmlspecialchars($userDetail['username']) ?> &nbsp;<span id="status"></span></h3>

                <a href="logout.php">Logout</a>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <h3>Change Email</h3>
                    <form>
                        <div class="mb-3">
                            <label for="email-input">Email Address</label>
                            <input type="email" class="form-control" value="<?= !empty($userDetail['email']) ? htmlentities($userDetail['email']) : '' ?>" id="email-input">
                        </div>
                        <div class="mb-3">
                            <button type="button" id="changeEmailBtn" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>

                    <h3>Change Profile</h3>
                    <form enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="profile_image">Profile Image</label>
                            <input type="file" class="form-control" id="avatar">
                        </div>
                        <div class="mb-3">
                            <label for="firstname-input">First Name</label>
                            <input type="text" class="form-control" value="<?= !empty($userDetail['first_name']) ? htmlentities($userDetail['first_name']) : '' ?>" id="firstname-input">
                        </div>

                        <div class="mb-3">
                            <label for="lastname-input">Last Name</label>
                            <input type="text" class="form-control" value="<?= !empty($userDetail['last_name']) ? htmlentities($userDetail['last_name']) : '' ?>" id="lastname-input">
                        </div>

                        <label for="birthday">Birthdate</label>
                        <div class="row">
                        <div class="mb-3 col-md-4">
                            <select name="birth_month" id="birth_month" class="form-control">
                                <?php for( $m=1; $m<=12; ++$m ): $month_label = date('F', mktime(0, 0, 0, $m, 1)); $current = date('n');?>
                                    <option value="<?= $m; ?>"<?= $birthmonth == $m ? ' selected' : ''?>><?php echo $month_label; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="mb-3 col-md-2">
                            <select name="birth_day" id="birth_day" class="form-control">
                                <?php
                                for( $j=1; $j<=31; $j++ ): ?>
                                    <option value="<?= $j; ?>"<?= $birthday == $j ? ' selected' : ''?>><?= $j; ?></option>
                                <?php endfor;?>
                            </select>
                        </div>
                        <div class="mb-3 col-md-4">
                            <select name="birth_year" id="birth_year" class="form-control">
                                <?php $year = date("Y"); $min = $year - 60;$max = $year;for( $i=$max; $i>=$min; $i-- ):?>
                                    <option value="<?= $i; ?>"<?= $birthyear == $i ? ' selected' : ''?>><?= $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        </div>
                        <div class="mb-3">
                            <button type="button" id="changeProfileBtn" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>


                </div>
                <div class="col-md-6">
                    <h3>Change Password</h3>
                    <form>
                        <div class="mb-3">
                            <label for="old_password">Old Password</label>
                            <input type="password" class="form-control" value="" id="old_password">
                        </div>
                        <div class="mb-3">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control" value="" id="new_password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control" value="" id="confirm_password">
                        </div>
                        <div class="mb-3">
                            <button type="button" id="changePasswordBtn" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>

                    <h3>Advanced Security</h3>
                    <form>

                    <?php if($userDetail['tfa_enabled'] == 0): ?>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#validatePass">
                                Use two-factor authentication
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="mb-3">
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#disable2fa">
                                Disable two-factor authentication
                            </button>
                        </div>
                    <?php endif; ?>



                    <h3>Recent Logins</h3>
                    
                    <div class="table-responsive">
                        <table class="table" id="recent_login_table">
                        <thead>
                            <tr>
                            <th scope="col">User Agent</th>
                            <th scope="col">IP Address</th>
                            <th scope="col">Last Online</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM login_sessions WHERE user_id = :uid";
                                $user_id = $userDetail['user_id'];
                                $stmt = $db->prepare($sql);
                                $stmt->bindParam(":uid", $user_id);
                                $stmt->execute();
                                
                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)):  
                            ?>
                            <tr>
                            <td><?= $row['user_agent'] ?></td>
                            <td><?= $row['ip_address'] ?></td>
                            <td><?= $row['datetime'] ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                        </table>
                        </div>

                
                       
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="validatePass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Set up two-factor authentication</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body m-3">
													<p class="mb-0">To continue, please enter your password for verification.</p>
                                       <div class="form-group">
                                                <input type="password" id="2fapasswordverify" class="form-control" placeholder="Enter your Password">
                                             </div>
												</div>
												<div class="modal-footer">
													<button type="button" id="verifyPassBtn" data-bs-dismiss="modal" class="btn btn-primary">Confirm</button>
												</div>
											</div>
										</div>
									</div>


                                    <div class="modal fade" id="disable2fa" tabindex="-1" role="dialog" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                    <div class="modal-header">
                                       <h5 class="modal-title">Disable two-factor authentication</h5>
                                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body m-3">
                                       <p class="mb-0">To continue, please enter your password for verification.</p>
                                       <div class="form-group">
                                                <input type="password" id="2fadisablepassword" class="form-control" placeholder="Enter your Password">
                                             </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" id="disable2faBtn" data-bs-dismiss="modal" class="btn btn-danger">Turn off</button>
                                    </div>
                                 </div>
                              </div>
                           </div>


                           <div class="modal fade" id="tfaSetup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title">Set up two-factor authentication</h5>
													<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
												</div>
												<div class="modal-body m-3">
                                    <p class="mb-3">Now, Let's get started.</p>
                                          <div class="d-flex justify-content-sm-center">		
                                       <div class="mb-3 border border-1">
                                        <img src="" id="tfaQRCode"/>
                                       </div>
                                       </div>

                                      <p id="secretKey" class="fs-4 fw-bold text-center text-uppercase border border-secondary"></p>                
                                    <input type="hidden" id="secret_key">

                                       <div class="form-floating">
                                          <input type="number" class="form-control" name="6digitcode" id="6digitcode" placeholder="6 Digit Verification Code">
                                          <label for="6digitcode">6 Digit Verification Code</label>
                                             </div>
												</div>
												<div class="modal-footer">
													<button type="button" id="confirmSetup" class="btn btn-primary">Confirm</button>
												</div>
											</div>
										</div>
									</div>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" type="text/javascript"></script>
    <script src="assets/js/sha512.min.js"></script>
    <script src="assets/js/index.js"></script>
    <script src="assets/js/register.js"></script>
    <script src="assets/js/tfa-auth.js"></script>
    <script>
        const dataTable = new simpleDatatables.DataTable("#recent_login_table", {
            searchable: false,
            fixedColumns: true,
            perPage: 3  

        });
    </script>
</body>
</html>