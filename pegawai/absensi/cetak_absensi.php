<?php include_once("../../route.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Laporan Absensi Bulanan</title>
	<link rel="stylesheet" href="bootstrap-custom.min.css" />
	<style>
		@font-face {
		  font-family: "fontawesome";
		  src: url("../../assets/fonts/FontAwesome.otf");
		}

		body {font-family: "fontawesome";}

		thead {background-color: #F2F4F5;}

		#header-lap .head-kanan,
		#header-lap .head-kiri {
			display: inline-block;
			vertical-align: middle;
		}

		#header-lap > center > hr {
			margin-top: 8px;
			border: double 1px black;
		}

		#header-lap h3 {
			font-size: 18px;
			margin-bottom: 9px;
		}
		#header-lap h2 {
			font-size: 23px;
			margin-top: 5px;
		}
		#header-lap p {
			font-size: 17px;
			font-weight: bold;
		}
	</style>
</head>
<body onload="window.print()">
	<?php include_once("$docs/function.php"); ?>
	<div id="header-lap">
		<center>
			<h3><b>REKAPITULASI KEHADIRAN PEGAWAI NEGERI SIPIL</b></h3>
			<h2><b>PEM. PROV KAL-SEL SEKRETARIAT DAERAH</b></h2>
			<p>BULAN : <?=strtoupper($_GET['bln_name'])?> TAHUN <?=$_GET['thn']?></p>
		</center>
	</div>
	<p></p>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th width="40">No.</th>
				<th>NIP / Nama</th>
				<th>Jumlah</th>
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
		include_once("$docs/database/koneksi.php");
		//mengambil data pegawai
		$sql = $db->prepare("SELECT id_pegawai, nip, nama FROM pegawai WHERE status != :status");
		$sql->execute(array(":status" => "Pindah"));
		//mengambil jumlah hadir, izin, sakit, cuti, tl, dan tanpa kabar dari tb_absensi berdasarkan
		//tgl dan id pegawai
		$sql_jml = $db->prepare("SELECT id_absen FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");
		$sql_hadir = $db->prepare("SELECT SUM(hadir) as hadir FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");
		$sql_izin = $db->prepare("SELECT SUM(izin) as izin FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");
		$sql_sakit = $db->prepare("SELECT SUM(sakit) as sakit FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");
		$sql_cuti = $db->prepare("SELECT SUM(cuti) as cuti FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");
		$sql_tl = $db->prepare("SELECT SUM(tl) as tl FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");
		$sql_tk = $db->prepare("SELECT SUM(tanpa_kabar) as tk FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");
		$bln_index = (strlen($_GET['bln_index']) == 1) ? "0".$_GET['bln_index'] : $_GET['bln_index'];

		if ($sql->rowCount() > 0) {
			$no = 1;
			while ($data = $sql->fetch(PDO::FETCH_OBJ)) {

				$sql_jml->execute(array(":tgl" => "%$_GET[thn]-$bln_index%", ":id_pgw" => $data->id_pegawai));
				$sql_hadir->execute(array(":tgl" => "%$_GET[thn]-$bln_index%", ":id_pgw" => $data->id_pegawai));
				$sql_izin->execute(array(":tgl" => "%$_GET[thn]-$bln_index%", ":id_pgw" => $data->id_pegawai));
				$sql_sakit->execute(array(":tgl" => "%$_GET[thn]-$bln_index%", ":id_pgw" => $data->id_pegawai));
				$sql_cuti->execute(array(":tgl" => "%$_GET[thn]-$bln_index%", ":id_pgw" => $data->id_pegawai));
				$sql_tl->execute(array(":tgl" => "%$_GET[thn]-$bln_index%", ":id_pgw" => $data->id_pegawai));
				$sql_tk->execute(array(":tgl" => "%$_GET[thn]-$bln_index%", ":id_pgw" => $data->id_pegawai));
				$hadir = $sql_hadir->fetch(PDO::FETCH_OBJ);
				$izin = $sql_izin->fetch(PDO::FETCH_OBJ);
				$sakit = $sql_sakit->fetch(PDO::FETCH_OBJ);
				$cuti = $sql_cuti->fetch(PDO::FETCH_OBJ);
				$tl = $sql_tl->fetch(PDO::FETCH_OBJ);
				$tk = $sql_tk->fetch(PDO::FETCH_OBJ);

				echo "
				<tr>
					<td>$no</td>
					<td>$data->nama<br>$data->nip</td>
					<td align='center'>".$sql_jml->rowCount()."</td>
					<td align='center'>$hadir->hadir</td>
					<td align='center'>$izin->izin</td>
					<td align='center'>$sakit->sakit</td>
					<td align='center'>$cuti->cuti</td>
					<td align='center'>$tl->tl</td>
					<td align='center'>$tk->tk</td>
				</tr>
				";
				$no++;
			}

		} else {
			echo "<tr><td colspan='9' align='center'><b>Data tidak ditemukan!</b></td></tr>";
		}
		//tutup koneksi db
		$sql = 0;
		$sql_jml = 0;
		$sql_hadir = 0;
		$sql_izin = 0;
		$sql_sakit = 0;
		$sql_cuti = 0;
		$sql_tl = 0;
		$sql_tk = 0;
		?>
		</tbody>
	</table>

	<?php include_once("js.php"); ?>
</body>
</html>