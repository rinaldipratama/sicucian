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
              Paket
          </h1>
          <ol class="breadcrumb">
              <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active">Paket</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">

        <?php if(isset($_SESSION['success'])): ?>
          <p>
            <?php
            $success = $_SESSION['success'];
            if ($success) {
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
                <h3 class="box-title">Data Paket
                  &nbsp;&nbsp;<a class="btn btn-primary" href="paket_add.php"><i class="fa fa-fw fa-plus"></i> Tambah Data Paket</a></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" width="100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Paket</th>
                          <th>Harga Paket</th>
                          <th>Dibuat Pada</th>
                          <th>Diperbarui Pada</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        //script untuk menampilkan data
                        $query = mysqli_query($db, "SELECT * FROM tb_paket ORDER BY paket ASC");
                        if (mysqli_num_rows($query) > 0) { 
                          $no = 1;
                          while ($row = mysqli_fetch_array($query)) {
                          ?>
                          <tr>
                            <td>
                              <?=$no;?>
                            </td>
                            <td>
                              <?=$row['paket'];?>
                            </td>
                            <td>
                              <?='Rp ' . number_format($row['biaya'], 0, ",", ".");?>
                            </td>
                            <td>
                              <?=date('d-m-Y H:i:s', strtotime($row['created_at']));?>
                            </td>
                            <td>
                              <?=date('d-m-Y H:i:s', strtotime($row['updated_at']));?>
                            </td>
                            <td>
                              <a href="paket_edit.php?id_paket=<?=$row['id_paket'];?>" class="btn btn-success"><i class="fa fa-fw fa-edit"></i> Edit</a>&nbsp;
                              <a onclick="return confirmDialog();" href="paket_delete.php?id_paket=<?php echo $row['id_paket'] ?>" class="btn btn-danger mb-1"><i class="fa fa-fw fa-trash"></i> Delete</a>
                            </td>
                          </tr>
                        <?php 
                          $no++; 
                          }
                        } else {
                          echo '<tr>
                                  <th colspan="6"><center><b>Tidak ada data yang tersedia.</b></center></th>
                                </tr>';
                        }
                        ?>
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