<?php
    //cek session
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
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
              Laporan
              <small>
              </small>
          </h1>
      </section>

      <!-- Main content -->
      <section class="content">
        
        <div class="row">
          <!-- left column -->
          <div class="col-xs-12">
            <!-- general form elements -->
            <div class="box box-default">

              <?php

                if (isset($_POST['tampil'])) {
                  $tanggal1 = filter_input(INPUT_POST, 'tanggal1', FILTER_SANITIZE_STRING);
                  $tanggal2 = filter_input(INPUT_POST, 'tanggal2', FILTER_SANITIZE_STRING);

                  $sql = mysqli_query($db, "SELECT t2.*, t1.* FROM view_transaksi_detail t2 INNER JOIN view_transaksi t1 ON t1.id_transaksi = t2.id_transaksi WHERE t1.tanggal BETWEEN '$tanggal1' AND '$tanggal2' ORDER BY t1.tanggal DESC");
                  $sql2 = mysqli_query($db, "SELECT COUNT(t1.kode_pelanggan) AS kode, SUM(t2.harga_paket) AS total FROM view_transaksi_detail t2 INNER JOIN view_transaksi t1 ON t1.id_transaksi = t2.id_transaksi WHERE t1.tanggal BETWEEN '$tanggal1' AND '$tanggal2' ORDER BY t1.tanggal DESC");
                  $data = mysqli_fetch_array($sql2);
                  if (mysqli_num_rows($sql) > 0) {
                    $tgl1 = date("d-m-Y", strtotime($tanggal1));
                    $tgl2 = date("d-m-Y", strtotime($tanggal2));
                    ?>
                    <div class="box-header with-border">
                      <h3 class="box-title">Cetak Laporan <small><strong>dari tanggal <?=$tgl1;?> sampai tanggal <?=$tgl2;?></small></strong>
                      <a href="laporan.php" id="tombol" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>&nbsp;<a onclick="window.print()" id="tombol" class="btn btn-warning btn-sm"><i class="fa fa-fw fa-print"></i> Cetak</a></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" width="100%">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Kode Pelanggan</th>
                              <th>Nama</th>
                              <th>Paket</th>
                              <th>Harga Paket</th>
                              <th>Kasir</th>
                              <th>Tanggal</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php

                            $no = 1;

                            while ($row = mysqli_fetch_array($sql)) {
                              ?>
                              <tr>
                                <td>
                                  <?=$no;?>
                                </td>
                                <td>
                                  <?=$row['kode_pelanggan'];?>
                                </td>
                                <td>
                                  <?=$row['nama_pelanggan'];?>
                                </td>
                                <td>
                                  <?=$row['nama_paket'];?>
                                </td>
                                <td>
                                  <?='Rp ' . number_format($row['harga_paket'], 0, ",", ".");?>
                                </td>
                                <td>
                                  <?=$row['nama_user'];?>
                                </td>
                                <td>
                                  <?=date("d-m-Y", strtotime($row['tanggal']));?>
                                </td>
                              </tr>
                              <?php 
                              $no++; 
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-md-6">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Jumlah Pelanggan</th>
                            <th>Jumlah Pendapatan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><strong><?=$data['kode'] . " Orang";?></strong></td>
                            <td><strong><?='Rp ' . number_format($data['total'], 0, ",", ".");?></strong></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                    </div>
                    <!-- /.box-body -->
                  <?php
                  } else {
                      $tgl1 = date("d-m-Y", strtotime($tanggal1));
                      $tgl2 = date("d-m-Y", strtotime($tanggal2));
                      ?>
                      <div class="box-header with-border">
                      <h3 class="box-title">Cetak Laporan <small><strong>dari tanggal <?=$tgl1;?> sampai tanggal <?=$tgl2;?></small></strong>
                      <a href="laporan.php" id="tombol" class="btn btn-primary btn-sm"><i class="fa fa-fw fa-arrow-left"></i> Kembali</a>&nbsp;<a onclick="window.print()" id="tombol" class="btn btn-warning btn-sm"><i class="fa fa-fw fa-print"></i> Cetak</a></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" width="100%">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Kode Pelanggan</th>
                              <th>Nama</th>
                              <th>Paket</th>
                              <th>Total</th>
                              <th>Kasir</th>
                              <th>Tanggal</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th colspan="7"><center><b>Tidak ada data yang tersedia.</b></center></th>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- /.box-body -->
                  <?php
                  }
                } else {
                  $tanggal = date("Y-m-d");
                  $sql = mysqli_query($db, "SELECT COUNT(t1.kode_pelanggan) AS kode, SUM(t2.harga_paket) AS total FROM view_transaksi_detail t2 INNER JOIN view_transaksi t1 ON t1.id_transaksi = t2.id_transaksi WHERE t1.tanggal = '$tanggal'");
                  $row = mysqli_fetch_array($sql);
                  ?>
              <div class="box-header with-border">
                <h3 class="box-title">Rekap Laporan Penghasilan Hari Ini (<small><strong><?=date("d-m-Y");?></strong></small>)</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form method="post" action="" role="form" id="tombol">
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Dari tanggal</label>
                        <input type="date" class="form-control" name="tanggal1" required="">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Sampai tanggal</label>
                        <input type="date" class="form-control" name="tanggal2" required="">
                      </div>
                    </div>
                  </div>
                  <input type="submit" value="Tampilkan" class="btn btn-success" name="tampil" />&nbsp;
                </div>
                <!-- /.box-body -->
              </form>
              <div class="row">
                <div class="box-body">
                  <div class="col-md-6">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover">
                        <thead>
                          <tr>
                            <th>Jumlah Pelanggan</th>
                            <th>Jumlah Pendapatan</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><strong><?=$row['kode'] . " Orang";?></strong></td>
                            <td><strong><?='Rp ' . number_format($row['total'], 0, ",", ".");?></strong></td>
                          </tr>
                        </tbody>
                      </table>
                      <a onclick="window.print()" id="tombol" class="btn btn-warning"><i class="fa fa-fw fa-print"></i> Cetak</a>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <?php } ?>
            </div>
            <!-- /.box -->
          </div>
          <!-- /.col-lg-6 -->
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

  <?php include('_partials/ajax.php'); ?>

</body>

</html>

<?php
}
?>