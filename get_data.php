<?php 

if (!( ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')) {
    exit('No direct script access allowed');
} else {
	require_once 'config/config.php';

	if (isset($_GET['kode_pelanggan'])) {
		$kode_pelanggan = $_GET['kode_pelanggan'];

		$sql = "SELECT * FROM tb_pelanggan WHERE kode_pelanggan='$kode_pelanggan'";
		$query = mysqli_query($db, $sql);
      	$row = mysqli_fetch_assoc($query);

		if (mysqli_num_rows($query) > 0) {
			$callback = array(
				'status' => 'success',
				'tipe_mobil' => $row['tipe_mobil'],
				'nopol' => $row['nopol'] 
			);
		} else {
			$callback = array(
				'status' => 'failed'
			);
		}

		echo json_encode($callback);
	} elseif (isset($_GET['id_paket']) AND isset($_GET['id_paket2'])) {
		$id_paket = $_GET['id_paket'];
		$id_paket2 = $_GET['id_paket2'];

		$query = "SELECT * FROM tb_paket WHERE id_paket=? ORDER BY paket ASC";
		$data = $db->prepare($query);
		$data->bind_param("i", $id_paket);
		$data->execute();
		$res = $data->get_result();
		$row = $res->fetch_assoc();

		$query2 = "SELECT * FROM tb_paket WHERE id_paket=? ORDER BY paket ASC";
		$data2 = $db->prepare($query2);
		$data2->bind_param("i", $id_paket2);
		$data2->execute();
		$res2 = $data2->get_result();
		$row2 = $res2->fetch_assoc();

		if ($row2 < 1) {
			$result = $row['biaya'] + 0;

			$callback = array(
				'status' => 'success',
				'biaya' => 'Rp ' . number_format($result, 0, ",", ".")
			);
		} elseif ($row > 0 AND $row2 > 0) {
			$result = $row['biaya'] + $row2['biaya'];

			$callback = array(
				'status' => 'success',
				'biaya' => 'Rp ' . number_format($result, 0, ",", ".")
			);
		} else {
			$callback = array(
				'status' => 'failed'
			);
		}

		echo json_encode($callback);
	} else {
		header('Location: transaksi.php');
	}
}