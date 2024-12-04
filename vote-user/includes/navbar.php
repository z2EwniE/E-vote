<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <a class="text-muted"><strong>E-Vote</strong></a>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="platforms.php">Platforms</a>
            </li>
            <?php if(!isCandidate()): ?>
                <li class="nav-item">
                <a class="nav-link" href="apply-candidacy.php">Apply for Candidacy</a>
            </li>           
            <?php endif; ?>
            <li class="nav-item dropdown">
                <?php if (isset($_SESSION['student_id'])): ?>
                <a class="nav-link dropdown-toggle text-muted" href="#" id="studentDropdown" role="button"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>ID: <?php echo $_SESSION['student_id']; ?></strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="studentDropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>

                <?php endif; ?>
            </li>

        </ul>
    </div>

    <!-- Optional Dark Mode Toggle -->
    <!--
    <button id="toggleDarkMode" class="btn btn-dark toggle-dark-mode ms-auto mt-3">
        <i class="fas fa-moon"></i>
    </button>
    -->

</nav>