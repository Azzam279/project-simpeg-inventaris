<?php
include_once("route.php");
include_once("$docs/database/koneksi.php");

if (isset($_POST)) {
	if ($_POST['data'] == "pangkat") {
		$sql = $db->prepare("SELECT * FROM pangkat");
		$sql->execute();

		echo '
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="formModalLabel">Pilih Pangkat</h4>
		</div>
		<form class="form-horizontal" action="#" method="post" role="form" id="form-lap">
			<div class="modal-body">
				<div class="form-group">
					<div class="col-sm-12">
						<select class="form-control">';
							while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
								echo "<option value='$data->id_pangkat'>$data->pangkat</option>";
							}
							$sql = 0;
		echo '
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success ink-reaction"><i class="fa fa-print"></i> Print</button>
			</div>
		</form>
		';

		?>
		<script>
			$("#form-lap").submit(function(e) {
				e.preventDefault();

				var id = $(this).find("select").val();
				window.open('<?="$host/pegawai/laporan/pangkat.php?id="?>'+id,'_blank','scrollbars=yes, resizeable=yes, top=0, left=100, width=1170, height=660');
			});
		</script>
		<?php
	} else if ($_POST['data'] == "jabatan") {
		$sql = $db->prepare("SELECT * FROM jabatan");
		$sql->execute();

		echo '
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="formModalLabel">Pilih Jabatan</h4>
		</div>
		<form class="form-horizontal" action="#" method="post" role="form" id="form-lap">
			<div class="modal-body">
				<div class="form-group">
					<div class="col-sm-12">
						<select class="form-control">';
							while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
								echo "<option value='$data->id_jabatan'>$data->jabatan</option>";
							}
							$sql = 0;
		echo '
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success ink-reaction"><i class="fa fa-print"></i> Print</button>
			</div>
		</form>
		';

		?>
		<script>
			$("#form-lap").submit(function(e) {
				e.preventDefault();

				var id = $(this).find("select").val();
				window.open('<?="$host/pegawai/laporan/jabatan.php?id="?>'+id,'_blank','scrollbars=yes, resizeable=yes, top=0, left=100, width=1170, height=660');
			});
		</script>
		<?php
	} else if ($_POST['data'] == "golongan") {
		$sql = $db->prepare("SELECT * FROM golongan");
		$sql->execute();

		echo '
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="formModalLabel">Pilih Golongan</h4>
		</div>
		<form class="form-horizontal" action="#" method="post" role="form" id="form-lap">
			<div class="modal-body">
				<div class="form-group">
					<div class="col-sm-12">
						<select class="form-control">';
							while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
								echo "<option value='$data->id_golongan'>$data->golongan</option>";
							}
							$sql = 0;
		echo '
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success ink-reaction"><i class="fa fa-print"></i> Print</button>
			</div>
		</form>
		';

		?>
		<script>
			$("#form-lap").submit(function(e) {
				e.preventDefault();

				var id = $(this).find("select").val();
				window.open('<?="$host/pegawai/laporan/golongan.php?id="?>'+id,'_blank','scrollbars=yes, resizeable=yes, top=0, left=100, width=1170, height=660');
			});
		</script>
		<?php
	} else if ($_POST['data'] == "eselon") {
		$sql = $db->prepare("SELECT * FROM eselon");
		$sql->execute();

		echo '
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="formModalLabel">Pilih Eselon</h4>
		</div>
		<form class="form-horizontal" action="#" method="post" role="form" id="form-lap">
			<div class="modal-body">
				<div class="form-group">
					<div class="col-sm-12">
						<select class="form-control">';
							while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
								echo "<option value='$data->id_eselon'>$data->eselon</option>";
							}
							$sql = 0;
		echo '
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success ink-reaction"><i class="fa fa-print"></i> Print</button>
			</div>
		</form>
		';

		?>
		<script>
			$("#form-lap").submit(function(e) {
				e.preventDefault();

				var id = $(this).find("select").val();
				window.open('<?="$host/pegawai/laporan/eselon.php?id="?>'+id,'_blank','scrollbars=yes, resizeable=yes, top=0, left=100, width=1170, height=660');
			});
		</script>
		<?php
	} else if ($_POST['data'] == "unit-kerja") {
		$sql = $db->prepare("SELECT * FROM unit_kerja");
		$sql->execute();

		echo '
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title" id="formModalLabel">Pilih Unit Kerja</h4>
		</div>
		<form class="form-horizontal" action="#" method="post" role="form" id="form-lap">
			<div class="modal-body">
				<div class="form-group">
					<div class="col-sm-12">
						<select class="form-control">';
							while ($data = $sql->fetch(PDO::FETCH_OBJ)) {
								echo "<option value='$data->id_unit'>$data->unit_kerja</option>";
							}
							$sql = 0;
		echo '
						</select>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-success ink-reaction"><i class="fa fa-print"></i> Print</button>
			</div>
		</form>
		';

		?>
		<script>
			$("#form-lap").submit(function(e) {
				e.preventDefault();

				var id = $(this).find("select").val();
				window.open('<?="$host/pegawai/laporan/unit-kerja.php?id="?>'+id,'_blank','scrollbars=yes, resizeable=yes, top=0, left=100, width=1170, height=660');
			});
		</script>
		<?php
	}
}
?>