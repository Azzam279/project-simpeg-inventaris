<?php
include_once("../../database/koneksi.php");

if (isset($_POST['input'])) {
	if (empty($_POST['unit'])) {
		$info = "warning";
		$pesan = "Nama Unit Kerja harus di isi!";
	} else {
		//cek apakah nama unit_kerja sudah terdaftar atau blm
		$cek = $db->prepare("SELECT unit_kerja FROM unit_kerja WHERE unit_kerja = :u");
		$cek->execute([':u' => trim(strip_tags($_POST['unit']))]);
		if ($cek->rowCount() > 0) {
			$info = "warning";
			$pesan = "Nama Unit Kerja sudah terdaftar!";
		} else {
			//proses insert data
			$sql = $db->prepare("INSERT INTO unit_kerja VALUES(:id, :u)");
			$sql->execute([':id' => null, ':u' => trim(strip_tags($_POST['unit']))]);
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
		$cek = 0;
	}

	echo json_encode(["info" => $info, "data" => $pesan]);
}

if (isset($_POST['edit'])) {
	if (empty($_POST['unit'])) {
		$info = "warning";
		$pesan = "Nama Unit Kerja harus di isi!";
	} else {
		//cek apakah nama unit_kerja sudah terdaftar atau blm
		$cek = $db->prepare("SELECT unit_kerja FROM unit_kerja WHERE unit_kerja = :u1 AND unit_kerja != :u2");
		$cek->execute([
			':u1' => trim(strip_tags($_POST['unit'])),
			':u2' => $_POST['old_u']
			]);
		if ($cek->rowCount() > 0) {
			$info = "warning";
			$pesan = "Nama Unit Kerja sudah terdaftar!";
		} else {
			//proses insert data
			$sql = $db->prepare("UPDATE unit_kerja SET unit_kerja = :u WHERE id_unit = :id");
			$sql->execute([':id' => $_POST['id'], ':u' => trim(strip_tags($_POST['unit']))]);
			//cek apakah proses insert data sukses atau gagal
			if ($sql->rowCount() == 1) {
				$info = "sukses";
				$pesan = "Data berhasil diperbarui.";
			} else {
				$info = "gagal";
				$pesan = "Data gagal diperbarui.";
			}
			$sql = 0;
		}
		$cek = 0;
	}

	echo json_encode(["info" => $info, "data" => $pesan]);
}

if (isset($_POST['delete'])) {
	//cek apakah variable delete angka atau bukan, jika bukan maka hentikan proses
	if (is_numeric($_POST['delete'])) {
		//proses delete data
		$sql = $db->prepare("DELETE FROM unit_kerja WHERE id_unit = :id");
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