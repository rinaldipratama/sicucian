<?php
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } elseif ($_SESSION['level'] === 'Kasir') {
      header("Location: ./home.php");
    } else {
      if(isset($_POST['simpan'])){
          $id_user = filter_input(INPUT_POST, 'id_user', FILTER_SANITIZE_STRING);
          $username = strtolower(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
          $nama_user = filter_input(INPUT_POST, 'nama_user', FILTER_SANITIZE_STRING);
          $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
          $k_password = filter_input(INPUT_POST, 'k_password', FILTER_SANITIZE_STRING);
          $level = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_STRING);
          $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

          if ($k_password !== $password) {
              $_SESSION['error'] = 'Konfirmasi password tidak sama dengan inputan password.';
              header('Location: user_edit.php?id_user='."'".$id_user."'".'');
          } elseif (!preg_match('/^[a-z0-9]+(?:[_-][a-z0-9]+)*$/', $username)) {
              $_SESSION['error'] = 'Username yang Anda masukkan tidak sesuai dengan format. Pastikan username tidak mengandung spasi, garis bawah di depan atau belakang.';
              header('Location: user_edit.php?id_user='."'".$id_user."'".'');
          } elseif (!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
              $_SESSION['error'] = 'Password yang Anda masukkan tidak sesuai dengan format.';
              header('Location: user_edit.php?id_user='."'".$id_user."'".'');
          } else {
              $hash_pass = password_hash($password, PASSWORD_DEFAULT, ['cost'=>10]);

              $sql = "UPDATE tb_user SET username='$username', nama_user='$nama_user', password='$hash_pass', level='$level', status='$status' WHERE id_user='$id_user'";
              $query = mysqli_query($db, $sql);

              if ($query) {
                $_SESSION['success'] = 'Data User berhasil diperbarui.';
                header('Location: user.php');
              } else {
                $_SESSION['error'] = 'Data User gagal ditambahkan.';
                header('Location: user_edit.php');
              }
          }
      } else {
        header('Location: user.php');
      }
?>
<?php
}
?>