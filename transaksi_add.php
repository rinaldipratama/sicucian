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
              Transaksi Cucian
          </h1>
          <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="transaksi.php">Transaksi Cucian</a></li>
              <li class="active">Tambah Data Transaksi Cucian</li>
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
                <h3 class="box-title">Tambah Data Transaksi Cucian</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form method="post" action="transaksi_add_process.php" role="form">
                <div class="box-body">
                    <div class="row">
                      <div class="col-md-5">
                        <div class="form-group">
                        <label>Nama Pelanggan</label>
                        <select class="form-control select2" style="width: 100%" id="nama_pelanggan" name="nama_pelanggan" required="">
                          <option value="">Pilih Pelanggan</option>
                          <?php
                            $query = mysqli_query($db, "SELECT * FROM tb_pelanggan ORDER BY created_at DESC"); 
                            if (mysqli_num_rows($query) > 0):
                          ?>
                          <?php foreach ($query as $row): ?>
                            <option value="<?=$row['kode_pelanggan'];?>"><?=$row['nama'];?></option>
                          <?php endforeach; ?>
                          <?php endif; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Tipe Mobil</label>
                        <input type="text" class="form-control" id="tipe_mobil" name="tipe_mobil" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>NOPOL</label>
                        <input type="text" class="form-control" id="nopol" name="nopol" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                        <label>Paket</label>
                        <select class="form-control" id="paket" name="paket">
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
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-4">
                        <button id="button" type="button" class="btn btn-warning">Ada Paket Lainnya?</button>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Biaya</label>
                        <input type="text" class="form-control biaya" id="biaya" name="biaya" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Bayar</label>
                        <input type="text" class="form-control mata-uang" id="bayar" placeholder="Bayar" name="bayar" required="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Kembalian</label>
                        <input type="text" class="form-control kembali" id="kembali" name="kembali" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Total Bayar</label>
                        <input type="text" class="form-control total" id="total" name="total" readonly="">
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