<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laporan Pegawai Berdasarkan Golongan</title>
	<?php include_once("css.php"); ?>
</head>
<body onload="window.print()">
	<header>
		<h3>DAFTAR NOMINATIF PEGAWAI BERDASARKAN GOLONGAN<br>SEKRETARIAT DAERAH PROV. KALSEL TAHUN 2016</h3>
	</header>
	<br>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th>NO.</th>
				<th>NAMA LENGKAP<br>NIP / TEMPAT DAN TGL. LAHIR</th>
				<th>GOL. RUANG<br>T.M.T</th>
				<th>JABATAN TERAKHIR<br>T.M.T</th>
				<th>ESELON</th>
				<th>UNIT KERJA</th>
				<th>PENDIDIKAN UMUM<br>TERAKHIR</th>
				<th>DIKLAT<br>JABATAN<br>TERAKHIR</th>
				<th>MASA KERJA<br>JENIS KELAMIN<br>AGAMA<br>STATUS PEGAWAI</th>
				<th>USIA</th>
				<th>KETERANGAN</th>
			</tr>
		</thead>
		<tbody>
			<?php
			function umur($lahir) {
				$pecah = explode("/", $lahir);

				$tgl = intval($pecah['0']);
				$bln = intval($pecah['1']);
				$thn = $pecah['2'];

				$utahun = date("Y") - $thn;
				$ubulan = date("m") - $bln;
				$uhari = date("j") - $tgl;

				if($uhari < 0){
					$uhari = date("t",mktime(0,0,0,$bln-1,date("m"),date("Y"))) - abs($uhari); $ubulan = $ubulan - 1;
				}
					if($ubulan < 0){
					$ubulan = 12 - abs($ubulan); $utahun = $utahun - 1;
				}

				//$usia = $utahun.' Tahun '.$ubulan.' Bulan '.$uhari.' Hari';
				$usia = $utahun.' Tahun '.$ubulan.' Bulan';

				return $usia;
			}

			$no = 1;
			$sql = $db->prepare("SELECT * FROM pegawai, pangkat, jabatan, golongan, eselon, unit_kerja, agama WHERE pegawai.no_pangkat = pangkat.id_pangkat AND pegawai.no_jabatan = jabatan.id_jabatan AND pegawai.no_golongan = golongan.id_golongan AND pegawai.no_eselon = eselon.id_eselon AND pegawai.unit_kerja = unit_kerja.id_unit AND pegawai.no_agama = agama.id_agama AND pegawai.no_golongan = :no");
			$sql->execute(array(":no" => $_GET['id']));
			if ($sql->rowCount() > 0) {
				while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
					echo "
					<tr>
						<td>$no.</td>
						<td>$data->nama<br>$data->nip<br>$data->tmpt_lahir, $data->tgl_lahir</td>
						<td align='center'>$data->golongan<br>$data->tmt_golongan</td>
						<td>$data->jabatan<br>$data->tmt_jabatan</td>
						<td align='center'>$data->eselon</td>
						<td>$data->unit_kerja</td>
						<td>$data->pendidikan</td>
						<td align='center'>$data->diklat_jabatan</td>
						<td>$data->masa_kerja_thn Tahun $data->masa_kerja_bln Bulan<br>$data->jkl<br>$data->agama<br>$data->status</td>
						<td align='center'>".umur($data->tgl_lahir)."</td>
						<td>$data->ket</td>
					</tr>
					";
					$no++;
				}
			} else {
				echo "
				<tr>
					<td colspan='11' align='center'>Data kosong!</td>
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