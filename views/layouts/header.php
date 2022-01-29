<?php
$year = '';
$username = '';
$jobs = '';
$avatar = '';
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']['username'];
    // $avatar = $_SESSION['user']['avatar'];
    $year = date('Y', strtotime($_SESSION['user']['created_at']));
}

?>
<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
    <div class="me-3">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
    </div>
    <div>
      <a class="navbar-brand brand-logo" href="http://localhost/thuvien/index.php?controller=danhmucsach&action=index">
        <img src="assets/images/logo.svg" alt="logo" />
      </a>
      <a class="navbar-brand brand-logo-mini" href="http://localhost/thuvien/index.php?controller=danhmucsach&action=index">
        <img src="assets/images/logo-mini.svg" alt="logo" />
      </a>
    </div>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-top"> 
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
        <h1 class="welcome-text">Good Morning, <span class="text-black fw-bold"><?php echo $_SESSION['user']['username']?></span></h1>
        <!-- <h3 class="welcome-sub-text">Your performance summary this week </h3> -->
      </li>
    </ul>
    <ul class="navbar-nav ms-auto">
      <li class="nav-item dropdown d-none d-lg-block user-dropdown">
        <a class="nav-link btn btn-light" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
          <!-- <img class="img-xs rounded-circle" src="images/faces/face8.jpg" alt="Profile image"> </a> -->
          <?php echo $_SESSION['user']['username']?>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <!-- <img class="img-md rounded-circle" src="/assets/images/faces/face8.jpg" alt="Profile image"> -->
            <p class="mb-1 mt-3 font-weight-semibold"><?php echo $_SESSION['user']['username']?></p>
            <p class="fw-light text-muted mb-0"><?php echo $_SESSION['user']['username']?></p>
          </div>
          <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile </a>
          <a class="dropdown-item" href="index.php?controller=user&action=logout"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>

