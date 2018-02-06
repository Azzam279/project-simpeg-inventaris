<?php
if (isset($_POST)) {
include_once("../../database/koneksi.php");

$sql = $db->prepare("SELECT * FROM unit_kerja WHERE id_unit = :id");
$sql->execute(array(":id" => $_POST['id']));
$data = $sql->fetch(PDO::FETCH_OBJ);
$sql = 0;

echo "
<div class='form-group'>
	<div class='col-sm-3'>
		<label for='unit' class='control-label'>Unit Kerja</label>
	</div>
	<div class='col-sm-9'>
		<input type='text' name='unit' id='unit' class='form-control' placeholder='Nama Unit Kerja' required='' maxlength='50' value='$data->unit_kerja'>
		<input type='hidden' name='id' value='$data->id_unit'>
		<input type='hidden' name='old_u' value='$data->unit_kerja'>
	</div>
</div>
";
}
?>