<?php
session_start();
include_once("../../database/koneksi.php");

if (empty($_SESSION['id_level'])) {
	$sql = $db->prepare("SELECT * FROM barang, unit_kerja WHERE barang.satuan_kerja = unit_kerja.id_unit");
}else if ($_SESSION['id_level'] == "999") {
	$sql = $db->prepare("SELECT * FROM barang, unit_kerja WHERE barang.satuan_kerja = unit_kerja.id_unit");	
} else {
	$sql = $db->prepare("SELECT * FROM barang, unit_kerja WHERE barang.satuan_kerja = unit_kerja.id_unit AND barang.satuan_kerja = $_SESSION[id_level]");
}
$sql->execute();
$nmr = 1;

if ($sql->rowCount() > 0) {
	while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
		if (isset($_SESSION['admin'])) {
			$btn = "<center>
					<a class='btn btn-warning btn-sm ink-reaction' href='./?d=edit-barang&edit=$data->id_barang' title='Edit'><i class='fa fa-pencil-square-o'></i></a>
					<button class='btn btn-danger btn-sm ink-reaction' onclick='del_data($data->id_barang, \"$data->nm_barang\")' title='Hapus'><i class='fa fa-trash'></i></button>
					</center>";
		} else {
			$btn = "<i>(Hidden)</i>";
		}

		$thn = $data->thn_buat_beli=="0000" ? "-" : $data->thn_buat_beli;
		$row = array(
			"no" => $nmr,
			"satuan_kerja" => $data->unit_kerja,
			"nm_barang" => $data->nm_barang,
			"model" => $data->model,
			"kd_barang" => $data->kode_barang,
			"jml" => $data->jumlah_barang,
			"ruangan" => $data->ruangan,
			"sn" => $data->sn_pabrik,
			"size" => $data->ukuran,
			"bahan" => $data->bahan,
			"thn" => $thn,
			"ket" => $data->ket,
			"baik" => $data->baik,
			"kurang" => $data->kurangbaik,
			"rusak" => $data->rusakberat,
			"btn" => $btn
			);
		$dt['data'][] = $row;
		$nmr++;
	}
} else {
	$row = array(
			"no" => "",
			"satuan_kerja" => "",
			"nm_barang" => "",
			"model" => "",
			"kd_barang" => "",
			"jml" => "",
			"ruangan" => "",
			"sn" => "",
			"size" => "",
			"bahan" => "",
			"thn" => "",
			"ket" => "",
			"baik" => "",
			"kurang" => "",
			"rusak" => "",
			"btn" => ""
			);
	$dt['data'][] = $row;
}
$sql = 0;
echo json_encode($dt);
?>