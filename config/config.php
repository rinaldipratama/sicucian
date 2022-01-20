<?php

date_default_timezone_set("Asia/Jakarta");

$server = "localhost";
$user = "rinaldi";
$password = '3yJaNSK$P!3b!W7PbUtD';
$nama_database = "si_cucian";

$db = mysqli_connect($server, $user, $password, $nama_database);

if( !$db ){
    die("Gagal terhubung dengan database: " . mysqli_connect_error());
}

?>