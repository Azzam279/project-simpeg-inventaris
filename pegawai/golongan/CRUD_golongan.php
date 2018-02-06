<?php
include_once("../../database/koneksi.php");

if (isset($_POST['input'])) {
	if (empty($_POST['golongan'])) {
		$info = "warning";
		$pesan = "Nama Golongan harus di isi!";
	} else {
		//cek apakah nama golongan sudah terdaftar atau blm
		$cek = $db->prepare("SELECT golongan FROM golongan WHERE golongan = :g");
		$cek->execute([':g' => trim(strip_tags($_POST['golongan']))]);
		if ($cek->rowCount() > 0) {
			$info = "warning";
			$pesan = "Nama Golongan sudah terdaftar!";
		} else {
			//proses insert data
			$sql = $db->prepare("INSERT INTO golongan VALUES(:id, :g)");
			$sql->execute([':id' => null, ':g' => trim(strip_tags($_POST['golongan']))]);
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
	if (empty($_POST['golongan'])) {
		$info = "warning";
		$pesan = "Nama Golongan harus di isi!";
	} else {
		//cek apakah nama golongan sudah terdaftar atau blm
		$cek = $db->prepare("SELECT golongan FROM golongan WHERE golongan = :g1 AND golongan != :g2");
		$cek->execute([
			':g1' => trim(strip_tags($_POST['golongan'])),
			':g2' => $_POST['old_g']
			]);
		if ($cek->rowCount() > 0) {
			$info = "warning";
			$pesan = "Nama Golongan sudah terdaftar!";
		} else {
			//proses insert data
			$sql = $db->prepare("UPDATE golongan SET golongan = :g WHERE id_golongan = :id");
			$sql->execute([':id' => $_POST['id'], ':g' => trim(strip_tags($_POST['golongan']))]);
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
		$sql = $db->prepare("DELETE FROM golongan WHERE id_golongan = :id");
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