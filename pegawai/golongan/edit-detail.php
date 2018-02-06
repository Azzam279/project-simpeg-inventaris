<?php
if (isset($_POST)) {
include_once("../../database/koneksi.php");

$sql = $db->prepare("SELECT * FROM golongan WHERE id_golongan = :id");
$sql->execute(array(":id" => $_POST['id']));
$data = $sql->fetch(PDO::FETCH_OBJ);
$sql = 0;

echo "
<div class='form-group'>
	<div class='col-sm-3'>
		<label for='golongan' class='control-label'>Golongan</label>
	</div>
	<div class='col-sm-9'>
		<input type='text' name='golongan' id='golongan' class='form-control' placeholder='Nama Golongan' required='' maxlength='50' value='$data->golongan'>
		<input type='hidden' name='id' value='$data->id_golongan'>
		<input type='hidden' name='old_g' value='$data->golongan'>
	</div>
</div>
";
}
?>