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
      // cek apakah tombol simpan sudah diklik atau blum?
      if(isset($_POST['simpan'])){

          // ambil data dari paket_add.php
          $paket = filter_input(INPUT_POST, 'paket', FILTER_SANITIZE_STRING);
          $biaya = (int)str_replace(".", "", filter_input(INPUT_POST, 'biaya', FILTER_SANITIZE_STRING));
          $created_by = $_SESSION['id_user'];

          $sql = mysqli_query($db, "SELECT * FROM tb_paket WHERE paket = '$paket'");
          $check = mysqli_num_rows($sql);

          // jika nama paket yg ada di database sama dengan inputan nama paket
          // tampilkan pemberitahuan nama sudah ada
          if ($check > 0) {
              $_SESSION['error'] = 'Nama paket sudah ada.';
              header('Location: paket_add.php');
          } else {
              // buat query simpan
              $sql = "INSERT INTO tb_paket (paket, biaya, created_by) VALUE ('$paket', '$biaya', '$created_by')";
              $query = mysqli_query($db, $sql);
              if ($query) {
                  // kalau berhasil alihkan ke halaman paket.php dan
                  // buat session success untuk pemberitahuan
                  $_SESSION['success'] = 'Data paket berhasil ditambahkan.';
                  header('Location: paket.php');
              } else {
                  // kalau gagal alihkan ke halaman paket.php dan
                  // buat session error untuk pemberitahuan
                  $_SESSION['error'] = 'Data paket gagal ditambahkan.';
                  header('Location: paket_add.php');
              }
          }
      } else {
        header('Location: paket.php');
      }
?>
<?php
}
?>