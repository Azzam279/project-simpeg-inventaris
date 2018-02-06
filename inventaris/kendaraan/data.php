<?php
session_start();
include_once("../../database/koneksi.php");

$sql = $db->prepare("SELECT * FROM kendaraan");
$sql->execute();
$nmr = 1;

if ($sql->rowCount() > 0) {
	while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
		if ($data->tgl_pajak <= strtotime(date('Y-m'))) {
			$no_pol = explode("-", $data->no_polisi);
			$alerts = "<span class='show_alert'></span><script>$('.show_alert').parents('tr').addClass('danger');</script>";
			$kode = "$data->kode_kendaraan $alerts";
			if (isset($_SESSION['admin']) && $_SESSION['id_level'] == "999") {
				$btn = "<center>
						<a class='btn btn-warning btn-sm ink-reaction' href='./?d=edit-kendaraan&edit=$data->id_kendaraan' title='Edit'><i class='fa fa-pencil-square-o'></i></a>
						<button class='btn btn-danger btn-sm ink-reaction' onclick='del_data($data->id_kendaraan, \"$data->nama\")' title='Hapus'><i class='fa fa-trash'></i></button><br><p></p>
						<button class='btn btn-default btn-xs ink-reaction' onclick='upd_pajak($data->id_kendaraan, $no_pol[1])' title='Perbarui Pajak'>Perbarui Pajak</button>
						</center>";
			} else {
				$btn = "<i>(Hidden)</i>";
			}
		} else {
			$kode = $data->kode_kendaraan;
			if (isset($_SESSION['admin']) && $_SESSION['id_level'] == "999") {
				$btn = "<center>
						<a class='btn btn-warning btn-sm ink-reaction' href='./?d=edit-kendaraan&edit=$data->id_kendaraan' title='Edit'><i class='fa fa-pencil-square-o'></i></a>
						<button class='btn btn-danger btn-sm ink-reaction' onclick='del_data($data->id_kendaraan, \"$data->nama\")' title='Hapus'><i class='fa fa-trash'></i></button>
						</center>";
			} else {
				$btn = "<i>(Hidden)</i>";
			}
		}
		$thn = $data->tahun=="0000" ? "-" : $data->tahun;
		$row = array(
			"no" => $nmr,
			"su" => $data->sub_unit,
			"upb" => $data->upb,
			"kode" => $kode,
			"nama" => $data->nama,
			"merk" => $data->merk,
			"harga" => $data->harga,
			"cp" => $data->cara_perolehan,
			"no_rangka" => $data->no_rangka,
			"no_pol" => $data->no_polisi,
			"no_bpkb" => $data->no_bpkb,
			"thn" => $thn,
			"ket" => $data->ket,
			"kon" => $data->keadaan,
			"btn" => $btn
			);
		$dt['data'][] = $row;
		$nmr++;
	}
} else {
	$row = array(
			"no" => "",
			"su" => "",
			"upb" => "",
			"kode" => "",
			"nama" => "",
			"merk" => "",
			"harga" => "",
			"cp" => "",
			"no_rangka" => "",
			"no_pol" => "",
			"no_bpkb" => "",
			"thn" => "",
			"ket" => "",
			"kon" => "",
			"btn" => ""
			);
	$dt['data'][] = $row;
}
$sql = 0;
echo json_encode($dt);
?>