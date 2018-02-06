<?php
if (isset($_POST)) {
	include_once("database/koneksi.php");
	$sql_room = $db->prepare("SELECT ruangan FROM barang WHERE satuan_kerja = :sk GROUP BY ruangan");
	$sql_room->execute([':sk' => $_POST['sk']]);
	if ($sql_room->rowCount() > 0) {
		while ($room = $sql_room->fetch(PDO::FETCH_OBJ)) {
			echo "<option value='$room->ruangan'>$room->ruangan</option>";
		}
	} else {
		echo "<option value=''>-Data kosong-</option>";
	}
	$sql_room = 0;
}
?>