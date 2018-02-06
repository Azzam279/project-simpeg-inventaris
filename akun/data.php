<?php
include_once("../database/koneksi.php");

$sql = $db->prepare("SELECT * FROM admin");
$sql->execute();
$nmr = 1;

if ($sql->rowCount() > 0) {
	while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
		$btn = "<center>
					<button class='btn btn-danger btn-sm ink-reaction' onclick='del_data($data->id_admin, \"$data->username\")' title='Hapus'><i class='fa fa-trash'></i></button>
				</center>";
		$row = array(
			"no" => $nmr,
			"user" => $data->username,
			"btn" => $btn
			);
		$dt['data'][] = $row;
		$nmr++;
	}
} else {
	$row = array(
			"no" => "",
			"user" => "",
			"btn" => ""
			);
	$dt['data'][] = $row;
}
$sql = 0;
echo json_encode($dt);
?>