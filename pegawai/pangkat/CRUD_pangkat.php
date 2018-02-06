<?php
include_once("../../database/koneksi.php");

if (isset($_POST['input'])) {
	if (empty($_POST['pangkat'])) {
		$info = "warning";
		$pesan = "Nama Pangkat harus di isi!";
	} else {
		//cek apakah nama pangkat sudah terdaftar atau blm
		$cek = $db->prepare("SELECT pangkat FROM pangkat WHERE pangkat = :p");
		$cek->execute([':p' => trim(strip_tags($_POST['pangkat']))]);
		if ($cek->rowCount() > 0) {
			$info = "warning";
			$pesan = "Nama Pangkat sudah terdaftar!";
		} else {
			//proses insert data
			$sql = $db->prepare("INSERT INTO pangkat VALUES(:id, :p)");
			$sql->execute([':id' => null, ':p' => trim(strip_tags($_POST['pangkat']))]);
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
	if (empty($_POST['pangkat'])) {
		$info = "warning";
		$pesan = "Nama Pangkat harus di isi!";
	} else {
		//cek apakah nama pangkat sudah terdaftar atau blm
		$cek = $db->prepare("SELECT pangkat FROM pangkat WHERE pangkat = :p1 AND pangkat != :p2");
		$cek->execute([
			':p1' => trim(strip_tags($_POST['pangkat'])),
			':p2' => $_POST['old_p']
			]);
		if ($cek->rowCount() > 0) {
			$info = "warning";
			$pesan = "Nama Pangkat sudah terdaftar!";
		} else {
			//proses insert data
			$sql = $db->prepare("UPDATE pangkat SET pangkat = :p WHERE id_pangkat = :id");
			$sql->execute([':id' => $_POST['id'], ':p' => trim(strip_tags($_POST['pangkat']))]);
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
		$sql = $db->prepare("DELETE FROM pangkat WHERE id_pangkat = :id");
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