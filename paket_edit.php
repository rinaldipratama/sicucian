<?php
    //cek session
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } elseif ($_SESSION['level'] === 'Kasir') {
      header("Location: ./home.php");
    } else {
        // kalau tidak ada id_paket di query string
        if (!isset($_GET['id_paket'])) {
          header('Location: paket.php');
        }

      //ambil id_paket dari query string
      $id_paket = $_GET['id_paket'];

      // buat query untuk ambil data dari database
      $sql = "SELECT * FROM tb_paket WHERE id_paket = '$id_paket'";
      $query = mysqli_query($db, $sql);
      $paket = mysqli_fetch_assoc($query);

      // jika data yang di-edit tidak ditemukan alihkan ke paket.php
      if( mysqli_num_rows($query) < 1 ){
        header("Location: paket.php");
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
              Paket
          </h1>
          <ol class="breadcrumb">
            <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="paket.php">Paket</a></li>
            <li class="active">Edit Data Paket</li>
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
                <h3 class="box-title">Edit Data Paket</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <form method="post" action="paket_edit_process.php" role="form">
                <div class="box-body">
                  <input type="hidden" name="id_paket" value="<?=$paket['id_paket'];?>" />
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Nama Paket</label>
                        <input type="text" class="form-control" placeholder="Nama Paket" value="<?=$paket['paket'];?>" name="paket" autofocus="autofocus" required="required">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-5">
                        <label>Harga Paket</label>
                        <input type="text" class="form-control h_paket" id="h_paket" placeholder="Harga Paket" value="<?=number_format($paket['biaya'], 0, ",", ".");?>" name="biaya" required="required">
                      </div>
                    </div>
                  </div>
                  <input type="submit" value="Simpan Data" class="btn btn-success" name="simpan" />&nbsp;
                  <a class="btn btn-default" href="paket.php">Kembali</a>
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