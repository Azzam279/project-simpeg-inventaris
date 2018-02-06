<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laporan Inventaris Barang</title>
	<?php include_once("css.php"); ?>
</head>
<body onload="window.print()">
	<header>
		<h3>LAPORAN INVENTARIS BARANG<br>SEKRETARIAT DAERAH PROV. KALSEL TAHUN 2016</h3>
		<hr style="border-color: black;">
	</header>
	<br>

	<table>
		<tr>
			<td width="130">KAB / KOTA</td>
			<td>:</td>
			<td>KOTA BANJARBARU</td>
		</tr>
		<tr>
			<td>PROVINSI</td>
			<td>:</td>
			<td>KALIMANTAN SELATAN</td>
		</tr>
		<tr>
			<td>UNIT</td>
			<td>:</td>
			<td>SEKRETARIAT DAERAH PROVINSI</td>
		</tr>
		<tr>
			<td>SATUAN KERJA</td>
			<td>:</td>
			<td><?=$_GET['sk_name']?></td>
		</tr>
		<tr>
			<td>RUANGAN</td>
			<td>:</td>
			<td><?=$_GET['room']?></td>
		</tr>
	</table>
	<br>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th rowspan="2">No.</th>
				<th rowspan="2">Jenis Barang /<br>Nama Barang</th>
				<th rowspan="2">Merk /<br>Model</th>
				<th rowspan="2">Nomor<br>Seri Pabrik</th>
				<th rowspan="2">Ukuran</th>
				<th rowspan="2">Bahan</th>
				<th rowspan="2">Tahun Pembuatan /<br>Pembelian</th>
				<th rowspan="2">Nomor<br>Kode Barang</th>
				<th rowspan="2">Jumlah<br>Barang<br>Register</th>
				<th colspan="3">Keadaan Barang</th>
				<th rowspan="2">Keterangan</th>
			</tr>
			<tr>
				<th>Baik<br>(B)</th>
				<th>Kurang Baik<br>(KB)</th>
				<th>Rusak Berat<br>(RB)</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$sql = $db->prepare("SELECT * FROM barang, unit_kerja WHERE barang.satuan_kerja = unit_kerja.id_unit AND barang.satuan_kerja = :sk AND barang.ruangan = :room");
			$sql->execute(array(":sk" => $_GET['sk'], ":room" => $_GET['room']));
			if ($sql->rowCount() > 0) {
				while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
					$thn = ($data->thn_buat_beli!="0000") ? $data->thn_buat_beli : "-";
					echo "
					<tr>
						<td align='center'>$no.</td>
						<td>$data->nm_barang</td>
						<td align='center'>$data->model</td>
						<td align='center'>$data->sn_pabrik</td>
						<td align='center'>$data->ukuran</td>
						<td align='center'>$data->bahan</td>
						<td align='center'>$thn</td>
						<td align='center'>$data->kode_barang</td>
						<td align='center'>$data->jumlah_barang</td>
						<td align='center'>$data->baik</td>
						<td align='center'>$data->kurangbaik</td>
						<td align='center'>$data->rusakberat</td>
						<td align='center'>$data->ket</td>
					</tr>
					";
					$no++;
				}
			} else {
				echo "
				<tr>
					<td colspan='13' align='center'>Data kosong!</td>
				</tr>
				";
			}
			$sql = 0;
			?>
		</tbody>
	</table>

	<?php include_once("js.php"); ?>
</body>
</html>