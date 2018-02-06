<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Absensi</title>
	<?php include_once("css.php"); ?>
</head>
<body onload="window.print()">
	<div class="header-lap">
		<center>
			<h3>PEMERINTAH PROVINSI KALIMANTAN SELATAN</h3>
			<h2>SEKRETARIAT DAERAH</h2>
			<p>Laporan Absensi Tanggal <?=indo_date($_GET['tgl'])?></p>
			<hr>
		</center>
	</div>
	<p></p>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="40">#</th>
				<th>NIP & Nama</th>
				<th>Hadir</th>
				<th>Izin</th>
				<th>Sakit</th>
				<th>Cuti</th>
				<th>Tugas Luar</th>
				<th>Tanpa Kabar</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$no = 1;
		while ($unit = $sql->fetch(PDO::FETCH_OBJ)) {
			echo "<tr><td colspan='8'>$unit->unit_kerja</td></tr>";
			$sql_pgw->execute(array(":tgl" => $_GET['tgl'], ":status" => "Pindah", ":unit" => $unit->id_unit));
			while ($data = $sql_pgw->fetch(PDO::FETCH_OBJ)) {
				$hadir = (!empty($data->hadir)) ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>";
				$izin = (!empty($data->izin)) ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>";
				$sakit = (!empty($data->sakit)) ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>";
				$cuti = (!empty($data->cuti)) ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>";
				$tl = (!empty($data->tl)) ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>";
				$tk = (!empty($data->tanpa_kabar)) ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>";
				echo "
				<tr>
					<td>$no</td>
					<td>$data->nama<br>$data->nip</td>
					<td align='center'>$hadir</td>
					<td align='center'>$izin</td>
					<td align='center'>$sakit</td>
					<td align='center'>$cuti</td>
					<td align='center'>$tl</td>
					<td align='center'>$tk</td>
				</tr>
				";
				$no++;
			}
		}
		//tutup koneksi db
		$sql = 0;
		$sql_pgw = 0;
		$db = 0;
		?>
		</tbody>
	</table>

	<?php include_once("js.php"); ?>
</body>
</html>