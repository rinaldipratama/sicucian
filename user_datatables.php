<?php

$table = 'tb_user';
$primaryKey = 'id_user';

if (!( ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
  exit('No direct script access allowed');
} else {
  $columns = array(
    array('db' => 'username', 'dt' => 'username'),
    array('db' => 'nama_user', 'dt' => 'nama_user'),
    array('db' => 'level', 'dt' => 'level'),
    array('db' => 'status', 'dt' => 'status'),
    array(
      'db' => 'id_user',
      'dt' => 'action',
      'formatter' => function($id_user) {
        return '<a href="user_edit.php?id_user='."'".$id_user."'".'" class="btn btn-success mb-1"><i class="fa fa-fw fa-edit"></i>Edit</a>
                <a onclick="return confirmDialog();" href="user_delete.php?id_user='."'".$id_user."'".'" class="btn btn-danger mb-1"><i class="fa fa-fw fa-trash"></i>Delete</a>';   
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

