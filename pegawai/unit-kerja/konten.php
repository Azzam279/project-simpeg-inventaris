<section class="style-default-bright">
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li><a href="../">Pegawai</a></li>
			<li class="active">Data Unit Kerja</li>
		</ol>
		<div class="pull-right">
			<?php if ($_SESSION['id_level'] == 999): ?>
			<a href="#" class="btn btn-primary ink-reaction" data-toggle="modal" data-target="#formModal"><i class="fa fa-plus"></i> Input Data</a>
			<?php endif; ?>
		</div>
	</div>
	<div class="section-body contain-lg">

		<!-- BEGIN DATA UNIT KERJA -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="table-responsive">
					<table id="datatable2" class="table order-column hover" data-source="data.php">
						<thead>
							<tr>
								<th width="40">No</th>
								<th>Unit Kerja</th>
								<th width="120">Opsi</th>
							</tr>
						</thead>
					</table>
				</div><!--end .table-responsive -->
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END DATA UNIT KERJA -->

	</div><!--end .section-body -->
</section>

<!-- BEGIN FORM MODAL INPUT -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="formModalLabel">Form Input Unit Kerja</h4>
			</div>
			<div id="show-alert"></div>
			<form class="form-horizontal" action="<?=htmlspecialchars("CRUD_unit.php")?>" method="post" role="form" id="form-input">
				<div class="modal-body">
					<div class="form-group">
						<div class="col-sm-3">
							<label for="unit" class="control-label">Unit Kerja</label>
						</div>
						<div class="col-sm-9">
							<input type="text" name="unit" id="unit" class="form-control" placeholder="Nama Unit Kerja" required="" maxlength="50">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="hidden" name="input" value="input">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success ink-reaction">Simpan</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL INPUT -->

<!-- BEGIN FORM MODAL EDIT -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Form Edit Unit Kerja</h4>
			</div>
			<div id="show-alert2"></div>
			<form class="form-horizontal" action="<?=htmlspecialchars("CRUD_unit.php")?>" method="post" role="form" id="form-edit">
				<div class="modal-body" id="detail-edit">
					<!-- Output here -->
				</div>
				<div class="modal-footer">
					<input type="hidden" name="edit" value="edit">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-success ink-reaction">Perbarui</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- END FORM MODAL EDIT -->
