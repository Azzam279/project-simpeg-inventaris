<section class="style-default-bright">
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li class="active">Data Barang</li>
		</ol>
		<?php if (isset($_SESSION['admin'])) : //login as admin ?>
		<div class="pull-right">
			<a href="./?d=input-barang" class="btn btn-primary"><i class="fa fa-plus"></i> Input Data</a>
		</div>
		<?php endif; ?>
	</div>
	<div class="section-body contain-lg">

		<!-- BEGIN DATA BARANG -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="table-responsive">
					<table id="datatable2" class="table order-column hover" data-source="data.php" data-swftools="<?="$host/assets/js/libs/DataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"?>">
						<thead>
							<tr>
								<th></th>
								<th>No</th>
								<th>Satuan Kerja</th>
								<th>Nama Barang</th>
								<th>Model/Merk</th>
								<th>Kode Barang</th>
								<th>Jumlah</th>
								<th width="100">Opsi</th>
							</tr>
						</thead>
					</table>
				</div><!--end .table-responsive -->
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END DATA BARANG -->

	</div><!--end .section-body -->
</section>