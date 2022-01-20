<?php

session_start();

require_once 'config/config.php';

// cek session
if (isset($_SESSION['loggedin'])) {
  if ($_SESSION['level'] === 'Administrator') {
    header("Location: ./dashboard.php");
  } elseif ($_SESSION['level'] === 'Kasir') {
    header("Location: ./home.php");
  }
  die();
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="assets/img/favicon_carwash.ico">
  <title>Sistem Informasi Cucian - PT Mauza Utama Mobil</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" type="text/css" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" type="text/css" href="assets/css/AdminLTE.min.css">
  <style type="text/css">
    body {
            background: #fff;
        }
        .bg::before {
            content: '';
            background-image: url('./assets/img/background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            position: absolute;
            z-index: -1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            opacity: 0.15;
            filter:alpha(opacity=15);
            height:100%;
            width:100%;
        }
  </style>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Google Font -->
<link rel="stylesheet" type="text/css" href="assets/css/fontsgoogleapis.css">
</head>
<body class="hold-transition login-page shadow-3 bg">
  <div class="login-box">
      <div class="login-box-body">
    <div class="login-logo">
      <img width="100px" title="SI Cucian" src="assets/img/carwash_logo.png" style="margin: 10px auto;vertical-align:middle;" />
      <div style="margin:10px;font-size:18px;">
        <strong>Log In</strong>
      </div>
    </div>
    <!-- /.login-logo -->

    <div class="login-box-msg">to continue to SI Cucian</div>

    <?php

    if (isset($_POST['login'])) {

      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

      $sql = "SELECT * FROM tb_user WHERE username='$username'";
      $query = mysqli_query($db, $sql);
      $cek = mysqli_num_rows($query);
      $data  = mysqli_fetch_array($query);

      // jika user terdaftar
      if ($cek > 0) {
        // verifikasi password
        if (password_verify($password, $data["password"])) {
            $_SESSION["loggedin"] = TRUE;
            $_SESSION["id_user"] = $data["id_user"];
            $_SESSION["username"] = $data["username"];
            $_SESSION["nama_user"] = $data["nama_user"];
            $_SESSION["level"] = $data["level"];
            $_SESSION["status"] = $data["status"];
            $_SESSION["created_at"] = $data["created_at"];

            $date = date('Y-m-d H:i:s');
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $s_username = $_SESSION['username']; 
            mysqli_query($db, "UPDATE tb_user SET last_logged_in = '$date', ip_address = '$ip_address' WHERE username = '$s_username'");

            // login sukses, alihkan ke halaman dashboard atau home
            if ($data["level"] === 'Administrator') {
              header("Refresh: 0; url=./dashboard.php");
            } elseif ($data["level"] === 'Kasir') {
              header("Refresh: 0; url=./home.php");
            }
            die();
        }  else {
            //session error
            $_SESSION['errLog'] = 'Username dan Password yang Anda masukkan salah, silahkan coba lagi.';
            header("Refresh: 0; url=./");
            die();
        } 
      } else {
          //session error
          $_SESSION['errLog'] = 'Username dan Password yang Anda masukkan salah, silahkan coba lagi.';
          header("Refresh: 0; url=./");
          die();
      }
    }

    ?>

    <form action="" method="post">
      <?php
        if (isset($_SESSION['errLog'])) {
          $errLog = $_SESSION['errLog'];
        ?>
          <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?=$errLog;?>
          </div>
      <?php
          unset($_SESSION['errLog']);
      }
      ?>
      <div class="form-group has-feedback">
        <input type="username" class="form-control" name="username" placeholder="Username" autofocus="autofocus">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Log In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <br />

  </div>
  <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
  </html>
