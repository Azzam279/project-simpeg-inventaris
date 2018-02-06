<?php
include_once("../../database/koneksi.php");

if (isset($_POST['input'])) {
	if (empty($_POST['eselon'])) {
		$info = "warning";
		$pesan = "Nama Eselon harus di isi!";
	} else {
		//cek apakah nama eselon sudah terdaftar atau blm
		$cek = $db->prepare("SELECT eselon FROM eselon WHERE eselon = :e");
		$cek->execute([':e' => trim(strip_tags($_POST['eselon']))]);
		if ($cek->rowCount() > 0) {
			$info = "warning";
			$pesan = "Nama Eselon sudah terdaftar!";
		} else {
			//proses insert data
			$sql = $db->prepare("INSERT INTO eselon VALUES(:id, :e)");
			$sql->execute([':id' => null, ':e' => trim(strip_tags($_POST['eselon']))]);
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
	if (empty($_POST['eselon'])) {
		$info = "warning";
		$pesan = "Nama Eselon harus di isi!";
	} else {
		//cek apakah nama eselon sudah terdaftar atau blm
		$cek = $db->prepare("SELECT eselon FROM eselon WHERE eselon = :e1 AND eselon != :e2");
		$cek->execute([
			':e1' => trim(strip_tags($_POST['eselon'])),
			':e2' => $_POST['old_e']
			]);
		if ($cek->rowCount() > 0) {
			$info = "warning";
			$pesan = "Nama Eselon sudah terdaftar!";
		} else {
			//proses insert data
			$sql = $db->prepare("UPDATE eselon SET eselon = :e WHERE id_eselon = :id");
			$sql->execute([':id' => $_POST['id'], ':e' => trim(strip_tags($_POST['eselon']))]);
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
		$sql = $db->prepare("DELETE FROM eselon WHERE id_eselon = :id");
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