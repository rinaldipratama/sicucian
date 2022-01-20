<?php

$table = 'tb_pelanggan';
$primaryKey = 'kode_pelanggan';

if (!( ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
  exit('No direct script access allowed');
} else {
  $columns = array(
    array('db' => 'kode_pelanggan', 'dt' => 'kode_pelanggan'),
    array('db' => 'nama', 'dt' => 'nama'),
    array('db' => 'tipe_mobil', 'dt' => 'tipe_mobil'),
    array('db' => 'nopol', 'dt' => 'nopol'),
    array('db' => 'alamat', 'dt' => 'alamat'),
    array('db' => 'telepon', 'dt' => 'telepon'),
    array('db' => 'created_at', 'dt' => 'created_at', 'formatter' => function ($created_at)
    {
        return date('d-m-Y H:i:s', strtotime($created_at));
    }),
    array(
      'db' => 'kode_pelanggan',
      'dt' => 'action',
      'formatter' => function($kode_pelanggan) {
        return '<a href="pelanggan_edit.php?kode_pelanggan='.$kode_pelanggan.'" class="btn btn-success mb-1"><i class="fa fa-fw fa-edit"></i></i> Edit</a>
        <a onclick="return confirmDialog();" href="pelanggan_delete.php?kode_pelanggan='.$kode_pelanggan.'" class="btn btn-danger mb-1"><i class="fa fa-fw fa-trash"></i> Delete</a>';   
      }
    )
  );

  $sql_details = [
    'user' => 'root',
    'pass' => '',
    'db' => 'si_cucian',
    'host' => 'localhost'
  ];

  require('config/ssp.class.php');

  echo json_encode(
    SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, NULL, NULL)
  );
}

