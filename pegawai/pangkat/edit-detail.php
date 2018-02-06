<?php
if (isset($_POST)) {
include_once("../../database/koneksi.php");

$sql = $db->prepare("SELECT * FROM pangkat WHERE id_pangkat = :id");
$sql->execute(array(":id" => $_POST['id']));
$data = $sql->fetch(PDO::FETCH_OBJ);
$sql = 0;

echo "
<div class='form-group'>
	<div class='col-sm-3'>
		<label for='pangkat' class='control-label'>Pangkat</label>
	</div>
	<div class='col-sm-9'>
		<input type='text' name='pangkat' id='pangkat' class='form-control' placeholder='Nama Pangkat' required='' maxlength='50' value='$data->pangkat'>
		<input type='hidden' name='id' value='$data->id_pangkat'>
		<input type='hidden' name='old_p' value='$data->pangkat'>
	</div>
</div>
";
}
?>