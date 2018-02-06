<section>
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li><a href="../">Data Pegawai</a></li>
			<li class="active">Absensi Pegawai</li>
		</ol>
	</div>
	<div class="section-body contain-lg">

		<!-- BEGIN DATA PEGAWAI -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="card card-bordered style-primary">
					<div class="card-head">
						<div class="tools">
							<div class="btn-group">
								<a href="./" class="btn btn-link" style="color: white;"><i class="fa fa-undo"></i> Kembali</a>
								<?php include_once("$docs/colorize.php"); ?>
								<a class="btn btn-icon-toggle btn-refresh"><i class="md md-refresh"></i></a>
								<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
								<a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
							</div>
						</div>
						<header>Absensi Pegawai</header>
					</div>
					<div class="card-body style-default-bright">
						<div class="pull-right">
							<div style="display: inline-block; border: solid 1px #C3C3C3; padding: 4px; border-radius: 4px; margin-right: 12px;">
								<select id="pick-bulan" class="form-control" style="width: 120px; display: inline-block;">
									<?php
									include_once("$docs/function.php");
									$now_bln = explode("-", indo_date(date('Y-m-d')));
									$arr_bln = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
									foreach ($arr_bln as $key => $bln) {
										$key = $key + 1;
										if ($bln == $now_bln[1]) {
											echo "<option value='$key-$bln' selected>$bln</option>";
										} else {
											echo "<option value='$key-$bln'>$bln</option>";
										}
									}
									?>
								</select>
								<select id="pick-tahun" class="form-control" style="width: 80px; display: inline-block;">
									<?php
									for ($i = date('Y'); $i >= 1945; $i--) { 
										echo "<option value='$i'>$i</option>";
									}
									?>
								</select>
								<button class="btn btn-default" onclick="cetak_absensi()"><i class="fa fa-print"></i> Cetak</button>
							</div>
							<?php if ($_SESSION['level'] == "Administrator"): ?>
							<a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
							<?php endif; ?>
						</div>
						<div class="clearfix"></div><br>

						<table class="table table-hover table-striped table-bordered" id="datatablez" width="100%">
							<thead>
								<tr>
									<th width="30">No.</th>
									<th>Hari</th>
									<th>Tanggal</th>
									<th width="100">Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div><!--end .card-body -->
				</div><!--end .card -->
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END DATA PEGAWAI -->

	</div><!--end .section-body -->
</section>