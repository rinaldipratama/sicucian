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
      if (!isset($_GET['id_user'])) {
        header('Location: user.php');
      }

      $id_user = $_GET['id_user'];

      $sql = "SELECT * FROM tb_user WHERE id_user=$id_user";
      $query = mysqli_query($db, $sql);
      $user= mysqli_fetch_assoc($query);

      if (mysqli_num_rows($query) < 1){
        header("Location: user.php");
      } else {
        $sql = "DELETE FROM tb_user WHERE id_user=$id_user";
        $query = mysqli_query($db, $sql);
          if ($query) {
            $_SESSION['success'] = 'Data user berhasil dihapus.';
            header('Location: user.php');
          } 
      }
    }