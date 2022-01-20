<header class="main-header">
    <!-- Logo -->
    <a href="./" class="logo alert-primary">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SI</b>C</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SI </b>Cucian</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top alert-primary">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle alert-primary" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="assets/img/user-no-image-gray.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$_SESSION['nama_user'];?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header alert-primary">
                <img src="assets/img/user-no-image-gray.png" class="img-circle" alt="User Image">

                <p>
                  <?=$_SESSION['nama_user'];?>
                  <small>Member since <?=date('M. Y', strtotime($_SESSION['created_at']));?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="profile.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Log Out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>