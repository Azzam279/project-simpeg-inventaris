<?php
if (isset($_POST)) {
include_once("../../database/koneksi.php");

$sql = $db->prepare("SELECT * FROM eselon WHERE id_eselon = :id");
$sql->execute(array(":id" => $_POST['id']));
$data = $sql->fetch(PDO::FETCH_OBJ);
$sql = 0;

echo "
<div class='form-group'>
	<div class='col-sm-3'>
		<label for='eselon' class='control-label'>Eselon</label>
	</div>
	<div class='col-sm-9'>
		<input type='text' name='eselon' id='eselon' class='form-control' placeholder='Nama Eselon' required='' maxlength='50' value='$data->eselon'>
		<input type='hidden' name='id' value='$data->id_eselon'>
		<input type='hidden' name='old_e' value='$data->eselon'>
	</div>
</div>
";
}
?>