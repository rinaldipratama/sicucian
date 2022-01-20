<?php

session_start();

  $table = 'view_transaksi';
  $primaryKey = 'id_transaksi';

  if (!( ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
    exit('No direct script access allowed');
  } else {
    $columns = array(
      array('db' => 'kode_pelanggan', 'dt' => 'kode_pelanggan'),
      array('db' => 'nama_pelanggan', 'dt' => 'nama_pelanggan'),
      array('db' => 'tipe_mobil', 'dt' => 'tipe_mobil'),
      array('db' => 'nopol', 'dt' => 'nopol'),
      array('db' => 'nama_user', 'dt' => 'nama_user'),
      array('db' => 'tanggal', 'dt' => 'tanggal', 'formatter' => function ($tanggal)
      {
        return date("d-m-Y", strtotime($tanggal));
      }),
      array('db' => 'created_at', 'dt' => 'created_at', 'formatter' => function ($created_at)
      {
        return date('d-m-Y H:i:s', strtotime($created_at));
      }),
      array(
        'db' => 'id_transaksi',
        'dt' => 'action',
        'formatter' => function($id_transaksi) {
          return '<a href="transaksi_edit.php?id_transaksi='.$id_transaksi.'" class="btn btn-success mb-1"><i class="fa fa-fw fa-edit"></i>Edit</a>
          <a onclick="return confirmDialog();" href="transaksi_delete.php?id_transaksi='.$id_transaksi.'" class="btn btn-danger mb-1"><i class="fa fa-fw fa-trash"></i>Delete</a>
          <a href="cetak.php?id_transaksi='.$id_transaksi.'" target="_blank" class="btn btn-warning mb-1"><i class="fa fa-fw fa-print"></i>Cetak</a>';   
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
      SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
    );
  }
