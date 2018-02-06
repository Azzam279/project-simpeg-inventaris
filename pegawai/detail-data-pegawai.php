<?php
if (isset($_POST)) {
	include_once("../database/koneksi.php");

	$sql = $db->prepare("SELECT * FROM pegawai, pangkat, golongan, jabatan, eselon, unit_kerja WHERE pegawai.no_pangkat = pangkat.id_pangkat AND pegawai.no_golongan = golongan.id_golongan AND pegawai.no_jabatan = jabatan.id_jabatan AND pegawai.no_eselon = eselon.id_eselon AND pegawai.unit_kerja = unit_kerja.id_unit AND pegawai.$_POST[attr] = :id");
	$sql->execute(array(':id' => $_POST['id_pgw']));
	$no = 1;

	echo '
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h4 class="modal-title" id="myLargeModalLabel">Detail Pegawai Berdasarkan '.$_POST['title'].' '.$_POST['val'].'</h4>
	</div>
	<div class="modal-body">

		<div class="row">
			<div class="col-md-12">
				<table class=\'table table-hover table-bordered\'>
					<thead>
						<tr>
							<th>No.</th>
							<th>NIP</th>
							<th>Nama</th>
							<th>Pangkat</th>
							<th>Gol. Ruang</th>
							<th>Jabatan</th>
							<th>Eselon</th>
							<th>Unit Kerja</th>
						</tr>
					</thead>
					<tbody>';
					while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
						echo "
							<tr>
								<td>$no</td>
								<td>$data->nip</td>
								<td>$data->nama</td>
								<td>$data->pangkat</td>
								<td>$data->golongan</td>
								<td>$data->jabatan</td>
								<td>$data->eselon</td>
								<td>$data->unit_kerja</td>
							</tr>
						";
						$no++;
					}
					$sql = 0;
  	echo '
					</tbody>
				</table>
			</div>
		</div>

	</div>
	';
}
?>