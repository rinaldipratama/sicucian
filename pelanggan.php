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
              Pelanggan
          </h1>
          <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active">Pelanggan</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <?php if(isset($_SESSION['success'])): ?>
          <p>
            <?php
            $success = $_SESSION['success'];
            if($success){
            ?>
            <div id="successMessage" class="alert alert-success" role="alert">
                <i class="fa fa-check"></i>&nbsp;<?=$success;?>
            </div>
            <?php
            }
            ?>
          </p>
        <?php 
        unset($_SESSION['success']);
        endif;
        ?>

        <div class="row">
          <div class="col-xs-12">
            <div class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Data Pelanggan
                  &nbsp;&nbsp;<a class="btn btn-primary" href="pelanggan_add.php"><i class="fa fa-fw fa-plus"></i> Tambah Data Pelanggan</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="pelanggan" class="table table-bordered table-striped table-hover" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Kode Pelanggan</th>
                          <th>Nama</th>
                          <th>Tipe Mobil</th>
                          <th>NOPOL</th>
                          <th>Alamat</th>
                          <th>Telepon</th>
                          <th>Dibuat Pada</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <script>
                        function confirmDialog() {
                          return confirm("Data yang dihapus tidak akan bisa dikembalikan. Apakah Anda yakin akan menghapus data ini?");
                        }
                    </script>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
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

  <?php include('_partials/ajax.php'); ?>

</body>

</html>

<?php
}
?>