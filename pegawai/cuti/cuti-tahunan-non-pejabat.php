<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cetak Surat Cuti</title>
	<link type="text/css" rel="stylesheet" href="../../assets/css/theme-1/bootstrap.css" />
	<style>
		header #head-kiri {
			display: inline-block;
			vertical-align: top;
			margin-right: 12px;
		}
		header #head-kanan {
			display: inline-block;
			text-align: center;
			vertical-align: top;
		}
		header #head-kanan h3 {
			margin-top: 0;
			margin-bottom: 0;
		}
		header #head-kanan h2 {
			margin-top: 5px;
			margin-bottom: 5px;
		}
		header hr {
			border: solid 1px black;
			margin-top: 0;
		}
	</style>
</head>
<body>
	<header>
		<center>
			<div id="head-kiri">
				<img src="../../images/logo-surat.png" alt="" class="img-responsive">
			</div>
			<div id="head-kanan">
				<h3><b>PEMERINTAH PROVINSI KALIMANTAN SELATAN</b></h3>
				<h2><b>SEKRETARIAT DAERAH</b></h2>
				<p style="margin-bottom: 0;"><small>Website : http/www.kalsel.go.id E-mail pemprop@kalsel.go.id</small></p>
				<p style="margin-bottom: 0; font-size: 18px"><b>BANJARBARU</b></p>
			</div>
			<div class="clearfix"></div>
			<hr>
		</center>
	</header>

	<?php
	include_once("../../database/koneksi.php");
	include_once("../../function.php");
	session_start();
	$sql = $db->prepare("SELECT * FROM cuti WHERE id_cuti = :id");
	$sql->execute([':id' => $_SESSION['id_cuti']]);
	$cuti = $sql->fetch(PDO::FETCH_OBJ);
	unset($sql); //hapus var $sql
	$sql = $db->prepare("SELECT * FROM pegawai, golongan, unit_kerja, pangkat, jabatan WHERE pegawai.no_golongan = golongan.id_golongan AND pegawai.unit_kerja = unit_kerja.id_unit AND pegawai.no_pangkat = pangkat.id_pangkat AND pegawai.no_jabatan = jabatan.id_jabatan AND pegawai.id_pegawai = :id");
	$sql->execute([':id' => $_SESSION['id']]);
	$data = $sql->fetch(PDO::FETCH_OBJ);
	$sql = 0; //tutup koneksi db
	?>

	<article>
		<div class="row" style="font-size: 11px;">
			<div class="col-xs-6 col-xs-offset-6">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Banjarbaru, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?=indo_date($cuti->tgl_surat)?>
			</div>
		</div>
		<div class="row" style="font-size: 11px;">
			<div class="col-xs-6">
				Perihal : <u>Permohonan Cuti Tahunan</u>
			</div>
			<div class="col-xs-6">
				<b>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepada Yth<br>
			        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kepala <?=ucwords(strtolower($data->unit_kerja))?> Setda Prov.Kalsel<br>
			  		<p></p>
			        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;di – <br>
                  	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Banjarbaru
				</b>
			</div>
		</div>
		<br>
		<div class="row" style="font-size: 11px;">
			<div class="col-xs-10 col-xs-offset-2">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan dibawah ini :<br>
				<table>
					<tr>
						<td>Nama</td>
						<td width="80" align="right" style="padding-right: 10px;">:</td>
						<td><?=$data->nama?></td>
					</tr>
					<tr>
						<td>NIP</td>
						<td align="right" style="padding-right: 10px;">:</td>
						<td><?=$data->nip?></td>
					</tr>
					<tr>
						<td>Pangkat / Gol</td>
						<td align="right" style="padding-right: 10px;">:</td>
						<td><?=$data->pangkat?> ( <?=$data->golongan?> )</td>
					</tr>
					<tr>
						<td>Jabatan</td>
						<td align="right" style="padding-right: 10px;">:</td>
						<td><?=$data->jabatan?></td>
					</tr>
					<tr>
						<td>Unit Kerja</td>
						<td align="right" style="padding-right: 10px;">:</td>
						<td><?=ucwords(strtolower($data->unit_kerja))?> Setda Prov.Kalimantan Selatan</td>
					</tr>
				</table>
				<br>
				<p align="justify">
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dengan  ini  mengajukan Cuti Tahunan untuk Tahun <?=date('Y')?>  Tahap I ( pertama ) selama <?=$cuti->hari?> hari kerja terhitung  mulai   <?=indo_date($cuti->tgl_mulai)?> s.d <?=indo_date($cuti->tgl_selesai)?> . Selama menjalankan cuti tersebut alamat saya adalah di <?=$cuti->alamat?>.
				</p>
				<p align="justify">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian permohonan ini saya buat untuk dapat dipertimbangkan sebagaimana mestinya.</p><br>
				<div class="pull-right">
					<center>
						Hormat Saya<br>
						<br><br><br>
						<?=$data->nama?><br>
	                    <?=$data->pangkat?><br>
                    	NIP. <?=$data->nip?><br>
					</center>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="row" style="font-size: 10px;">
			<div class="col-xs-12">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th width="300"><center>CATATAN PEJABAT<br>KEPEGAWAIAN</center></th>
							<th style="vertical-align: middle;"><center>PERTIMBANGAN ATASAN LANGSUNG</center></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td rowspan="5">
								Cuti yang telah diambil dalam tahun yang bersangkutan :
								<ol>
									<li><b>Cuti Tahunan</b></li>
									<li>Cuti Besar</li>
									<li>Cuti Hamil / Melahirkan</li>
									<li>Cuti karena alasan penting</li>
									<li>Cuti lain-lain</li>
								</ol>
							</td>
						</tr>
						<tr>
							<td colspan="2" align="center">KEPALA BAGIAN KELEMBAGAAN</td>
						</tr>
						<tr>
							<td colspan="2"><br><br><br><br></td>
						</tr>
						<tr>
							<td colspan="2" align="center">KEPUTUSAN PEJABAT<br>YANG BERWENANG MEMBERIKAN CUTI</td>
						</tr>
						<tr>
							<td colspan="2"><br><br><br><br></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</article>

	<script src="../../assets/js/libs/jquery/jquery-1.11.2.min.js"></script>
	<script src="../../assets/js/libs/bootstrap/bootstrap.min.js"></script>
</body>
</html>