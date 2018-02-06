<?php
if (isset($_POST)) {
	if (empty($_POST['old_pass']) || empty($_POST['new_pass']) || empty($_POST['new_pass2'])) {
		$pesan = "Semua kolom input wajib diisi!";
		$info = "warning";
	} else if (!ctype_alnum($_POST['new_pass'])) {
		$pesan = "Password hanya boleh menggunakan karakter Alfanumberik!";
		$info = "warning";
	} else if ($_POST['new_pass'] != $_POST['new_pass2']) {
		$pesan = "Password tidak sama! ketik ulang password.";
		$info = "warning";
	} else {
		session_start();
		include_once("database/koneksi.php");
		if ($_SESSION['level'] == "Pegawai") { //jika level user sebagai pegawai
			$sql = $db->prepare("SELECT password FROM pegawai WHERE id_pegawai = :id");
		} else { //jika level user sebagai admin
			$sql = $db->prepare("SELECT password FROM admin WHERE id_admin = :id");
		}
		$sql->execute(array(":id" => $_SESSION['id']));
		$cek = $sql->fetch(PDO::FETCH_OBJ);
		//cek apakah password lama benar atau tidak
		if (password_verify($_POST['old_pass'], $cek->password)) {
			$sql = 0; //tutup koneksi db
			//proses ganti password
			if ($_SESSION['level'] == "Pegawai") { //jika level user sebagai pegawai
				$update = $db->prepare("UPDATE pegawai SET password = :pass WHERE id_pegawai = :id");
			} else { //jika level user sebagai admin
				$update = $db->prepare("UPDATE admin SET password = :pass WHERE id_admin = :id");
			}
			$pass = password_hash($_POST['new_pass'], PASSWORD_BCRYPT, ['cost' => 12]);
			$update->execute(array(":pass" => $pass, ":id" => $_SESSION['id']));
			//cek apakah proses ganti password sukses atau gagal
			if ($update->rowCount() == 1) {
				$update = 0; //tutup koneksi db
				//alert
				$pesan = "Password berhasil diperbarui!";
				$info = "sukses";
			} else {
				$update = 0; //tutup koneksi db
				//alert
				$pesan = "Password gagal diperbarui!";
				$info = "gagal";
			}
		} else {
			//alert
			$pesan = "Password lama salah!";
			$info = "warning";
		}
	}
	echo json_encode(['info' => $info, 'pesan' => $pesan]);
}
?>