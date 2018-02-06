<section class="style-default-bright">
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li class="active">Data Kendaraan</li>
		</ol>
		<?php if (isset($_SESSION['admin']) && $_SESSION['id_level'] == "999") : //login as admin ?>
		<div class="pull-right">
			<a href="./?d=input-kendaraan" class="btn btn-primary"><i class="fa fa-plus"></i> Input Data</a>
		</div>
		<?php endif; ?>
	</div>
	<div class="section-body contain-lg">

		<!-- BEGIN DATA KENDARAAN -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="table-responsive">
					<table id="datatable2" class="table order-column hover" data-source="data.php" data-swftools="<?="$host/assets/js/libs/DataTables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"?>">
						<thead>
							<tr>
								<th></th>
								<th>No</th>
								<th>Kode Kendaraan</th>
								<th>Nama / Jenis Kendaraan</th>
								<th>Merk / Tipe</th>
								<th>Sub Unit</th>
								<th>U P B</th>
								<th>Harga</th>
								<th width="100">Opsi</th>
							</tr>
						</thead>
					</table>
				</div><!--end .table-responsive -->
				<div title="Info" data-toggle="tooltip" data-placement="bottom" style="display: inline-block;">
					<p></p>
					<div style="width: 20px; height: 20px; background: #FAD7D4; display: inline-block; vertical-align: middle;"></div> = <i>Pajak Habis</i> <i class="fa fa-info-circle"></i>
				</div>
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END DATA KENDARAAN -->

	</div><!--end .section-body -->
</section>