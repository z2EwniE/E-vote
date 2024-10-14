

<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <a class="text-muted"><strong>E-Vote</strong></a>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <!-- Display the username if it's set in the session -->
                <?php if (isset($_SESSION['student_id'])): ?>
                    <a class="text-muted"><strong>ID: <?php echo $_SESSION['student_id']; ?></strong></a>
                <?php else: ?>
                    <a class="text-muted"><strong>Name: Guest</strong></a>
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
