<?php
include_once("../../database/koneksi.php");

$sql = $db->prepare("SELECT * FROM eselon");
$sql->execute();
$nmr = 1;

if ($sql->rowCount() > 0) {
	session_start();
	while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
		if ($_SESSION['id_level'] == "999") {
			$btn = "<center>
					<button type='button' class='btn btn-default btn-sm' data-toggle='modal' data-target='.slacker-modal-ese' title='Detail' onclick='detail_data_pegawai($data->id_eselon, \"no_eselon\", \"Eselon\", \"$data->eselon\")'><i class='fa fa-eye'></i></button>
					<button class='btn btn-warning btn-sm ink-reaction' data-toggle='modal' data-target='#modalEdit' onclick='edit_data($data->id_eselon)' title='Edit'><i class='fa fa-pencil-square-o'></i></button>
					<button class='btn btn-danger btn-sm ink-reaction' onclick='del_data($data->id_eselon, \"$data->eselon\")' title='Hapus'><i class='fa fa-trash'></i></button>
					</center>";
		} else {
			$btn = "<center>
					<button type='button' class='btn btn-default btn-sm' data-toggle='modal' data-target='.slacker-modal-ese' title='Detail' onclick='detail_data_pegawai($data->id_eselon, \"no_eselon\", \"Eselon\", \"$data->eselon\")'><i class='fa fa-eye'></i></button>
					</center>";
		}
			
		$row = array("no" => $nmr, "eselon" => $data->eselon, "btn" => $btn);
		$dt['data'][] = $row;
		$nmr++;
	}
} else {
	$row = array("no" => "", "eselon" => "", "btn" => "");
	$dt['data'][] = $row;
}
$sql = 0;
echo json_encode($dt);
?>