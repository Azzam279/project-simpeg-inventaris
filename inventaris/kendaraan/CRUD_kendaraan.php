<?php
include_once("../../database/koneksi.php");

if (isset($_POST['input'])) {
	if (empty($_POST['kode']) || empty($_POST['nama']) || empty($_POST['no_pol']) || empty($_POST['no_pol_bln']) || empty($_POST['no_pol_thn']) || empty($_POST['harga']) || empty($_POST['cp']) || empty($_POST['kon']) || empty($_POST['sub_unit']) || empty($_POST['upb'])) {
		$info = "warning";
		$pesan = "Sub Unit, UPB, Kode Kendaraan, Nama Kendaraan, Cara Peroleh, No. Polisi, Kondisi, Satuan Unit, dan Harga wajib di isi!";
	} else {
		$thn = date('Y') + 1;
		$bln = (int)$_POST['no_pol_bln'];
        $tgl_pajak = strtotime("$thn-$bln");
		$no_pol = trim(strip_tags("$_POST[no_pol]-$bln-$_POST[no_pol_thn]"));

		//proses insert data
		$sql = $db->prepare("INSERT INTO kendaraan VALUES(:id, :sub, :upb, :kd, :cp, :nama, :merk, :thn, :harga, :kon, :no_rangka, :no_pol, :no_bpkb, :ket, :tgl_pajak)");
		$sql->execute(array(
			":id" => null,
			":sub" => $_POST['sub_unit'],
			":upb" => $_POST['upb'],
			":kd" => trim(strip_tags($_POST['kode'])),
			":cp" => $_POST['cp'],
			":nama" => trim(strip_tags($_POST['nama'])),
			":merk" => trim(strip_tags($_POST['merk'])),
			":thn" => trim(strip_tags($_POST['thn'])),
			":harga" => trim(strip_tags($_POST['harga'])),
			":kon" => trim(strip_tags($_POST['kon'])),
			":no_rangka" => $_POST['no_rangka'],
			":no_pol" => $no_pol,
			":no_bpkb" => $_POST['no_bpkb'],
			":ket" => $_POST['ket'],
			":tgl_pajak" => $tgl_pajak
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
	echo json_encode(['info' => $info, 'pesan' => $pesan]);
}

if (isset($_POST['edit'])) {
	if (empty($_POST['kode']) || empty($_POST['nama']) || empty($_POST['no_pol']) || empty($_POST['no_pol_bln']) || empty($_POST['no_pol_thn']) || empty($_POST['harga']) || empty($_POST['cp']) || empty($_POST['kon']) || empty($_POST['sub_unit']) || empty($_POST['upb'])) {
		$info = "warning";
		$pesan = "Sub Unit, UPB, Kode Kendaraan, Nama Kendaraan, Cara Peroleh, No. Polisi, Kondisi, Satuan Unit, dan Harga wajib di isi!";
	} else {

		if ($_POST['old_thn_bln'] == "$_POST[no_pol_bln]-$_POST[no_pol_thn]") {
			$no_pol = trim(strip_tags("$_POST[no_pol]-$_POST[no_pol_bln]-$_POST[no_pol_thn]"));
			//proses update data
			$sql = $db->prepare("UPDATE kendaraan SET kode_kendaraan = :kd, cara_perolehan = :cp, nama = :nama, merk = :merk, tahun = :thn, harga = :harga, keadaan = :kon, no_rangka = :no_rangka, no_polisi = :no_pol, no_bpkb = :no_bpkb, ket = :ket, sub_unit = :sub, upb = :upb WHERE id_kendaraan = :id");
			$sql->execute(array(
				":id" => $_POST['id'],
				":sub" => $_POST['sub_unit'],
				":upb" => $_POST['upb'],
				":kd" => trim(strip_tags($_POST['kode'])),
				":cp" => $_POST['cp'],
				":nama" => trim(strip_tags($_POST['nama'])),
				":merk" => trim(strip_tags($_POST['merk'])),
				":thn" => trim(strip_tags($_POST['thn'])),
				":harga" => trim(strip_tags($_POST['harga'])),
				":kon" => trim(strip_tags($_POST['kon'])),
				":no_rangka" => $_POST['no_rangka'],
				":no_pol" => $no_pol,
				":no_bpkb" => $_POST['no_bpkb'],
				":ket" => $_POST['ket']
				));
		} else {
			$thn = date('Y') + 1;
			$bln = (int)$_POST['no_pol_bln'];
	        $tgl_pajak = strtotime("$thn-$bln");
			$no_pol = trim(strip_tags("$_POST[no_pol]-$_POST[no_pol_bln]-$_POST[no_pol_thn]"));

			//proses update data
			$sql = $db->prepare("UPDATE kendaraan SET kode_kendaraan = :kd, cara_perolehan = :cp, nama = :nama, merk = :merk, tahun = :thn, harga = :harga, keadaan = :kon, no_rangka = :no_rangka, no_polisi = :no_pol, no_bpkb = :no_bpkb, satuan_unit = :unit, ket = :ket, tgl_pajak = :tgl_pajak, sub_unit = :sub, upb = :upb WHERE id_kendaraan = :id");
			$sql->execute(array(
				":id" => $_POST['id'],
				":sub" => $_POST['sub_unit'],
				":upb" => $_POST['upb'],
				":kd" => trim(strip_tags($_POST['kode'])),
				":cp" => $_POST['cp'],
				":nama" => trim(strip_tags($_POST['nama'])),
				":merk" => trim(strip_tags($_POST['merk'])),
				":thn" => trim(strip_tags($_POST['thn'])),
				":harga" => trim(strip_tags($_POST['harga'])),
				":kon" => trim(strip_tags($_POST['kon'])),
				":no_rangka" => $_POST['no_rangka'],
				":no_pol" => $no_pol,
				":no_bpkb" => $_POST['no_bpkb'],
				":unit" => $_POST['unit'],
				":ket" => $_POST['ket'],
				":tgl_pajak" => $tgl_pajak
				));
		}

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
	echo json_encode(['info' => $info, 'pesan' => $pesan]);
}

if (isset($_POST['delete'])) {
	//cek apakah variable delete angka atau bukan, jika bukan maka hentikan proses
	if (is_numeric($_POST['delete'])) {
		//proses delete data
		$sql = $db->prepare("DELETE FROM kendaraan WHERE id_kendaraan = :id");
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