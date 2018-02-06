<?php
if (isset($_POST['id_cuti'])) {
	include_once("../../database/koneksi.php");
	$sql = $db->prepare("SELECT * FROM cuti WHERE id_cuti = :id");
	$sql->execute([':id' => $_POST['id_cuti']]);
	$data = $sql->fetch(PDO::FETCH_OBJ);

	$arr = array(
		'jenis' => $data->jenis_surat,
		'hari' => $data->hari,
		'tgl_mulai' => $data->tgl_mulai,
		'tgl_selesai' => $data->tgl_selesai,
		'alamat' => $data->alamat
		);
	echo json_encode($arr);
}

if (isset($_POST['hari']) && isset($_POST['mulai'])) {
	$hari = (86400 * ($_POST['hari'] - 1));
	$day  = ($hari >= 0) ? $hari : 0;
	$time = strtotime($_POST['mulai']) + $day;
	echo date("Y-m-d", $time);
}

if (isset($_POST['cuti_thn_pejabat'])) {
	session_start();
	//buat session id cuti
	$_SESSION['id_cuti'] = $_POST['cuti_thn_pejabat'];
	if ((int)$_SESSION['id_cuti'] > 0) {
		echo "Sukses";
	} else {
		echo "Gagal";
	}
}
?>