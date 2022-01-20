<?php
    //cek session
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } else {
      if (!isset($_GET['id_transaksi'])) {
        header('Location: transaksi.php');
      }

      $id_transaksi = $_GET['id_transaksi'];

      $sql = "SELECT * FROM view_transaksi WHERE id_transaksi=$id_transaksi";
      $query = mysqli_query($db, $sql);
      $sql2 = "SELECT * FROM view_transaksi_detail WHERE id_transaksi=$id_transaksi";
      $query2 = mysqli_query($db, $sql2);
      $query3 = mysqli_query($db, "SELECT sum(harga_paket) as harga_paket FROM view_transaksi_detail WHERE id_transaksi = $id_transaksi");
      $query4 = mysqli_query($db, "SELECT count(harga_paket) as c_hargapaket FROM view_transaksi_detail WHERE id_transaksi = $id_transaksi");

      $transaksi = mysqli_fetch_assoc($query);
      $transaksi2 = mysqli_fetch_assoc($query2);
      $data3 = mysqli_fetch_array($query3);
      $data4 = mysqli_fetch_array($query4);

      if (mysqli_num_rows($query) < 1){
        header("Location: transaksi.php");
      }
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
              Transaksi Cucian
          </h1>
          <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="transaksi.php">Transaksi Cucian</a></li>
              <li class="active">Edit Data Transaksi Cucian</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <?php if (isset($_SESSION['error'])) : ?>
          <p>
        <?php
            $error = $_SESSION['error'];
            if ($error) {
            ?>
            <div id="errorMessage" class="alert alert-danger" role="alert">
              <i class="fa fa-exclamation-circle"></i>&nbsp;<?=$error;?>
            </div>
            <?php
            }
        ?>
        </p>
        <?php
        unset($_SESSION['error']);
        endif;
        ?>
        
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Edit Data Transaksi Cucian</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form method="post" action="transaksi_edit_process.php" role="form">
                <input type="hidden" name="id_transaksi" value="<?=$transaksi['id_transaksi'];?>" />
                <?php 
                mysqli_data_seek($query2, 0);
                $row = mysqli_fetch_array($query2);
                ?>
                <input type="hidden" name="id_transaksidetail" value="<?=$row['id_transaksi_detail'];?>" />
                <?php 
                mysqli_data_seek($query2, 1);
                $row = mysqli_fetch_array($query2);
                ?>
                <input type="hidden" name="id_transaksidetail2" value="<?=$row['id_transaksi_detail'];?>" />
                <div class="box-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                        <label>Nama Pelanggan</label>
                         <input type="text" class="form-control" name="nama_pelanggan" value="<?=$transaksi['nama_pelanggan'];?>" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Tipe Mobil</label>
                        <input type="text" class="form-control" placeholder="Tipe Mobil" name="tipe_mobil" value="<?=$transaksi['tipe_mobil'];?>" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>NOPOL</label>
                        <input type="text" class="form-control" placeholder="NOPOL" name="nopol" value="<?=$transaksi['nopol'];?>" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                        <label>Paket</label>
                        <select class="form-control" id="paket" name="paket"  required="">
                          <?php 
                          mysqli_data_seek($query2, 0);
                          $row = mysqli_fetch_array($query2);
                          ?>
                          <option value="<?=$row['id_paket'];?>"><?=$row['nama_paket'];?></option>
                          <?php

                          $q = mysqli_query($db, "SELECT * FROM tb_paket ORDER BY paket ASC");
                          while($data = mysqli_fetch_array($q)){
                            echo '<option value="'.$data['id_paket'].'">'.$data['paket'].'</option>';
                          }

                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <?php if ($data4['c_hargapaket'] == 1) { ?>
                  <div class="form-group hint">
                    <div class="row">
                      <div class="col-md-4">
                        <select class="form-control" id="paket2" name="paket2">
                          <option value="">Pilih Paket</option>
                          <?php

                          $q = mysqli_query($db, "SELECT * FROM tb_paket ORDER BY paket ASC");
                          while($data = mysqli_fetch_array($q)){
                            echo '<option value="'.$data['id_paket'].'">'.$data['paket'].'</option>';
                          }

                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                        <button id="button" type="button" class="btn btn-warning">Ada Paket Lainnya?</button>
                      </div>
                    </div>
                  </div> -->
                  <?php } else { ?>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                        <select class="form-control" id="paket2" name="paket2">
                          <?php 
                          mysqli_data_seek($query2, 1);
                          $row = mysqli_fetch_array($query2);
                          ?>
                          <option value="<?=$row['id_paket'];?>"><?=$row['nama_paket'];?></option>
                          <?php

                          $q = mysqli_query($db, "SELECT * FROM tb_paket ORDER BY paket ASC");
                          while($data = mysqli_fetch_array($q)){
                            echo '<option value="'.$data['id_paket'].'">'.$data['paket'].'</option>';
                          }

                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Biaya</label>
                        <input type="text" class="form-control biaya" id="biaya" name="biaya" value="<?='Rp ' . number_format($data3['harga_paket'], 0, ",", ".");?>" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Bayar</label>
                        <input type="text" class="form-control mata-uang" id="bayar" placeholder="Bayar" name="bayar" value="<?=number_format($transaksi2['bayar'], 0, ",", ".");?>" required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Kembalian</label>
                        <input type="text" class="form-control kembali" id="kembali" name="kembali" value="<?=number_format($transaksi2['bayar'] - $data3['harga_paket'], 0, ",", ".");?>" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Total Bayar</label>
                        <input type="text" class="form-control total" id="total" name="total" value="<?='Rp ' . number_format($data3['harga_paket'], 0, ",", ".");?>" readonly="">
                      </div>
                    </div>
                  </div>
                  <input type="submit" value="Simpan Data" class="btn btn-success" name="simpan" />&nbsp;
                  <a class="btn btn-default" href="transaksi.php">Kembali</a>
                </div>
                <!-- /.box-body -->
              </form>
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