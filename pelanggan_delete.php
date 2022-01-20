<?php
    //cek session
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } else {
      if (!isset($_GET['kode_pelanggan'])) {
        header('Location: pelanggan.php');
      }

      $kode_pelanggan = $_GET['kode_pelanggan'];

      $sql = "SELECT * FROM tb_pelanggan WHERE kode_pelanggan='$kode_pelanggan'";
      $query = mysqli_query($db, $sql);
      $pelanggan= mysqli_fetch_assoc($query);

      if (mysqli_num_rows($query) < 1){
        header("Location: pelanggan.php");
      } else {
        $sql = "DELETE FROM tb_pelanggan WHERE kode_pelanggan='$kode_pelanggan'";
        $query = mysqli_query($db, $sql);
          if ($query) {
            $_SESSION['success'] = 'Data pelanggan berhasil dihapus.';
            header('Location: pelanggan.php');
          } 
      }
    }