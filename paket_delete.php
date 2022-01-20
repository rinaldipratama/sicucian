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
      if (!isset($_GET['id_paket'])) {
        header('Location: paket.php');
      }

      $id_paket = $_GET['id_paket'];

      $sql = "SELECT * FROM tb_paket WHERE id_paket=$id_paket";
      $query = mysqli_query($db, $sql);
      $paket= mysqli_fetch_assoc($query);

      if (mysqli_num_rows($query) < 1){
        header("Location: paket.php");
      } else {
        $sql = "DELETE FROM tb_paket WHERE id_paket=$id_paket";
        $query = mysqli_query($db, $sql);
          if ($query) {
            $_SESSION['success'] = 'Data paket berhasil dihapus.';
            header('Location: paket.php');
          } 
      }
    }