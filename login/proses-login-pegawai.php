<?php
session_start();
if (isset($_POST)) {
	if (empty($_POST['nip']) || empty($_POST['pass'])) {
		$pesan = "NIP & Password harus diisi!";
		$info = "warning";
	} else if (!ctype_alnum($_POST['pass'])) {
		$pesan = "Password hanya boleh menggunakan karakter Alfanumerik!";
		$info = "warning";
	} else {
		include_once("../database/koneksi.php");
		$sql = $db->prepare("SELECT nip, nama, password, id_pegawai FROM pegawai WHERE nip = :nip");
		$sql->execute(array(":nip" => $_POST['nip']));
		if ($sql->rowCount() == 1) {
			$data = $sql->fetch(PDO::FETCH_OBJ);
			if (password_verify($_POST['pass'], $data->password)) {
				//buat session
				$_SESSION['id'] = $data->id_pegawai;
				$_SESSION['nip'] = $data->nip;
				$_SESSION['pegawai'] = $data->nama;
				$_SESSION['nama'] = $data->nama;
				$_SESSION['level'] = "Pegawai";
				//tutup koneksi db
				$sql = 0;
				$db = 0;
				//alert
				$pesan = "sukses";
				$info = "sukses";
			} else {
				$sql = 0;
				$db = 0;
				//alert
				$pesan = "NIP atau Password salah!";
				$info = "gagal";
			}
		} else {
			$sql = 0;
			$db = 0;
			//alert
			$pesan = "NIP atau Password salah!";
			$info = "gagal";
		}
	}
	echo json_encode(['info' => $info, 'pesan' => $pesan]);
}
?>