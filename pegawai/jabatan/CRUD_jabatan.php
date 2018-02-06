<?php
include_once("../../database/koneksi.php");

if (isset($_POST['input'])) {
	if (empty($_POST['jabatan'])) {
		$info = "warning";
		$pesan = "Nama Jabatan harus di isi!";
	} else {
		//cek apakah nama jabatan sudah terdaftar atau blm
		$cek = $db->prepare("SELECT jabatan FROM jabatan WHERE jabatan = :jbt");
		$cek->execute([':jbt' => trim(strip_tags($_POST['jabatan']))]);
		if ($cek->rowCount() > 0) {
			$info = "warning";
			$pesan = "Nama Jabatan sudah terdaftar!";
		} else {
			//proses insert data
			$sql = $db->prepare("INSERT INTO jabatan VALUES(:id, :jbt)");
			$sql->execute([':id' => null, ':jbt' => trim(strip_tags($_POST['jabatan']))]);
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
	if (empty($_POST['jabatan'])) {
		$info = "warning";
		$pesan = "Nama Jabatan harus di isi!";
	} else {
		//cek apakah nama jabatan sudah terdaftar atau blm
		$cek = $db->prepare("SELECT jabatan FROM jabatan WHERE jabatan = :jbt1 AND jabatan != :jbt2");
		$cek->execute([
			':jbt1' => trim(strip_tags($_POST['jabatan'])),
			':jbt2' => $_POST['old_jbt']
			]);
		if ($cek->rowCount() > 0) {
			$info = "warning";
			$pesan = "Nama Jabatan sudah terdaftar!";
		} else {
			//proses insert data
			$sql = $db->prepare("UPDATE jabatan SET jabatan = :jbt WHERE id_jabatan = :id");
			$sql->execute([':id' => $_POST['id'], ':jbt' => trim(strip_tags($_POST['jabatan']))]);
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
	//cek apakah variable del angka atau bukan, jika bukan maka hentikan proses
	if (is_numeric($_POST['delete'])) {
		//proses delete data
		$sql = $db->prepare("DELETE FROM jabatan WHERE id_jabatan = :id");
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