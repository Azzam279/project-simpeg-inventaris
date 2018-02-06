<?php
if (isset($_POST)) {
	include_once("../../database/koneksi.php");
	//proses perbarui pajak kendaraan
	$sql = $db->prepare("UPDATE kendaraan SET tgl_pajak = :tgl WHERE id_kendaraan = :id");
	$tgl_pajak = strtotime((date('Y')+1)."-$_POST[bln]");
	$sql->execute(array(":tgl" => $tgl_pajak, ":id" => $_POST['id']));
	if ($sql->rowCount() == 1) {
		echo "Sukses";
	} else {
		echo "Gagal";
	}
	$sql = 0;
}
?>