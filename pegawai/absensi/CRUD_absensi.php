<?php
include_once("../../route.php");
include_once("$docs/database/koneksi.php");
include_once("$docs/function.php");

if (isset($_POST['del_tgl'])) {
	if ($_SESSION['level'] != "Administrator") {
		echo "Warning";
	} else {
		//proses delete data berdasarkan tanggal
		$sql = $db->prepare("DELETE FROM absensi WHERE tgl = :tgl");
		$sql->execute(array(":tgl" => $_POST['del_tgl']));
		//cek apakah proses delete data sukses atau gagal
		if ($sql->rowCount() > 0) {
			echo "Sukses";
		} else {
			echo "Gagal";
		}
	}
}

if (isset($_POST['ajax'])) {
	//cek apakah tgl yg hendak di input sdh ada atau blum, jika sdh ada maka hentikan proses
	$cek_tgl = $db->prepare("SELECT tgl FROM absensi WHERE tgl = :tgl");
	$cek_tgl->execute(array(":tgl" => $_POST['tgl']));

	if ($cek_tgl->rowCount() > 0) {
		echo json_encode(['Ada' => 'Ada']);
	} else {

		//proses insert data absensi
		$sql = $db->prepare("INSERT INTO absensi VALUES(:id, :id_pegawai, :hari, :tgl, :hadir, :izin, :sakit, :cuti, :tl, :tk)");
		$sql_pgw = $db->prepare("SELECT id_pegawai FROM pegawai WHERE status != :status");
		$sql_pgw->execute(array(":status" => "Pindah"));

		while ($pgw = $sql_pgw->fetch(PDO::FETCH_OBJ)) {
			$sql->execute(array(
				":id" => null,
				":id_pegawai" => $pgw->id_pegawai,
				":hari" => hari($_POST['tgl']),
				":tgl" => $_POST['tgl'],
				":hadir" => 0,
				":izin" => 0,
				":sakit" => 0,
				":cuti" => 0,
				":tl" => 0,
				":tk" => 0,
				));
		}

		if ($sql->rowCount() > 0) {
			$stat = "Sukses";
		} else {
			$stat = "Gagal";
		}

		echo json_encode(['status' => $stat, 'tgl' => $_POST['tgl']]);

		//tutup koneksi db
		$sql = 0;
		$sql_pgw = 0;
		unset($sql); //hapus variable $sql

	}
}

if (isset($_POST['absen']) && isset($_POST['id_absen'])) {
	if ($_SESSION['level'] != "Administrator") {
		echo "Warning";
	} else {
		switch ($_POST['absen']) {
			case 'Hadir':
				$hadir = 1; $izin = 0; $sakit = 0; $cuti = 0; $tl = 0; $tk = 0;
				break;
			case 'Izin':
				$hadir = 0; $izin = 1; $sakit = 0; $cuti = 0; $tl = 0; $tk = 0;
				break;
			case 'Sakit':
				$hadir = 0; $izin = 0; $sakit = 1; $cuti = 0; $tl = 0; $tk = 0;
				break;
			case 'Cuti':
				$hadir = 0; $izin = 0; $sakit = 0; $cuti = 1; $tl = 0; $tk = 0;
				break;
			case 'TL':
				$hadir = 0; $izin = 0; $sakit = 0; $cuti = 0; $tl = 1; $tk = 0;
				break;
			case 'TK':
				$hadir = 0; $izin = 0; $sakit = 0; $cuti = 0; $tl = 0; $tk = 1;
				break;
			
			default:
				$hadir = 0; $izin = 0; $sakit = 0; $cuti = 0; $tl = 0; $tk = 0;
				break;
		}

		//proses update data absensi pegawai
		$sql = $db->prepare("UPDATE absensi SET hadir = :hadir, izin = :izin, sakit = :sakit, cuti = :cuti, tl = :tl, tanpa_kabar = :tk WHERE id_absen = :id");
		$sql->execute(array(
			":id" => $_POST['id_absen'],
			":hadir" => $hadir,
			":izin" => $izin,
			":sakit" => $sakit,
			":cuti" => $cuti,
			":tl" => $tl,
			":tk" => $tk,
			));
		if ($sql->rowCount() == 1) {
			echo "Sukses";
		} else {
			echo "Gagal";
		}
		$sql = 0; //tutup koneksi db
	}
}
?>