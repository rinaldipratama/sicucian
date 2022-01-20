<?php
    //cek session
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } else {
      // cek apakah tombol simpan sudah diklik atau blum?
      if(isset($_POST['simpan'])){

        // ambil data dari pelanggan_edit.php
        $kode = $_POST['kode'];
        $nama = filter_input(INPUT_POST, 'nama', FILTER_SANITIZE_STRING);
        $tipe_mobil = filter_input(INPUT_POST, 'tipe_mobil', FILTER_SANITIZE_STRING);
        $nopol = filter_input(INPUT_POST, 'nopol', FILTER_SANITIZE_STRING);
        $alamat = filter_input(INPUT_POST, 'alamat', FILTER_SANITIZE_STRING);
        $telepon = filter_input(INPUT_POST, 'telepon', FILTER_SANITIZE_STRING);
        $updated_at = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['id_user'];

        $sql = mysqli_query($db, "SELECT * FROM tb_pelanggan WHERE nama = '$nama'");
        $check = mysqli_num_rows($sql);

          //if ($check > 0) {
          //    header('Location: pelanggan_edit.php?kode_pelanggan='."'".$kode_pelanggan."'".'');
          //} else {
              // buat query update
            $sql = "UPDATE tb_pelanggan SET nama='$nama', alamat='$alamat', telepon='$telepon', tipe_mobil='$tipe_mobil', nopol = '$nopol', updated_at='$updated_at', updated_by='$updated_by'  WHERE kode_pelanggan='$kode'";
            $query = mysqli_query($db, $sql);
            if ($query) {
                // kalau berhasil alihkan ke halaman pelanggan.php dan
                // buat session success untuk pemberitahuan
                $_SESSION['success'] = 'Data pelanggan berhasil diperbarui.';
                header('Location: pelanggan.php');
            } else {
              // kalau gagal alihkan ke halaman pelanggan.php dan
              // buat session error untuk pemberitahuan
              $_SESSION['error'] = 'Data pelanggan gagal diperbarui.';
              header('Location: pelanggan_edit.php');
            }
          //}
      } else {
        header('Location: pelanggan.php');
      }
?>
<?php
}
?>