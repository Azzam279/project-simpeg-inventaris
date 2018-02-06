<?php
session_start();
include_once("../../database/koneksi.php");

$sql = $db->prepare("SELECT * FROM cuti WHERE no_pegawai = :no");
$sql->execute([':no' => $_SESSION['id']]);
$nmr = 1;

if ($sql->rowCount() > 0) {
	while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
		if ($data->tipe == "Pejabat") {
			$btn = "<center>
					<a class='btn btn-default btn-sm ink-reaction' href='javascript:void(0)' onclick='cetak($data->id_cuti, \"pejabat\")' title='Print'><i class='fa fa-print'></i></a>
					<button class='btn btn-danger btn-sm ink-reaction' onclick='del_data($data->id_cuti)' title='Hapus'><i class='fa fa-trash'></i></button>
					</center>";
		} else {
			$btn = "<center>
					<a class='btn btn-default btn-sm ink-reaction' href='javascript:void(0)' onclick='cetak($data->id_cuti, \"non-pejabat\")' title='Print'><i class='fa fa-print'></i></a>
					<button class='btn btn-danger btn-sm ink-reaction' onclick='del_data($data->id_cuti)' title='Hapus'><i class='fa fa-trash'></i></button>
					</center>";
		}

		$row = array(
			"no" => $nmr,
			"jenis" => $data->jenis_surat,
			"tgl_mulai" => $data->tgl_mulai,
			"tgl_selesai" => $data->tgl_selesai,
			"hari" => $data->hari." hari",
			"btn" => $btn
			);
		$dt['data'][] = $row;
		$nmr++;
	}
} else {
	$row = array(
			"no" => "",
			"jenis" => "",
			"tgl_mulai" => "",
			"tgl_selesai" => "",
			"hari" => "",
			"btn" => ""
			);
	$dt['data'][] = $row;
}
$sql = 0;
echo json_encode($dt);
?>