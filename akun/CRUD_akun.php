<?php
include_once("../route.php");
include_once("$docs/database/koneksi.php");

if (isset($_POST['input'])) {
	if (empty($_POST['user']) || empty($_POST['pass']) || empty($_POST['pass2'])) {
		$pesan = "Username, Password, & Konfirmasi Password wajib diisi!";
		$info = "warning";
	} else if (!ctype_alnum($_POST['user']) || !ctype_alnum($_POST['pass'])) {
		$pesan = "Username dan Password hanya boleh menggunakan karakter Alfanumerik!";
		$info = "warning";
	} else if ($_POST['pass'] != $_POST['pass2']) {
		$pesan = "Password tidak sama! ketik ulang password.";
		$info = "warning";
	} else if (empty($_POST['level'])) {
		$pesan = "Level admin tidak boleh kosong!";
		$info = "warning";
	} else {
		//cek apakah username sdh terdaftar atau blm, jika sdh ada maka hentikan proses.
		//(utk mencegah duplikasi data)
		$cek_user = $db->prepare("SELECT username FROM admin WHERE username = :user");
		$cek_user->execute(array(":user" => $_POST['user']));

		if ($cek_user->rowCount() < 1) {
			//hashing password admin utk keamanan
			$pass = password_hash($_POST['pass'], PASSWORD_BCRYPT, ['cost' => 12]);
			//proses insert data admin
			$sql = $db->prepare("INSERT INTO admin VALUES(:id, :user, :pass, :level)");
			$sql->execute(array(
				":id" => null,
				":user" => $_POST['user'],
				":pass" => $pass,
				":level" => $_POST['level']
				));
			//cek apakah proses insert data sukses atau gagal
			if ($sql->rowCount() == 1) {
				$sql = 0; //tutup koneksi db
				$pesan = "Akun baru berhasil dibuat.";
				$info = "sukses";
			} else {
				$sql = 0; //tutup koneksi db
				$pesan = "Akun baru gagal dibuat.";
				$info = "gagal";
			}
		} else {
			$pesan = "Username '$_POST[user]' sudah ada!";
			$info = "warning";
		}
		$cek_user = 0; //tutup koneksi db
	}
	echo json_encode(['info' => $info, 'pesan' => $pesan]);
}

if (isset($_POST['delete'])) {
	if (is_numeric($_POST['delete'])) {
		//proses delete data admin berdasarkan id admin
		$del = $db->prepare("DELETE FROM admin WHERE id_admin = :id");
		$del->execute(array(":id" => $_POST['delete']));
		//cek apakah proses delete sukses atau gagal
		if ($del->rowCount() == 1) {
			$del = 0; //tutup koneksi db
			echo "Sukses";
		} else {
			$del = 0; //tutup koneksi db
			echo "Gagal";
		}
	} else {
		echo "Gagal";
	}
}
?>