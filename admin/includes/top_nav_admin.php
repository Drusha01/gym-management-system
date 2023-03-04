
<header class="navbar navbar-expand-md navbar-dark sticky-top background-color-green-visible shadow-sm py-0">
        <div class="container-fluid p-0 pe-3 pe-md-0">
        <a class="navbar-brand col-md-3 col-lg-3 col-xl-2 me-0 px-3 py-3 background-color-green" href="#">
            <img class="logo-icon" src="../../images/logo.png" alt="">
            <div class="d-flex flex-column p-2 pt-0 pb-0">
                <h3 class="mb-1 fs-5 text-white"><strong>KE-NO</strong></h3>
                <h6 class="mb-1 fs-10 text-white">Fitness Center</h6>
            </div>
        </a>
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse"></div>
        <ul class="nav navbar-nav navbar-right d-none d-lg-block pe-3">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class='bx bx-bell fs-1 text-dark'></i> <span class="position-absolute top-75 start-100 translate-middle badge rounded-pill bg-danger">+99 <span class="visually-hidden">unread messages</span></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" style="width:300px;">
                    <li>
                    <a href="#" class="text-decoration-none text-dark dropdown-item">
                        <div class="fw-normal">You have <b>3 new themes</b> trending</div>
                        <div class="fw-light">15 minutes ago</div>
                    </a>
                    </li>
                    <li>
                    <a href="#" class="text-decoration-none text-dark dropdown-item">
                        <div class="fw-normal">You have <b>3 new themes</b> trending</div>
                        <div class="fw-light">15 minutes ago</div>
                    </a>
                    </li>
                    <li>
                    <a href="#" class="text-decoration-none text-dark dropdown-item">
                        <div class="fw-normal">You have <b>3 new themes</b> trending</div>
                        <div class="fw-light">15 minutes ago</div>
                    </a>
                    </li>
                    <div class="dropdown-divider"></div>
                    <li><a class="dropdown-item text-center" href="../notification/notification.php" style="text-indent: 1%;">Show More</a></li>
                </ul>
            </li>
        </ul>
        <div class="dropdown text-end me-3 d-none d-md-block">
            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../../img/profile-thumbnail/<?php echo $_SESSION['admin_user_profile_picture'];?>" alt="mdo" width="32" height="32" class="rounded-circle">
            </a>
            <ul class="dropdown-menu text-small dropdown-user">
                <li><a class="dropdown-item" href="../profile/profile.php">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="../log-out.php">Sign out</a></li>
            </ul>
        </div>
        
    </div>
</header>