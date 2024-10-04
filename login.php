<?php

include_once "config/init.php";

if (isset($_GET["ref"])) {
    Session::unsetSession("tfaChallenge");
    Session::unsetSession("uid");
}

if (isset($_GET["ref_"])) {
    Cookie::clear("remember_me");
    Cookie::clear("uid");
}

if ($login->isLoggedIn()) {
    header("Location: admin/index.php");
    die();
}

if ($login->isTfaLoggedIn()) {
    header("Location: challenge.php");
}

if ($login->isRememberSet()) {
    $user = new User();
    $user_id = Cookie::get("uid");
    $uid = Others::decryptData($user_id, ENCRYPTION_KEY);
    $row = $user->getUserData($uid);

    if(empty($row)){
        Cookie::clear("remember_me");
        Cookie::clear("uid");
    }
}
?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>Login | <?= APP_NAME ?></title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/my-login.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.css">
            <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-9/assets/css/login-9.css">
            <!--    Font Awesome -->
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/fontawesome.css"/>

            <style>
                @font-face {
                    font-family: 'Poppins';
                    src: url('admin/fonts/Poppins-Regular.ttf')
                        format('truetype'); 
                    font-weight: normal;
                    font-style: normal;
                    
                }
                
                body.my-login-page{
                    font-family: 'Poppins', sans-serif;
                   
                }
                .card-wrapper {
                        max-width: 400px;
                        margin: 0;
                }
            </style>

            
        </head>
        
            <body class="my-login-page">
            <section class="custom-bg py-3 py-md-5 py-xl-8">
            <div class="container">
            <div class="row gy-4 align-items-center">
            <div class="col-12 col-md-6 col-xl-7">
                <div class="d-flex justify-content-center" style="background-color: #1A1A1A; color: #FE8040;">
                <div class="col-12 col-xl-9">
                <img class="img-fluid rounded mb-4" loading="lazy" src="./assets/images/logo/E-vote.jpg" width="245" height="80" alt="BootstrapBrain Logo">
                <hr class="border-primary-subtle mb-4">
                <h2 class="h1 mb-4">Welcome to eVote~.</h2>
                    <p class="lead mb-5">Zero cost for student who are unable to buy an data inside the campus.</p>
                    <div class="text-endx">
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-grip-horizontal" viewBox="0 0 16 16">
                        <path d="M2 8a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm3 3a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm0-3a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                    </svg>
                    </div>
                </div>
                </div>
            </div>
                        <?php if (!$login->isRememberSet()): ?>
                            
                            <div class="col-12 col-md-6 col-xl-5">
                 <div class="card border-0 rounded-4">
             <div class="card-body p-3 p-md-4 p-xl-5">
              <div class="row">
               <div class="col-12">
                 <div class="mb-4">

                        <?php else: ?>
                            <h4 class="card-title">Login as <?= htmlentities(
                                $row["username"]
                            ) ?></h4>
                        <?php endif; ?>
                        <form method="POST" id="login_form" >
                            <input type="hidden" name="token" id="token" value="<?= htmlentities(
                                CSRF::generate("login_form")
                            ) ?>">

                            <?php if (!$login->isRememberSet()): ?>
                                <form action="#!">
                            <div class="row gy-3 overflow-hidden">
                <div class="col-12">
                  <div class="form-floating mb-3">

                         <input type="username" class="form-control" name="username" id="username" placeholder="abdul" required>
                    <label for="username" class="form-label">username</label>
                  </div>
                </div>
                                
                            <?php else: ?>
                                <input id="username" type="hidden" class="form-control" name="username" value="<?= $row[
                                    "username"
                                ] ?>" autofocus>
                            <?php endif; ?>
                              
                          
                          
                            <div class="col-12">
                            <div class="form-floating mb-3">
                                        
                            <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required data-eye>
                            
                            <label for="password" class="form-label">Password</label>
                            <div class="form-group">
                                <label for="password">
                                    <a href="#" data-toggle="modal" data-target="#forgotPasswordModal" class="float-right">
                                        Forgot Password?
                                    </a>
                       
                        </div>
                    </div>
                            </div>
                                 
                                
                            <?php if (!$login->isRememberSet()): ?>
                             <div class="col-12">
                  <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" name="remember_me" id="remember_me">
                    <label class="form-check-label text-secondary" for="remember_me">
                      Keep me logged in
                    </label>
                  </div>
                </div>
                            <?php endif; ?>
                            <div class="col-12">
                            <div class="d-grid">
                                <button type="submit" id="login_button" class="btn btn-primary btn-block">
                                     Log in
                                </button>
                                </div>
                </div>
              </div>
            </form>
                            <div class="mt-4 text-center">
                            <?php if (!$login->isRememberSet()): ?>
                                Don't have an account? <a href="register.php">Create One</a>
                                <?php else: ?>
                                    Not your account? <a href="login.php?ref_">Log in</a>
                                <?php endif; ?>

                <div class="footer">
                    Copyright &copy; <?= date("Y") ?> &mdash; <?= APP_NAME ?>
                </div>
            </div>
        </div>
    </div>
</section>


        <!-- Forgot Password Modal -->
        <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Forgot my Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <p class="mb-1">To continue, please enter your username for recovery.</p>
                        <div class="form-group">
                            <label for="forgotPasswordusername">username</label>
                            <input type="username" id="forgotPasswordusername" class="form-control" placeholder="Enter your username">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="forgotPasswordBtn" data-bs-dismiss="modal" class="btn btn-primary">Reset Password</button>
                    </div>
                </div>
            </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/sha512.min.js"></script>
<script src="assets/js/login.js"></script>

</body>
</html>
