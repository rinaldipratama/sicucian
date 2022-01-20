<?php
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } else {
        if (isset($_POST['simpan'])) {
            $kode_pelanggan = filter_input(INPUT_POST, 'nama_pelanggan', FILTER_SANITIZE_STRING);
            $tipe_mobil = filter_input(INPUT_POST, 'tipe_mobil', FILTER_SANITIZE_STRING);
            $nopol = filter_input(INPUT_POST, 'nopol', FILTER_SANITIZE_STRING);
            $paket = filter_input(INPUT_POST, 'paket', FILTER_SANITIZE_STRING);
            $paket2 = filter_input(INPUT_POST, 'paket2', FILTER_SANITIZE_STRING);
            $bayar = filter_input(INPUT_POST, 'bayar', FILTER_SANITIZE_STRING);
            // $kembali = filter_input(INPUT_POST, 'kembali', FILTER_SANITIZE_STRING);
            $total = filter_input(INPUT_POST, 'total', FILTER_SANITIZE_STRING);
            $tanggal = date('Y-m-d');
            $id_user = $_SESSION['id_user'];

            $bayar2 = (int)str_replace(".", "", $bayar);
            // $kembali2 = (int)str_replace(".", "", $kembali);

            if (empty($paket2)) {
                $sql = "INSERT INTO tb_transaksi(kode_pelanggan, id_user, tanggal, created_by) VALUE ('$kode_pelanggan', '$id_user', '$tanggal', '$id_user')";
                $query = mysqli_query($db, $sql);

                if ($query) {
                    $sql2 = "SELECT MAX(id_transaksi) AS id_transaksi FROM tb_transaksi";
                    $query2 = mysqli_query($db, $sql2);
                    $max_id = mysqli_fetch_array($query2);
                    $max_id2 = $max_id['id_transaksi'];

                    $sql3 = "INSERT INTO tb_transaksi_detail(id_transaksi, id_paket, bayar, created_by) VALUE ('$max_id2', '$paket', '$bayar2', '$id_user')";
                    $query3 = mysqli_query($db, $sql3);

                    if ($query3) {
                      $_SESSION['success'] = 'Data Transaksi berhasil ditambahkan.';
                      header('Location: transaksi.php');
                    } else {
                        $_SESSION['error'] = 'Data Transaksi gagal ditambahkan.';
                        header('Location: transaksi_add.php');
                    }
                } else {
                    $_SESSION['error'] = 'Data Transaksi gagal ditambahkan.';
                    header('Location: transaksi_add.php');
                }
            } else {
                $sql = "INSERT INTO tb_transaksi(kode_pelanggan, id_user, tanggal, created_by) VALUE ('$kode_pelanggan', '$id_user', '$tanggal', '$id_user')";
                $query = mysqli_query($db, $sql);

                if ($query) {
                    $sql2 = "SELECT MAX(id_transaksi) AS id_transaksi FROM tb_transaksi";
                    $query2 = mysqli_query($db, $sql2);
                    $max_id = mysqli_fetch_array($query2);
                    $max_id2 = $max_id['id_transaksi'];

                    $sql3 = "INSERT INTO tb_transaksi_detail(id_transaksi, id_paket, bayar, created_by) VALUE ('$max_id2', '$paket', '$bayar2', '$id_user')";
                    $query3 = mysqli_query($db, $sql3);
                    
                    $sql4 = "INSERT INTO tb_transaksi_detail(id_transaksi, id_paket, bayar, created_by) VALUE ('$max_id2', '$paket2', '$bayar2', '$id_user')";
                    $query4 = mysqli_query($db, $sql4);

                    if ($query3 AND $query4) {
                        $_SESSION['success'] = 'Data Transaksi berhasil ditambahkan.';
                        header('Location: transaksi.php');
                    } else {
                        $_SESSION['error'] = 'Data Transaksi gagal ditambahkan.';
                        header('Location: transaksi_add.php');
                    }
                }
            }
        } else {
            header('Location: transaksi.php');
        }
?>
<?php
}
?>