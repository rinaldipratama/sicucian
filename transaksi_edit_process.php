<?php
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } else {
        if (isset($_POST['simpan'])) {
            $id_transaksi = $_POST['id_transaksi'];
            $id_transaksidetail = $_POST['id_transaksidetail'];
            $id_transaksidetail2 = $_POST['id_transaksidetail2'];
            $kode_pelanggan = filter_input(INPUT_POST, 'nama_pelanggan', FILTER_SANITIZE_STRING);
            $tipe_mobil = filter_input(INPUT_POST, 'tipe_mobil', FILTER_SANITIZE_STRING);
            $nopol = filter_input(INPUT_POST, 'nopol', FILTER_SANITIZE_STRING);
            $paket = filter_input(INPUT_POST, 'paket', FILTER_SANITIZE_STRING);
            $paket2 = filter_input(INPUT_POST, 'paket2', FILTER_SANITIZE_STRING);
            $bayar = filter_input(INPUT_POST, 'bayar', FILTER_SANITIZE_STRING);
            $kembali = filter_input(INPUT_POST, 'kembali', FILTER_SANITIZE_STRING);
            $total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_STRING);
            $id_user = $_SESSION['id_user'];
            $updated_at = date('Y-m-d H:i:s');

            $bayar2 = (int)str_replace(".", "", $bayar);

            if (!empty($paket) AND !empty($paket2)) {
                $sql = "UPDATE tb_transaksi SET id_user = '$id_user', updated_at = '$updated_at', updated_by = '$id_user' WHERE id_transaksi='$id_transaksi'";
                $query = mysqli_query($db, $sql);

                $sql2 = "UPDATE tb_transaksi_detail SET id_paket = '$paket', bayar = '$bayar2', updated_at = '$updated_at', updated_by = '$id_user' WHERE id_transaksi='$id_transaksi' AND id_transaksi_detail='$id_transaksidetail'";
                $query2 = mysqli_query($db, $sql2);

                $sql3 = "UPDATE tb_transaksi_detail SET id_paket = '$paket2', bayar = '$bayar2', updated_at = '$updated_at', updated_by = '$id_user' WHERE id_transaksi='$id_transaksi' AND id_transaksi_detail='$id_transaksidetail2'";
                $query3 = mysqli_query($db, $sql3);

                if ($query AND $query2 AND $query3) {
                    $_SESSION['success'] = 'Data transaksi berhasil diperbarui.';
                    header('Location: transaksi.php');
                } else {
                    $_SESSION['error'] = 'Data transaksi gagal diperbarui.';
                    header('Location: transaksi_edit.php');
                }
            } elseif (empty($paket2)) {
                $sql = "UPDATE tb_transaksi SET id_user = '$id_user', updated_at = '$updated_at', updated_by = '$id_user' WHERE id_transaksi='$id_transaksi'";
                $query = mysqli_query($db, $sql);

                if ($query) {
                    $sql2 = "UPDATE tb_transaksi_detail SET id_paket = '$paket', bayar = '$bayar2', updated_at = '$updated_at', updated_by = '$id_user' WHERE id_transaksi='$id_transaksi'";
                    $query2 = mysqli_query($db, $sql2);                    

                    if ($query2) {
                        $_SESSION['success'] = 'Data transaksi berhasil diperbarui.';
                        header('Location: transaksi.php');
                    } else {
                        $_SESSION['error'] = 'Data transaksi gagal diperbarui.';
                        header('Location: transaksi_edit.php');
                    }
                } else {
                    $_SESSION['error'] = 'Data transaksi gagal diperbarui.';
                    header('Location: transaksi_edit.php');
                }
            }
        } else {
            header('Location: transaksi.php');
        }
?>
<?php
}
?>