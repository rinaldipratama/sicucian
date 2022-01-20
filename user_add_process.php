<?php
    session_start();

    require_once 'config/config.php';

    if (empty($_SESSION['loggedin'])) {
        header("Location: ./");
        die();
    } else {
      if(isset($_POST['simpan'])){
          $username = strtolower(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
          $nama_user = filter_input(INPUT_POST, 'nama_user', FILTER_SANITIZE_STRING);
          $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
          $k_password = filter_input(INPUT_POST, 'k_password', FILTER_SANITIZE_STRING);
          $level = filter_input(INPUT_POST, 'level', FILTER_SANITIZE_STRING);
          $status = filter_input(INPUT_POST, 'status', FILTER_SANITIZE_STRING);

          $sql = mysqli_query($db, "SELECT * FROM tb_user WHERE username = '$username'");
          $check = mysqli_num_rows($sql);

          if ($k_password !== $password) {
              $_SESSION['error'] = 'Konfirmasi password tidak sama dengan inputan password.';
              header('Location: user_add.php');
          } elseif (!preg_match('/^.{6,}[a-z0-9]+(?:[_-][a-z0-9]+)*$/', $username)) {
              $_SESSION['error'] = 'Username yang Anda masukkan tidak sesuai dengan format.';
              header('Location: user_add.php');
          } elseif ($check > 0) {
              $_SESSION['error'] = 'Username sudah ada.';
              header('Location: user_add.php');
          } elseif (!preg_match('/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/', $password)) {
              $_SESSION['error'] = 'Password yang Anda masukkan tidak sesuai dengan format.';
              header('Location: user_add.php');
          } else {
              $hash_pass = password_hash($password, PASSWORD_DEFAULT, ['cost'=>10]);

              $sql = "INSERT INTO tb_user (username, nama_user, password, level, status) VALUE ('$username', '$nama_user', '$hash_pass', '$level', '$status')";
              $query = mysqli_query($db, $sql);
              
              if ($query) {
                  $_SESSION['success'] = 'Data User berhasil ditambahkan.';
                  header('Location: user.php');
              } else {
                  $_SESSION['error'] = 'Data User gagal ditambahkan.';
                  header('Location: user_add.php');
              }
          }
      } else {
        header('Location: user.php');
      }
?>
<?php
}
?>