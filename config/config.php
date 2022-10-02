<?php

date_default_timezone_set("Asia/Jakarta");

$server = "localhost";
$user = "root";
$password = '';
$nama_database = "si_cucian";

$db = mysqli_connect($server, $user, $password, $nama_database);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>
