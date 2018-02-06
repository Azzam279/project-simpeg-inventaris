<section class="style-default-bright">
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li class="active">Data Pegawai</li>
		</ol>
		<?php if (isset($_SESSION['admin']) && $_SESSION['id_level'] === "999") : //login as admin ?>
		<div class="pull-right">
			<a href="./?d=input-pegawai" class="btn btn-primary"><i class="fa fa-plus"></i> Input Data</a>
		</div>
		<?php endif; ?>
	</div>
	<div class="section-body contain-lg">

		<!-- BEGIN DATA PEGAWAI -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="table-responsive">
					<table id="datatable2" class="table order-column hover" data-source="data.php" data-swftools="<?="$host/assets/js/libs/DataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"?>">
						<thead>
							<tr>
								<th></th>
								<th>No</th>
								<th>NIP</th>
								<th>Nama</th>
								<th>Pangkat</th>
								<th>Gol. Ruang</th>
								<th>Jabatan</th>
								<th>Eselon</th>
								<th>Unit Kerja</th>
								<th width="100">Opsi</th>
							</tr>
						</thead>
					</table>
				</div><!--end .table-responsive -->
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END DATA PEGAWAI -->

	</div><!--end .section-body -->
</section>