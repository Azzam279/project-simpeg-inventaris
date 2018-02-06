<?php
include_once("../database/koneksi.php");

if (isset($_POST['input'])) {
	if (empty($_POST['nama']) || empty($_POST['nip']) || empty($_POST['tmpt_lahir']) || empty($_POST['tgl_lahir']) || empty($_POST['jkl']) || empty($_POST['agama']) || empty($_POST['pangkat']) || empty($_POST['golongan']) || empty($_POST['tmt_gol']) || empty($_POST['jabatan']) || empty($_POST['tmt_jbt']) || empty($_POST['eselon']) || empty($_POST['unit_kerja']) || empty($_POST['pendidikan']) || empty($_POST['masa_kerja_thn']) || empty($_POST['masa_kerja_bln']) || empty($_POST['status'])) {
		$info = "warning";
		$pesan = "Semua kolom input wajib di isi! kecuali kolom Tahun Lulus, Diklat & Keterangan.";
	} else {
		//cek apakah nip sudah terdaftar atau blm
		$cek = $db->prepare("SELECT nip FROM pegawai WHERE nip = :nip");
		$cek->execute([':nip' => trim(strip_tags($_POST['nip']))]);
		if ($cek->rowCount() > 0) {
			$info = "warning";
			$pesan = "NIP sudah terdaftar!";
		} else {
			//proses insert data
			$sql = $db->prepare("INSERT INTO pegawai VALUES(:id, :nama, :nip, :tmpt_lahir, :tgl_lahir, :gol, :tmt_gol, :jbt, :tmt_jbt, :ese, :pkt, :pend, :thn_lulus, :diklat, :mk_thn, :mk_bln, :status, :jkl, :agama, :unit, :ket, :foto, :pass)");
			$pass = password_hash("12345", PASSWORD_BCRYPT, ['cost' => 12]);
			$sql->execute(array(
				":id" => null,
				":nama" => trim(strip_tags($_POST['nama'])),
				":nip" => trim(strip_tags($_POST['nip'])),
				":tmpt_lahir" => trim(strip_tags($_POST['tmpt_lahir'])),
				":tgl_lahir" => $_POST['tgl_lahir'],
				":gol" => $_POST['golongan'],
				":tmt_gol" => $_POST['tmt_gol'],
				":jbt" => $_POST['jabatan'],
				":tmt_jbt" => $_POST['tmt_jbt'],
				":ese" => $_POST['eselon'],
				":pkt" => $_POST['pangkat'],
				":pend" => trim(strip_tags($_POST['pendidikan'])),
				":thn_lulus" => $_POST['thn_lulus'],
				":diklat" => trim(strip_tags($_POST['diklat'])),
				":mk_thn" => $_POST['masa_kerja_thn'],
				":mk_bln" => $_POST['masa_kerja_bln'],
				":status" => $_POST['status'],
				":jkl" => $_POST['jkl'],
				":agama" => $_POST['agama'],
				":unit" => $_POST['unit_kerja'],
				":ket" => trim(strip_tags($_POST['ket'])),
				":foto" => "",
				":pass" => $pass
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
		$cek  = 0;
	}
	echo json_encode(['info' => $info, 'pesan' => $pesan]);
}

if (isset($_POST['edit'])) {
	if (empty($_POST['nama']) || empty($_POST['nip']) || empty($_POST['tmpt_lahir']) || empty($_POST['tgl_lahir']) || empty($_POST['jkl']) || empty($_POST['agama']) || empty($_POST['pangkat']) || empty($_POST['golongan']) || empty($_POST['tmt_gol']) || empty($_POST['jabatan']) || empty($_POST['tmt_jbt']) || empty($_POST['eselon']) || empty($_POST['unit_kerja']) || empty($_POST['pendidikan']) || empty($_POST['masa_kerja_thn']) || empty($_POST['masa_kerja_bln']) || empty($_POST['status'])) {
		$info = "warning";
		$pesan = "Semua kolom input wajib di isi! kecuali kolom Tahun Lulus, Diklat & Keterangan.";
	} else {
		//cek apakah nip sudah terdaftar atau blm
		$cek = $db->prepare("SELECT nip FROM pegawai WHERE nip = :nip1 AND nip != :nip2");
		$cek->execute([':nip1' => trim(strip_tags($_POST['nip'])), ':nip2' => $_POST['old_nip']]);
		if ($cek->rowCount() > 0) {
			$info = "warning";
			$pesan = "NIP sudah terdaftar!";
		} else {
			//proses update data
			$sql = $db->prepare("UPDATE pegawai SET nama = :nama, nip = :nip, tmpt_lahir = :tmpt_lahir, tgl_lahir = :tgl_lahir, no_golongan = :gol, tmt_golongan = :tmt_gol, no_jabatan = :jbt, tmt_jabatan = :tmt_jbt, no_eselon = :ese, no_pangkat = :pkt, pendidikan = :pend, thn_lulus = :thn_lulus, diklat_jabatan = :diklat, masa_kerja_thn = :mk_thn, masa_kerja_bln = :mk_bln, status = :status, jkl = :jkl, no_agama = :agama, unit_kerja = :unit, ket = :ket WHERE id_pegawai = :id");
			$sql->execute(array(
				":id" => $_POST['id'],
				":nama" => trim(strip_tags($_POST['nama'])),
				":nip" => trim(strip_tags($_POST['nip'])),
				":tmpt_lahir" => trim(strip_tags($_POST['tmpt_lahir'])),
				":tgl_lahir" => $_POST['tgl_lahir'],
				":gol" => $_POST['golongan'],
				":tmt_gol" => $_POST['tmt_gol'],
				":jbt" => $_POST['jabatan'],
				":tmt_jbt" => $_POST['tmt_jbt'],
				":ese" => $_POST['eselon'],
				":pkt" => $_POST['pangkat'],
				":pend" => trim(strip_tags($_POST['pendidikan'])),
				":thn_lulus" => $_POST['thn_lulus'],
				":diklat" => trim(strip_tags($_POST['diklat'])),
				":mk_thn" => $_POST['masa_kerja_thn'],
				":mk_bln" => $_POST['masa_kerja_bln'],
				":status" => $_POST['status'],
				":jkl" => $_POST['jkl'],
				":agama" => $_POST['agama'],
				":unit" => $_POST['unit_kerja'],
				":ket" => trim(strip_tags($_POST['ket']))
				));
			//cek apakah proses update data sukses atau gagal
			if ($sql->rowCount() == 1) {
				$info = "sukses";
				$pesan = "Data berhasil diperbarui.";
			} else {
				$info = "gagal";
				$pesan = "Data gagal diperbarui.";
			}
			$sql = 0;
		}
		$cek  = 0;
	}
	echo json_encode(['info' => $info, 'pesan' => $pesan]);
}

if (isset($_POST['delete'])) {
	//cek apakah variable delete angka atau bukan, jika bukan maka hentikan proses
	if (is_numeric($_POST['delete'])) {
		//proses delete data
		$sql = $db->prepare("DELETE FROM pegawai WHERE id_pegawai = :id");
		$sql->execute(array(":id" => $_POST['delete']));
		if ($sql->rowCount() == 1) {
			if (!empty($_POST['foto'])) { //jika var foto tdk kosong, maka hapus foto pegawai
				unlink("../images/pegawai/$_POST[foto]");
			}
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