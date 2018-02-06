<!-- Show Modal Data Pegawai-->
<div class="modal fade in slacker-modal-pgw slacker-pegawai" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
	<div class="modal-dialog modal-slacker">
		<div class="modal-content" id="show-detail-data-pgw">
	      	<!-- isi detail data pegawai -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- End Modal -->

<!-- BEGIN FORM MODAL REPORT -->
<div class="modal fade" id="formModalReport" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" id="output-report-pgw">
			<!-- Output here -->
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL REPORT -->

<!-- BEGIN FORM MODAL REPORT BARANG -->
<div class="modal fade" id="formModalReportBarang" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel">Pilih Satuan Kerja & Ruangan</h4>
			</div>
			<form class="form-horizontal" action="#" method="post" role="form" id="form-inv-barang">
				<div class="modal-body">
					<div class="form-group">
						<div class="col-sm-3">
							<label for="sk-m" class="control-label">Satuan Kerja</label>
						</div>
						<div class="col-sm-9">
							<select name="sk-m" id="sk-m" class="form-control" required="">
								<?php
								$sql_sk = $db->prepare("SELECT * FROM unit_kerja");
								$sql_sk->execute();
								while ($sk = $sql_sk->fetch(PDO::FETCH_OBJ)) {
									echo "<option value='$sk->id_unit|$sk->unit_kerja'>$sk->unit_kerja</option>";
								}
								$sql_sk = 0;
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-3">
							<label for="room-m" class="control-label">Ruangan</label>
						</div>
						<div class="col-sm-9">
							<select name="room-m" id="room-m" class="form-control" required="">
								<option value=""></option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success ink-reaction"><i class="fa fa-print"></i> Print</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL REPORT BARANG -->

<!-- BEGIN FORM MODAL REPORT KENDARAAN -->
<div class="modal fade" id="formModalReportKendaraan" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel">Pilih Sub Unit & U P B</h4>
			</div>
			<form class="form-horizontal" action="#" method="post" role="form" id="form-inv-kend">
				<div class="modal-body">
					<div class="form-group">
						<div class="col-sm-3">
							<label for="sub-m" class="control-label">Sub Unit</label>
						</div>
						<div class="col-sm-9">
							<select name="sub-m" id="sub-m" class="form-control" required="">
								<option value="">-Pilih Sub Unit-</option>
								<?php
								$sql_sub = $db->prepare("SELECT sub_unit FROM kendaraan GROUP BY sub_unit");
								$sql_sub->execute();
								while ($sub = $sql_sub->fetch(PDO::FETCH_OBJ)) {
									echo "<option value='$sub->sub_unit'>$sub->sub_unit</option>";
								}
								$sql_sub = 0;
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-3">
							<label for="upb-m" class="control-label">U P B</label>
						</div>
						<div class="col-sm-9">
							<select name="upb-m" id="upb-m" class="form-control" required="">
								<option value="">-Pilih U P B-</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success ink-reaction"><i class="fa fa-print"></i> Print</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL REPORT BARANG -->

<!-- BEGIN FORM MODAL GANTI PASSWORD -->
<div class="modal fade" id="formModalchpass" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel"><i class="fa fa-key"></i> Perbarui Password</h4>
			</div>
			<form class="form-horizontal" action="<?=htmlspecialchars("$host/ch-pass.php")?>" method="post" role="form" id="form-chpass">
				<div class="modal-body">
					<div class="form-group">
						<div class="col-sm-3">
							<label for="old_pass" class="control-label">Password Lama</label>
						</div>
						<div class="col-sm-9">
							<input type="password" name="old_pass" class="form-control" required="" maxlength="150" id="old_pass">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-3">
							<label for="new_pass" class="control-label">Password Baru</label>
						</div>
						<div class="col-sm-9">
							<input type="password" name="new_pass" class="form-control" required="" maxlength="150" id="new_pass">
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-3">
							<label for="new_pass2" class="control-label">Konfirmasi Password</label>
						</div>
						<div class="col-sm-9">
							<input type="password" name="new_pass2" class="form-control" required="" maxlength="150" id="new_pass2">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success ink-reaction"><i class="fa fa-check"></i> Perbarui</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL GANTI PASSWORD -->