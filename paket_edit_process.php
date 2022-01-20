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

        // ambil data dari paket_edit.php
        $id_paket = $_POST['id_paket'];
        $paket = filter_input(INPUT_POST, 'paket', FILTER_SANITIZE_STRING);
        $biaya = str_replace(".", "", filter_input(INPUT_POST, 'biaya', FILTER_SANITIZE_STRING));
        $updated_at = date('Y-m-d H:i:s');
        $updated_by = $_SESSION['id_user'];

        $sql = mysqli_query($db, "SELECT * FROM tb_paket WHERE paket = '$paket'");
        $check = mysqli_num_rows($sql);

          //if ($check > 0) {
          //  $_SESSION['error'] = 'Nama paket sudah ada.';
          //    header('Location: paket_edit.php?id_paket='."'".$id_paket."'".'');
          //} else {
              // buat query update
            $sql = "UPDATE tb_paket SET paket='$paket', biaya='$biaya', updated_at='$updated_at', updated_by='$updated_by' WHERE id_paket='$id_paket'";
            $query = mysqli_query($db, $sql);
            if ($query) {
                // kalau berhasil alihkan ke halaman paket.php dan
                // buat session success untuk pemberitahuan
                $_SESSION['success'] = 'Data paket berhasil diperbarui.';
                header('Location: paket.php');
            } else {
              // kalau gagal alihkan ke halaman paket.php dan
              // buat session error untuk pemberitahuan
              $_SESSION['error'] = 'Data paket gagal diperbarui.';
              header('Location: paket_edit.php');
            }
          //}
      } else {
        header('Location: paket.php');
      }
?>
<?php
}
?>