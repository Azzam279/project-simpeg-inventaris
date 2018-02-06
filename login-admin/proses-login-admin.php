<?php
session_start();
if (isset($_POST)) {
	if (empty($_POST['user']) || empty($_POST['pass'])) {
		$pesan = "Username & Password harus diisi!";
		$info = "warning";
	} else if (!ctype_alnum($_POST['user']) || !ctype_alnum($_POST['pass'])) {
		$pesan = "Username & Password hanya boleh menggunakan karakter Alfanumerik!";
		$info = "warning";
	} else {
		include_once("../database/koneksi.php");
		$sql = $db->prepare("SELECT * FROM admin WHERE username = :user");
		$sql->execute(array(":user" => $_POST['user']));
		if ($sql->rowCount() == 1) {
			$data = $sql->fetch(PDO::FETCH_OBJ);
			if (password_verify($_POST['pass'], $data->password)) {
				//buat session
				$_SESSION['id'] = $data->id_admin;
				$_SESSION['admin'] = $data->username;
				$_SESSION['nama'] = $data->username;
				$_SESSION['level'] = "Administrator";
				$_SESSION['id_level'] = $data->level;
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
				$pesan = "Username atau Password salah!";
				$info = "gagal";
			}
		} else {
			$sql = 0;
			$db = 0;
			//alert
			$pesan = "Username atau Password salah!";
			$info = "gagal";
		}
	}
	echo json_encode(['info' => $info, 'pesan' => $pesan]);
}
?>