<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laporan Inventaris Kendaraan</title>
	<?php include_once("css.php"); ?>
</head>
<body onload="window.print()">
	<header>
		<h3>LAPORAN INVENTARIS KENDARAAN<br>SEKRETARIAT DAERAH PROV. KALSEL TAHUN 2016</h3>
		<hr style="border-color: black;">
	</header>
	<br>

	<table>
		<tr>
			<td>PROVINSI</td>
			<td>:</td>
			<td>KALIMANTAN SELATAN</td>
		</tr>
		<tr>
			<td width="180">KAB / KOTA</td>
			<td>:</td>
			<td>KOTA BANJARBARU</td>
		</tr>
		<tr>
			<td>BIDANG</td>
			<td>:</td>
			<td>SEKRETARIAT DAERAH</td>
		</tr>
		<tr>
			<td>UNIT ORGANISASI</td>
			<td>:</td>
			<td>SEKRETARIAT DAERAH</td>
		</tr>
		<tr>
			<td>SUB UNIT ORGANISASI</td>
			<td>:</td>
			<td><?=$_GET['sub_unit']?></td>
		</tr>
		<tr>
			<td>U P B</td>
			<td>:</td>
			<td><?=$_GET['upb']?></td>
		</tr>
	</table>
	<br>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No.</th>
				<th>Kode Kendaraan</th>
				<th>Jenis /<br>Nama Kendaraan</th>
				<th>Merk</th>
				<th>Cara Peroleh</th>
				<th>Tahun<br>Pembuatan<br>/ Pembelian</th>
				<th>No. Rangka</th>
				<th>No. Polisi</th>
				<th>No. BPKB</th>
				<th>Keadaan</th>
				<th>Harga</th>
				<th>Keterangan</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$sql = $db->prepare("SELECT * FROM kendaraan WHERE sub_unit = :sub AND upb = :upb");
			$sql->execute(array(":sub" => $_GET['sub_unit'], ":upb" => $_GET['upb']));
			if ($sql->rowCount() > 0) {
				while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
					$thn = ($data->tahun!="0000") ? $data->tahun : "-";
					echo "
					<tr>
						<td align='center'>$no.</td>
						<td align='center'>$data->kode_kendaraan</td>
						<td align='center'>$data->nama</td>
						<td align='center'>$data->merk</td>
						<td align='center'>$data->cara_perolehan</td>
						<td align='center'>$thn</td>
						<td align='center'>$data->no_rangka</td>
						<td align='center'>$data->no_polisi</td>
						<td align='center'>$data->no_bpkb</td>
						<td align='center'>$data->keadaan</td>
						<td align='center'>$data->harga</td>
						<td align='center'>$data->ket</td>
					</tr>
					";
					$no++;
				}
			} else {
				echo "
				<tr>
					<td colspan='12' align='center'>Data kosong!</td>
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