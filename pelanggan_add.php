<?php
    //cek session
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } else {
      $sql = mysqli_query($db, "SELECT kode_pelanggan FROM tb_pelanggan ORDER BY kode_pelanggan DESC");
      $row = mysqli_fetch_array($sql);

      $kode_pelanggan = $row['kode_pelanggan'];

    //Membuat urutan kode_pelanggan
    $urut = substr($kode_pelanggan, 4, 4);

    $tambah  = (int) $urut+1;

    if  (strlen($tambah) == 1 ){
      $format="PLG-"."000".$tambah;
    }elseif (strlen($tambah)== 2 ){
      $format="PLG-"."00".$tambah;
    }elseif (strlen($tambah)== 3 ){
      $format="PLG-"."0".$tambah;
    }else{
      $format="PLG-".$tambah;
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
              <li class="active">Tambah Data Pelanggan</li>
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
                <h3 class="box-title">Tambah Data pelanggan</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form method="post" action="pelanggan_add_process.php" role="form">
                <div class="box-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Kode Pelanggan</label>
                        <input type="text" class="form-control" value="<?php echo $format ?>" name="kode" readonly="">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Nama pelanggan</label>
                        <input type="text" class="form-control" placeholder="Nama Pelanggan" name="nama" autofocus="autofocus" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Tipe Mobil</label>
                        <input type="text" class="form-control" placeholder="Tipe Mobil" name="tipe_mobil" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>NOPOL</label>
                        <input type="text" class="form-control" placeholder="NOPOL" name="nopol" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Alamat</label>
                        <input type="text" class="form-control" placeholder="Alamat" name="alamat" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Telepon</label>
                        <input type="number" min="0" class="form-control" placeholder="Telepon" name="telepon" required="required">
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