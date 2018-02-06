<?php
include_once("../../database/koneksi.php");

if (isset($_POST['input'])) {
	if (empty($_POST['satuan_kerja']) || empty($_POST['ruangan']) || empty($_POST['nm_barang']) || empty($_POST['jml']) || $_POST['baik']=="" || $_POST['kurangbaik']=="" || $_POST['rusakberat']=="") {
		$info = "warning";
		$pesan = "Satuan Kerja, Ruangan, Nama Barang, Jumlah, dan Kondisi Barang wajib di isi!";
	} else {
		//proses insert data
		$sql = $db->prepare("INSERT INTO barang VALUES(:id, :sk, :room, :nm_barang, :model, :sn_pabrik, :ukuran, :bahan, :thn, :kode, :jml, :ket, :baik, :kurangbaik, :rusakberat)");
		$sql->execute(array(
			":id" => null,
			":sk" => $_POST['satuan_kerja'],
			":room" => trim(strip_tags($_POST['ruangan'])),
			":nm_barang" => trim(strip_tags($_POST['nm_barang'])),
			":model" => trim(strip_tags($_POST['model'])),
			":sn_pabrik" => trim(strip_tags($_POST['sn'])),
			":ukuran" => trim(strip_tags($_POST['size'])),
			":bahan" => trim(strip_tags($_POST['bahan'])),
			":thn" => $_POST['thn'],
			":kode" => trim(strip_tags($_POST['kd_barang'])),
			":jml" => $_POST['jml'],
			":ket" => trim(strip_tags($_POST['ket'])),
			":baik" => $_POST['baik'],
			":kurangbaik" => $_POST['kurangbaik'],
			":rusakberat" => $_POST['rusakberat']
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
	if (empty($_POST['satuan_kerja']) || empty($_POST['ruangan']) || empty($_POST['nm_barang']) || empty($_POST['jml']) || $_POST['baik']=="" || $_POST['kurangbaik']=="" || $_POST['rusakberat']=="") {
		$info = "warning";
		$pesan = "Satuan Kerja, Ruangan, Nama Barang, Jumlah, dan Kondisi Barang wajib di isi!";
	} else {
		//proses update data
		$sql = $db->prepare("UPDATE barang SET satuan_kerja = :sk, ruangan = :room, nm_barang = :nm_barang, model = :model, sn_pabrik = :sn_pabrik, ukuran = :ukuran, bahan = :bahan, thn_buat_beli = :thn, kode_barang = :kode, jumlah_barang = :jml, ket = :ket, baik = :baik, kurangbaik = :kurangbaik, rusakberat = :rusakberat WHERE id_barang = :id");
		$sql->execute(array(
			":id" => $_POST['id'],
			":sk" => $_POST['satuan_kerja'],
			":room" => trim(strip_tags($_POST['ruangan'])),
			":nm_barang" => trim(strip_tags($_POST['nm_barang'])),
			":model" => trim(strip_tags($_POST['model'])),
			":sn_pabrik" => trim(strip_tags($_POST['sn'])),
			":ukuran" => trim(strip_tags($_POST['size'])),
			":bahan" => trim(strip_tags($_POST['bahan'])),
			":thn" => $_POST['thn'],
			":kode" => trim(strip_tags($_POST['kd_barang'])),
			":jml" => $_POST['jml'],
			":ket" => trim(strip_tags($_POST['ket'])),
			":baik" => $_POST['baik'],
			":kurangbaik" => $_POST['kurangbaik'],
			":rusakberat" => $_POST['rusakberat']
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
	echo json_encode(['info' => $info, 'pesan' => $pesan]);
}

if (isset($_POST['delete'])) {
	//cek apakah variable delete angka atau bukan, jika bukan maka hentikan proses
	if (is_numeric($_POST['delete'])) {
		//proses delete data
		$sql = $db->prepare("DELETE FROM barang WHERE id_barang = :id");
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