<?php
session_start();
include_once("../database/koneksi.php");

$sql = $db->prepare("SELECT * FROM pegawai, pangkat, jabatan, eselon, golongan, unit_kerja, agama WHERE pegawai.no_pangkat = pangkat.id_pangkat AND pegawai.no_jabatan = jabatan.id_jabatan AND pegawai.no_eselon = eselon.id_eselon AND pegawai.no_golongan = golongan.id_golongan AND pegawai.unit_kerja = unit_kerja.id_unit AND pegawai.no_agama = agama.id_agama AND pegawai.status != :stat");
$sql->execute([':stat' => "Pindah"]);
$nmr = 1;

if ($sql->rowCount() > 0) {
	while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
		if (isset($_SESSION['admin']) && $_SESSION['id_level'] === "999") {
			$btn = "<center>
					<a class='btn btn-warning btn-sm ink-reaction' href='./?d=edit-pegawai&edit=$data->id_pegawai' title='Edit'><i class='fa fa-pencil-square-o'></i></a>
					<button class='btn btn-danger btn-sm ink-reaction' onclick='del_data($data->id_pegawai, \"$data->nama\", \"$data->foto\")' title='Hapus'><i class='fa fa-trash'></i></button>
					</center>";
		} else {
			$btn = "<i>(Hidden)</i>";
		}

		$row = array(
			"no" => $nmr,
			"nip" => $data->nip,
			"nama" => $data->nama,
			"pangkat" => $data->pangkat,
			"golongan" => $data->golongan,
			"jabatan" => $data->jabatan,
			"eselon" => $data->eselon,
			"unit_kerja" => $data->unit_kerja,
			"tmpt_lahir" => $data->tmpt_lahir,
			"tgl_lahir" => $data->tgl_lahir,
			"jkl" => $data->jkl,
			"agama" => $data->agama,
			"pendidikan" => $data->pendidikan,
			"thn_lulus" => ($data->thn_lulus!="0000") ? $data->thn_lulus : "-",
			"diklat" => $data->diklat_jabatan,
			"mk_thn" => $data->masa_kerja_thn,
			"mk_bln" => $data->masa_kerja_bln,
			"tmt_golongan" => $data->tmt_golongan,
			"tmt_jabatan" => $data->tmt_jabatan,
			"ket" => $data->ket,
			"btn" => $btn
			);
		$dt['data'][] = $row;
		$nmr++;
	}
} else {
	$row = array(
			"no" => "",
			"nip" => "",
			"nama" => "",
			"pangkat" => "",
			"golongan" => "",
			"jabatan" => "",
			"eselon" => "",
			"unit_kerja" => "",
			"tmpt_lahir" => "",
			"tgl_lahir" => "",
			"jkl" => "",
			"agama" => "",
			"pendidikan" => "",
			"thn_lulus" => "",
			"diklat" => "",
			"mk_thn" => "",
			"mk_bln" => "",
			"tmt_golongan" => "",
			"tmt_jabatan" => "",
			"ket" => "",
			"btn" => ""
			);
	$dt['data'][] = $row;
}
$sql = 0;
echo json_encode($dt);
?>