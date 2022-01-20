<?php
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } else {
      if(isset($_POST['simpan'])){
          $kode = filter_input(INPUT_POST, 'kode', FILTER_SANITIZE_STRING);
          $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
          $tipe_mobil = filter_input(INPUT_POST, 'tipe_mobil', FILTER_SANITIZE_STRING);
          $nopol = filter_input(INPUT_POST, 'nopol', FILTER_SANITIZE_STRING);
          $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
          $telepon = filter_input(INPUT_POST, 'telepon', FILTER_SANITIZE_STRING);
          $created_by = $_SESSION['id_user'];

          // buat query simpan
          $sql = "INSERT INTO tb_pelanggan (kode_pelanggan, nama, tipe_mobil, nopol, alamat, telepon, created_by) VALUE ('$kode', '$nama', '$tipe_mobil', '$nopol', '$alamat', '$telepon', '$created_by')";
          $query = mysqli_query($db, $sql);
          if ($query) {
            $_SESSION['success'] = 'Data pelanggan berhasil ditambahkan.';
            header('Location: pelanggan.php');
          } else {
            $_SESSION['error'] = 'Data pelanggan gagal ditambahkan.';
            header('Location: pelanggan_add.php');
          }
      } else {
        header('Location: pelanggan.php');
      }
?>
<?php
}
?>