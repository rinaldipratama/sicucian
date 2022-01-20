<?php
    //cek session
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } else {
        // kalau tidak ada kode_pelanggan di query string
        if (!isset($_GET['kode_pelanggan'])) {
          header('Location: pelanggan.php');
        }

      //ambil kode_pelanggan dari query string
      $kode_pelanggan = $_GET['kode_pelanggan'];

      // buat query untuk ambil data dari database
      $sql = "SELECT * FROM tb_pelanggan WHERE kode_pelanggan = '$kode_pelanggan'";
      $query = mysqli_query($db, $sql);
      $pelanggan = mysqli_fetch_assoc($query);

      // jika data yang di-edit tidak ditemukan alihkan ke pelanggan.php
      if( mysqli_num_rows($query) < 1 ){
        header("Location: pelanggan.php");
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
              Pelanggan
          </h1>
          <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="pelanggan.php">Pelanggan</a></li>
              <li class="active">Edit Data Pelanggan</li>
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
                <h3 class="box-title">Edit Data Pelanggan</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form method="post" action="pelanggan_edit_process.php" role="form">
                <div class="box-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Kode Pelanggan</label>
                        <input type="text" class="form-control" value="<?=$pelanggan['kode_pelanggan'];?>" name="kode" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Nama pelanggan</label>
                        <input type="text" class="form-control" placeholder="Nama pelanggan" value="<?=$pelanggan['nama'];?>" name="nama" autofocus="autofocus" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Tipe Mobil</label>
                        <input type="text" class="form-control" placeholder="Tipe Mobil" value="<?=$pelanggan['tipe_mobil'];?>" name="tipe_mobil" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>NOPOL</label>
                        <input type="text" class="form-control" placeholder="NOPOL" value="<?=$pelanggan['nopol'];?>" name="nopol" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat" value="<?=$pelanggan['alamat'];?>" name="alamat" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Telepon</label>
                        <input type="number" class="form-control" placeholder="Telepon" value="<?=$pelanggan['telepon'];?>" name="telepon" required="required">
                      </div>
                    </div>
                  </div>
                   <input type="submit" value="Simpan Data" class="btn btn-success" name="simpan" />&nbsp;
                  <a class="btn btn-default" href="pelanggan.php">Kembali</a>
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