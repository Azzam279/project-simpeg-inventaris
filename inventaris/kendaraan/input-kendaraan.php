<div id="top"></div>

<section>
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li><a href="./">Data Kendaraan</a></li>
			<li class="active">Input Data Kendaraan</li>
		</ol>
	</div>
	<div class="section-body contain-lg">

		<?php
		include_once("$docs/database/koneksi.php");
		//jika bukan full hak akses maka arahkan ke halaman 404.php
		if ($_SESSION['id_level'] != "999") {
			header("location: $host/404.php");
		}
		?>

		<!-- BEGIN DATA KENDARAAN -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<form class="form form-validate floating-label" method="post" action="<?=htmlspecialchars("CRUD_kendaraan.php")?>" id="form-input" novalidate="novalidate">
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
							<header>Input Data Kendaraan</header>
						</div>
						<div class="card-body style-default-bright">
							<div class="form-group">
								<select id="sub-unit" name="sub_unit" class="form-control" required="">
									<option value=""></option>
									<option value="Bidang Pemerintahan">Bidang Pemerintahan</option>
									<option value="Bidang Pembangunan">Bidang Pembangunan</option>
									<option value="Bidang Administrasi Umum">Bidang Administrasi Umum</option>
								</select>
								<label for="sub-unit">Sub Unit Organisasi</label>
							</div>
							<div class="form-group">
								<select id="upb" name="upb" class="form-control" required="">
									<option value=""></option>
								</select>
								<label for="upb">U P B</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="kode" name="kode" required="" maxlength="15">
								<label for="kode">Kode Kendaraan</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="nama" name="nama" required="" maxlength="50">
								<label for="nama">Nama / Jenis Kendaraan</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="merk" name="merk" maxlength="30">
								<label for="merk">Merk Kendaraan</label>
							</div>
							<div class="form-group">
								<select id="thn" name="thn" class="form-control">
									<option value=""></option>
									<?php
					                $year = date('Y');
					                for ($i = (int)$year; $i >= 1945; $i--) {
					                  echo "<option value='$i'>$i</option>";
					                }
					                ?>
								</select>
								<label for="thn">Tahun Pembelian</label>
							</div>
							<div class="form-group">
								<select id="cp" name="cp" class="form-control" required="">
									<option value=""></option>
									<option value="Pembelian">Pembelian</option>
									<option value="Peminjaman">Peminjaman</option>
								</select>
								<label for="cp">Cara Peroleh</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="no_rangka" name="no_rangka" maxlength="20">
								<label for="no_rangka">No. Rangka</label>
							</div>
							<div class="form-group">
								<div class="row" style="margin: 0 1px;">
									<div class="col-md-6" style="padding-left: 0;">
										<input type="text" class="form-control" id="no_pol" name="no_pol" maxlength="18" required="">
										<label for="no_pol">No. Polisi</label>
									</div>
									<div class="col-md-3" style="padding-left: 0;">
										<select id="no_pol2" name="no_pol_bln" class="form-control" required="">
											<option value=""></option>
											<?php
							                $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
							                foreach ($months as $key => $value) {
							                	echo "<option value='".($key+1)."'>$value</option>";
							                }
							                ?>
										</select>
										<label for="no_pol2">No. Polisi (Bulan)</label>
									</div>
									<div class="col-md-3" style="padding-left: 0;">
										<select id="no_pol1" name="no_pol_thn" class="form-control" required="">
											<option value=""></option>
											<?php
							                $year = date('Y');
							                for ($i = (int)$year; $i >= 1945; $i--) {
							                  echo "<option value='$i'>$i</option>";
							                }
							                ?>
										</select>
										<label for="no_pol1">No. Polisi (Tahun)</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="no_bpkb" name="no_bpkb" maxlength="15">
								<label for="no_bpkb">No. BPKB</label>
							</div>
							<div class="form-group">
								<select id="kon" name="kon" class="form-control" required="">
									<option value=""></option>
									<option value="Baik">Baik</option>
									<option value="Kurang Baik">Kurang Baik</option>
									<option value="Rusak Berat">Rusak Berat</option>
								</select>
								<label for="kon">Kondisi Kendaraan</label>
							</div>
							<!-- <div class="form-group">
								<select id="unit" name="unit" class="form-control" required="">
									<option value=""></option>
									<?php
									// $sql_satuan_kerja = $db->prepare("SELECT * FROM unit_kerja");
									// $sql_satuan_kerja->execute();
									// while ($sk = $sql_satuan_kerja->fetch(PDO::FETCH_OBJ)) {
									// 	echo "
									// 	<option value='$sk->id_unit'>$sk->unit_kerja</option>
									// 	";
									// }
									// $sql_satuan_kerja = 0;
									?>
								</select>
								<label for="unit">Satuan Unit</label>
							</div> -->
							<div class="form-group">
								<input type="text" name="harga" id="harga" class="form-control auto" data-a-sep="." data-a-dec="," data-a-sign="Rp " required="">
								<label for="harga">Harga</label>
							</div>
							<div class="form-group">
								<textarea name="ket" id="ket" class="form-control" rows="3" maxlength="150"></textarea>
								<label for="ket">Keterangan</label>
							</div>
						</div><!--end .card-body -->
						<div class="card-actionbar">
							<div class="card-actionbar-row">
								<input type="hidden" name="input" value="input">
								<button class="btn btn-warning ink-reaction" type="reset">Reset</button>
								<button type="submit" class="btn btn-raised btn-success ink-reaction">Simpan <i class="fa fa-check"></i></button>
							</div>
						</div><!--end .card-actionbar -->
					</div><!--end .card -->
				</form>
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END DATA KENDARAAN -->

	</div><!--end .section-body -->
</section>