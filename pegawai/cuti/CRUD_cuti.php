<?php
session_start();
include_once("../../database/koneksi.php");

if (isset($_POST['tipe'])) {
	if ($_POST['tipe'] == "input") {
		if (empty($_POST['jenis']) || empty($_POST['tgl_mulai']) || empty($_POST['tgl_selesai']) || empty($_POST['alamat']) || empty($_POST['hari']) || empty($_POST['tgl_surat']) || empty($_POST['type'])) {
			$info = "warning";
			$pesan = "Semua kolom input wajib diisi!";
		} else {
			//proses insert data
			$sql = $db->prepare("INSERT INTO cuti VALUES(:id, :no, :mulai, :selesai, :hari, :jenis, :alamat, :tipe, :tgl_surat)");
			$sql->execute(array(
				":id" => null,
				":no" => $_SESSION['id'],
				":mulai" => $_POST['tgl_mulai'],
				":selesai" => $_POST['tgl_selesai'],
				":hari" => $_POST['hari'],
				":jenis" => $_POST['jenis'],
				":alamat" => strip_tags($_POST['alamat']),
				":tipe" => $_POST['type'],
				":tgl_surat" => $_POST['tgl_surat']
				));
			//cek apakah proses insert data sukses atau gagal
			if ($sql->rowCount() == 1) {
				$info = "sukses";
				$pesan = "Data berhasil diinput.";
			} else {
				$info = "gagal";
				$pesan = "Data gagal diinput.";
			}
			$sql = 0;
		}

		echo json_encode(["info" => $info, "pesan" => $pesan]);
	}

	// if ($_POST['tipe'] == "edit") {
	// 	if (empty($_POST['jenis']) || empty($_POST['tgl_mulai']) || empty($_POST['tgl_selesai']) || empty($_POST['alamat']) || empty($_POST['hari'])) {
	// 		$info = "warning";
	// 		$pesan = "Semua kolom input wajib diisi!";
	// 	} else {
	// 		//proses insert data
	// 		$sql = $db->prepare("UPDATE cuti SET tgl_mulai = :mulai, tgl_selesai = :selesai, hari = :hari, jenis_surat = :jenis, alamat = :alamat WHERE id_cuti = :id");
	// 		$sql->execute(array(
	// 			":id" => $_POST['id_cuti'],
	// 			":mulai" => $_POST['tgl_mulai'],
	// 			":selesai" => $_POST['tgl_selesai'],
	// 			":hari" => $_POST['hari'],
	// 			":jenis" => $_POST['jenis'],
	// 			":alamat" => $_POST['alamat']
	// 			));
	// 		//cek apakah proses insert data sukses atau gagal
	// 		if ($sql->rowCount() == 1) {
	// 			$info = "sukses";
	// 			$pesan = "Data berhasil diedit.";
	// 		} else {
	// 			$info = "gagal";
	// 			$pesan = "Data gagal diedit.";
	// 		}
	// 		$sql = 0;
	// 	}

	// 	echo json_encode(["info" => $info, "pesan" => $pesan]);
	// }
}

if (isset($_POST['delete'])) {
	//cek apakah variable delete angka atau bukan, jika bukan maka hentikan proses
	if (is_numeric($_POST['delete'])) {
		//proses delete data
		$sql = $db->prepare("DELETE FROM cuti WHERE id_cuti = :id");
		$sql->execute(array(":id" => $_POST['delete']));
		if ($sql->rowCount() == 1) {
			$sql = 0; //tutup koneksi db
			echo "Sukses";
		} else {
			$sql = 0; //tutup koneksi db
			echo "Gagal";
		}
	} else {
		echo "Gagal";
	}
}

?>