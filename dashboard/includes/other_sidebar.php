<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.php"> <img alt="image" src="assets/img/logo.png" class="header-logo" /> <span class="logo-name">Otika</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <!-- <li class="menu-header">Main</li> -->
            <li class="dropdown active">
                <a href="index.php" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown">
                <a href="index_blood_detail.php" class="nav-link"><i data-feather="briefcase"></i><span class="text-capitalize">view blood detail</span></a>
            </li>
            <?php if (isset($_SESSION['user']['role']) && ($_SESSION['user']['role'] == 1)) { ?>
                <li class="dropdown">
                    <a href="./donar/index_donar.php" class="nav-link"><i data-feather="briefcase"></i><span class="text-capitalize">View donar</span></a>
                </li>
                <li class="dropdown">
                    <a href="./donar/index_receiver.php" class="nav-link"><i data-feather="briefcase"></i><span class="text-capitalize">view receiver</span></a>
                </li>
            <?php } elseif (isset($_SESSION['user']['role']) && ($_SESSION['user']['role'] == 2)) { ?>
                <li class="dropdown">
                    <a href="./receiver/index_receiver.php" class="nav-link"><i data-feather="briefcase"></i><span class="text-capitalize">view receiver</span></a>
                </li>
            <?php } ?>
        </ul>
    </aside>
</div>