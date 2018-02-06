<?php
if (isset($_POST)) {
include_once("../../database/koneksi.php");

$sql = $db->prepare("SELECT * FROM jabatan WHERE id_jabatan = :id");
$sql->execute(array(":id" => $_POST['id']));
$data = $sql->fetch(PDO::FETCH_OBJ);
$sql = 0;

echo "
<div class='form-group'>
	<div class='col-sm-3'>
		<label for='jabatan' class='control-label'>Jabatan</label>
	</div>
	<div class='col-sm-9'>
		<input type='text' name='jabatan' id='jabatan' class='form-control' placeholder='Nama Jabatan' required='' maxlength='50' value='$data->jabatan'>
		<input type='hidden' name='id' value='$data->id_jabatan'>
		<input type='hidden' name='old_jbt' value='$data->jabatan'>
	</div>
</div>
";
}
?>