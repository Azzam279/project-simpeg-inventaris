<div id="top"></div>

<section>
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li class="active">Surat Cuti</li>
		</ol>
	</div>
	<div class="section-body contain-lg">

		<?php
		include_once("$docs/database/koneksi.php");
		?>

		<!-- BEGIN FORM CUTI -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<form class="form form-validate floating-label" method="post" action="<?=htmlspecialchars("CRUD_cuti.php")?>" id="form-cuti" novalidate="novalidate">
					<div class="card card-bordered style-primary">
						<div class="card-head">
							<div class="tools">
								<div class="btn-group">
									<?php include_once("$docs/colorize.php"); ?>
									<a class="btn btn-icon-toggle btn-refresh"><i class="md md-refresh"></i></a>
									<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
									<a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
								</div>
							</div>
							<header>Buat Surat Cuti</header>
						</div>
						<div class="card-body style-default-bright">
							<div class="col-md-8">
								<div class="form-group">
									<select name="jenis" id="jenis" class="form-control" required="">
										<option value=""></option>
										<option value="Cuti Tahunan">Cuti Tahunan</option>
									</select>
									<label for="jenis">Cuti</label>
								</div>
								<div class="form-group">
									<input type="text" name="hari" class="form-control" required="" onkeypress="return isNumberKeyAngka(event)" maxlength="2" onchange="cuti_tahunan()" id="hari">
									<label for="hari">Lama Cuti (Hari)</label>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<div class="input-group date form_date"  data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						                        <input class="form-control" type="text" name="tgl_mulai" maxlength="10" id="tgl_mulai" placeholder="Tanggal Mulai" onchange="cuti_tahunan()" style="cursor: pointer;" readonly required>
						                        <span class="input-group-addon">
						                            <span class="glyphicon glyphicon-calendar">
						                            </span>
						                        </span>
						                    </div>
										</div>
										<div class="col-md-6">
											<div style="width: 100%; height: 40px; background: transparent; position: absolute; z-index: 5; top: -16px; cursor: not-allowed;"></div>
											<div class="input-group date form_date"  data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
						                        <input class="form-control" type="text" name="tgl_selesai" maxlength="10" id="tgl_selesai" placeholder="Tanggal Selesai" readonly required>
						                        <span class="input-group-addon">
						                            <span class="glyphicon glyphicon-calendar">
						                            </span>
						                        </span>
						                    </div>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="input-group date form_date"  data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
				                        <input class="form-control" type="text" name="tgl_surat" maxlength="10" id="tgl_surat" placeholder="Tanggal Surat" style="cursor: pointer;" readonly required>
				                        <span class="input-group-addon">
				                            <span class="glyphicon glyphicon-calendar">
				                            </span>
				                        </span>
				                    </div>
								</div>
								<div class="form-group">
									<textarea name="alamat" id="alamat" rows="5" class="form-control" required="" maxlength="150"></textarea>
									<label for="alamat">Alamat Pemohon</label>
								</div>
								<div class="form-group">
									<select name="type" id="type" required="" class="form-control">
										<option value=""></option>
										<option value="Pejabat">Pejabat</option>
										<option value="Non-Pejabat">Non-Pejabat</option>
									</select>
									<label for="type">-Pilih-</label>
								</div>
								<div class="form-group">
									<input type="hidden" name="tipe" value="input">
									<button class="btn btn-warning ink-reaction" type="reset">Reset</button>
									<button class="btn btn-primary ink-reaction" type="submit" name="input" value="input">Buat</button>
								</div>
							</div> <!-- end .col-md-8 -->
						</div><!--end .card-body -->
					</div><!--end .card -->
				</form>
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END FORM CUTI -->

		<!-- BEGIN DATA CUTI -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="card card-bordered style-primary">
					<div class="card-head">
						<div class="tools">
							<div class="btn-group">
								<?php include_once("$docs/colorize.php"); ?>
								<a class="btn btn-icon-toggle btn-refresh"><i class="md md-refresh"></i></a>
								<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
								<a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
							</div>
						</div>
						<header>Surat Cuti</header>
					</div>
					<div class="card-body style-default-bright">
						<div class="table-responsive">
							<table id="datatable2" class="table order-column hover" data-source="data.php">
								<thead>
									<tr>
										<th>#</th>
										<th>Jenis Surat</th>
										<th>Tgl Mulai</th>
										<th>Tgl Selesai</th>
										<th>Lama Cuti</th>
										<th width="100">Opsi</th>
									</tr>
								</thead>
							</table>
						</div><!--end .table-responsive -->
					</div><!--end .card-body -->
				</div><!--end .card -->
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END DATA CUTI -->

	</div><!--end .section-body -->
</section>