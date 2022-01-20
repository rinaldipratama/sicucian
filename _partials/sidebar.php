<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="assets/img/user-no-image-gray.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?=$_SESSION['nama_user'];?></p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <?php if ($_SESSION['level'] === 'Administrator') { ?>
      <li class="<?='' ? 'active': '' ?>"><a href="dashboard.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="<?='' ? 'active': '' ?>"><a href="paket.php"><i class="fa fa-car"></i> <span>Paket</span></a></li>
      <li class="<?='' ? 'active': '' ?>"><a href="pelanggan.php"><i class="fa fa-user"></i> <span>Pelanggan</span></a></li>
      <li class="<?='' ? 'active': '' ?>"><a href="transaksi.php"><i class="fa fa-shopping-cart"></i> <span>Transaksi Cucian</span></a></li>
      <li class="<?='' ? 'active': '' ?>"><a href="laporan.php"><i class="fa fa-file"></i> <span>Laporan</span></a></li>
      <li class="treeview <?='' ? 'active': '' ?>">
        <a href="#">
          <i class="fa fa-cog"></i>
          <span>Pengaturan</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li class="<?='' ? 'active': '' ?>"><a href="user.php"><i class="fa fa-users"></i>Manajemen User</a></li>
        </ul>
      </li>
      <?php } elseif ($_SESSION['level'] === 'Kasir') { ?>
        <li class="<?='' ? 'active': '' ?>"><a href="home.php"><i class="fa fa-home"></i> <span>Home</span></a></li>
      <li class="<?='' ? 'active': '' ?>"><a href="pelanggan.php"><i class="fa fa-user"></i> <span>Pelanggan</span></a></li>
      <li class="<?='' ? 'active': '' ?>"><a href="transaksi.php"><i class="fa fa-car"></i> <span>Transaksi Cucian</span></a></li>
      <li class="<?='' ? 'active': '' ?>"><a href="laporan.php"><i class="fa fa-file"></i> <span>Laporan</span></a></li>
      <?php } ?>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>