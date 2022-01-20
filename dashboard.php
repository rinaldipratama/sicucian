<?php
    //cek session
    session_start();

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } elseif ($_SESSION['level'] === 'Kasir') {
      header("Location: ./home.php");
    } else {
?>

<!DOCTYPE html>
<html lang="en">

<?php include('_partials/head.php'); ?>

<body class="hold-transition skin-blue sidebar-mini">

  <div class="wrapper">

    <?php include('_partials/navbar.php'); ?>

    <?php include('_partials/sidebar.php'); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Dashboard
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-dashboard active"></i> Dashboard</li>
          </ol>
      </section>

      <?php 
      require_once 'config/config.php';

      $query = mysqli_query($db, "SELECT * FROM tb_user");
      $pengguna = $query->num_rows;

      $query2 = mysqli_query($db, "SELECT * FROM tb_pelanggan");
      $pelanggan = $query2->num_rows;

      $query3 = mysqli_query($db, "SELECT * FROM tb_transaksi");
      $transaksi = $query3->num_rows;

      $query4 = mysqli_query($db, "SELECT SUM(harga_paket) AS harga_paket FROM view_transaksi_detail");
      $total = mysqli_fetch_array($query4);

      ?>

      <!-- Main content -->
      <section class="content">
        <div class="callout callout-info">
          <h4>Hello <?=$_SESSION['nama_user'] . "!";?></h4>
            Anda login sebagai <?=$_SESSION['level'];?>.
        </div>
        <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-person"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pengguna</span>
              <span class="info-box-number"><?=$pengguna;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Pelanggan</span>
              <span class="info-box-number"><?=$pelanggan;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Transaksi Cucian</span>
              <span class="info-box-number"><?=$transaksi;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-money"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Penghasilan</span>
              <span class="info-box-number"><?='Rp ' . number_format($total['harga_paket'], 0, ",", ".");?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      </section>

      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include('_partials/footer.php'); ?>
    
  </div>
  <!-- ./wrapper -->

  <?php include('_partials/modal.php'); ?>

  <?php include('_partials/js.php'); ?>

</body>

</html>

<?php
}
?>