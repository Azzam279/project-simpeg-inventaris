<?php
include_once("../../route.php");
include_once("$docs/database/koneksi.php");
include_once("$docs/function.php");
$sql = $db->prepare("SELECT * FROM unit_kerja");
$sql->execute();
$sql_pgw = $db->prepare("SELECT absensi.*, pegawai.id_pegawai, pegawai.nip, pegawai.nama FROM absensi, pegawai WHERE absensi.no_pegawai = pegawai.id_pegawai AND pegawai.unit_kerja = :unit AND absensi.tgl = :tgl AND pegawai.status != :status");
?>

<link rel="stylesheet" type="text/css" href="bootstrap-custom.min.css" />
<link rel="stylesheet" type="text/css" href="<?="$host/assets/css/font-awesome.min.css"?>" />
<style>
	@font-face {
		font-family: "fontawesome";
		src: url("../../assets/fonts/FontAwesome.otf");
	}

	/*body {
		font-family: fontawesome;
	}

	thead {background-color: #F2F4F5;}*/

	.header-lap hr {
		margin-top: 8px;
		border: double 1px black;
	}

	.header-lap h3 {
		font-size: 18px;
		margin-bottom: 9px;
		font-weight: bold;
	}
	.header-lap h2 {
		font-size: 23px;
		margin-top: 5px;
		font-weight: bold;
	}
	.header-lap p {
		font-size: 17px;
		font-weight: bold;
	}
</style>