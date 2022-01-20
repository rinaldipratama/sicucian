<?php
    //cek session
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } else {
      if (!isset($_GET['id_transaksi'])) {
        header('Location: transaksi.php');
      }

      $id_transaksi = $_GET['id_transaksi'];

      $sql = "SELECT * FROM view_transaksi WHERE id_transaksi=$id_transaksi";
      $query = mysqli_query($db, $sql);
      $transaksi= mysqli_fetch_assoc($query);

      if (mysqli_num_rows($query) < 1){
        header("Location: transaksi.php");
      } else {
        $sql = "DELETE FROM tb_transaksi WHERE id_transaksi=$id_transaksi";
        $sql2 = "DELETE FROM tb_transaksi_detail WHERE id_transaksi=$id_transaksi";
        $query = mysqli_query($db, $sql);
        $query2 = mysqli_query($db, $sql2);
          if ($query AND $query2) {
            $_SESSION['success'] = 'Data transaksi berhasil dihapus.';
            header('Location: transaksi.php');
          } 
      }
    }