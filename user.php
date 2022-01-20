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
              User
              <small>
                  
              </small>
          </h1>
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
                <h3 class="box-title">Data User
                  &nbsp;&nbsp;<a class="btn btn-primary" href="user_add.php"><i class="fa fa-fw fa-plus"></i> Tambah Data User</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table id="user" class="table table-bordered table-striped table-hover" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Username</th>
                          <th>Nama</th>
                          <th>Level</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                    <script>
                        function confirmDialog() {
                          return confirm("Apakah Anda yakin akan menghapus data ini?");
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