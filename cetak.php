<?php 
		
		require_once 'config/config.php';
		if (isset($_GET['id_transaksi'])) {
			$id_transaksi = $_GET['id_transaksi'];
			$query = mysqli_query($db, "SELECT * FROM view_transaksi WHERE id_transaksi = $id_transaksi");
			$query2 = mysqli_query($db, "SELECT * FROM view_transaksi_detail WHERE id_transaksi = $id_transaksi");
			$query3 = mysqli_query($db, "SELECT sum(harga_paket) as harga_paket FROM view_transaksi_detail WHERE id_transaksi = $id_transaksi");
			$query4 = mysqli_query($db, "SELECT * FROM view_transaksi_detail WHERE id_transaksi = $id_transaksi");

			if (mysqli_num_rows($query) > 0) {
				$data = mysqli_fetch_array($query);
				$data2 = mysqli_fetch_array($query2);
				$data3 = mysqli_fetch_array($query3);
				?>
				<title>Sistem Informasi Cucian - PT Mauza Utama Mobil</title>
				
				<body onload="window.print()">

					<table>
						<tbody>
							<tr>
								<td>PT. MAUZA AUTO MOBIL</td>
							</tr>
							<tr>
								<td>Jl. Duyung</td>
							</tr>
							<tr>
								<td>Telp 082137126442</td>
							</tr>
						</tbody>
					</table>


					<hr width="30%" align="left">

					<table>
						<tbody>
							<tr>
								<td>Kasir</td>
								<td>:</td>
								<td><?php echo $data['nama_user'] ?></td>
							</tr>
							<tr>
								<td>Kode Pelanggan</td>
								<td>:</td>
								<td><?php echo $data['kode_pelanggan'] ?></td>
							</tr>
							<tr>
								<td>Nama Pelanggan</td>
								<td>:</td>
								<td><?php echo $data['nama_pelanggan'] ?></td>
							</tr>
							<tr>
								<td>Tipe Mobil</td>
								<td>:</td>
								<td><?php echo $data['tipe_mobil'] ?></td>
							</tr>
							<tr>
								<td>NOPOL</td>
								<td>:</td>
								<td><?php echo $data['nopol'] ?></td>
							</tr>
							<tr>
								<td>Paket</td>
								<td>:</td>
							</tr>
							<?php while ($row = mysqli_fetch_array($query4)) { ?>
							<tr>
								<td><?php echo '- ' . $row['nama_paket'] . ' (Rp ' . number_format($row['harga_paket'], 2, ",", ".") . ')'; ?></td>
							</tr>
							<?php } ?>
							<tr>
								<td>Total</td>
								<td>:</td>
								<td><?php echo 'Rp ' . number_format($data3['harga_paket'], 2, ",", ".") ?></td>
							</tr>
							<tr>
								<td>Tunai</td>
								<td>:</td>
								<td><?php echo 'Rp ' . number_format($data2['bayar'], 2, ",", ".") ?></td>
							</tr>
							<tr>
								<td>Kembali</td>
								<td>:</td>
								<td><?php echo 'Rp ' . number_format($data2['bayar'] - $data3['harga_paket'], 2, ",", ".") ?>
								</td>
							</tr>
							<tr>
								<td>Tanggal</td>
								<td>:</td>
								<td><?php echo date("d-m-Y", strtotime($data['tanggal'])) ?></td>
							</tr>
						</tbody>
					</table>

				</body>
			<?php
			} else {
				header("Location: transaksi.php");
			} 
		} else {
			header("Location: transaksi.php");
		}
?>

<script>
		window.print();
		window.onfocus=function() {window.close();}
</script>


