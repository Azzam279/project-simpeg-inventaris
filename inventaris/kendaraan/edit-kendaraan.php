<div id="top"></div>

<section>
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li><a href="./">Data Kendaraan</a></li>
			<li class="active">Edit Data Kendaraan</li>
		</ol>
	</div>
	<div class="section-body contain-lg">

		<?php
		include_once("$docs/database/koneksi.php");
		//jika bukan full hak akses maka arahkan ke halaman 404.php
		if ($_SESSION['id_level'] != "999") {
			header("location: $host/404.php");
		}

		$sql = $db->prepare("SELECT * FROM kendaraan WHERE id_kendaraan = :id");
		$sql->execute([':id' => $_GET['edit']]);
		$data = $sql->fetch(PDO::FETCH_OBJ);
		if ($sql->rowCount() < 1) {
			header("location: ../");
		}
		$sql = 0;

		$no_pol = explode("-", $data->no_polisi);
		$old = $no_pol[1]."-".$no_pol[2];
		$harga = str_replace("Rp ", "", str_replace(".", "", str_replace(",00", "", $data->harga)));
		?>

		<!-- BEGIN DATA KENDARAAN -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<form class="form form-validate floating-label" method="post" action="<?=htmlspecialchars("CRUD_kendaraan.php")?>" id="form-edit" novalidate="novalidate">
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
							<header>Edit Data Kendaraan</header>
						</div>
						<div class="card-body style-default-bright">
							<div class="form-group">
								<select id="sub-unit" name="sub_unit" class="form-control" required="">
									<option value=""></option>
									<option value="Bidang Pemerintahan" <?=($data->sub_unit=="Bidang Pemerintahan") ? "selected" : ""?>>Bidang Pemerintahan</option>
									<option value="Bidang Pembangunan" <?=($data->sub_unit=="Bidang Pembangunan") ? "selected" : ""?>>Bidang Pembangunan</option>
									<option value="Bidang Administrasi Umum" <?=($data->sub_unit=="Bidang Administrasi Umum") ? "selected" : ""?>>Bidang Administrasi Umum</option>
								</select>
								<label for="sub-unit">Sub Unit Organisasi</label>
							</div>
							<div class="form-group">
								<select id="upb" name="upb" class="form-control" required="">
									<option value=""></option>
								</select>
								<input type="hidden" id="old_upb" value="<?=$data->upb?>">
								<label for="upb">U P B</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="kode" name="kode" required="" maxlength="15" value="<?=$data->kode_kendaraan?>">
								<label for="kode">Kode Kendaraan</label>
								<input type="hidden" name="id" value="<?=$data->id_kendaraan?>">
								<input type="hidden" name="old_thn_bln" value="<?=$old?>">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="nama" name="nama" required="" maxlength="50" value="<?=$data->nama?>">
								<label for="nama">Nama / Jenis Kendaraan</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="merk" name="merk" maxlength="30" value="<?=$data->merk?>">
								<label for="merk">Merk Kendaraan</label>
							</div>
							<div class="form-group">
								<select id="thn" name="thn" class="form-control">
									<option value=""></option>
									<?php
					                $year = date('Y');
					                for ($i = (int)$year; $i >= 1945; $i--) {
					                	if ($i == $data->tahun) {
					                		echo "<option value='$i' selected>$i</option>";
					                	} else {
					                		echo "<option value='$i'>$i</option>";
					                	}
					                }
					                ?>
								</select>
								<label for="thn">Tahun Pembelian</label>
							</div>
							<div class="form-group">
								<select id="cp" name="cp" class="form-control" required="">
									<option value=""></option>
									<option value="Pembelian" <?=($data->cara_perolehan=="Pembelian") ? "selected" : ""?>>Pembelian</option>
									<option value="Peminjaman" <?=($data->cara_perolehan=="Peminjaman") ? "selected" : ""?>>Peminjaman</option>
								</select>
								<label for="cp">Cara Peroleh</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="no_rangka" name="no_rangka" maxlength="20" value="<?=$data->no_rangka?>">
								<label for="no_rangka">No. Rangka</label>
							</div>
							<div class="form-group">
								<div class="row" style="margin: 0 1px;">
									<div class="col-md-6" style="padding-left: 0;">
										<input type="text" class="form-control" id="no_pol" name="no_pol" maxlength="18" required="" value="<?=$no_pol[0]?>">
										<label for="no_pol">No. Polisi</label>
									</div>
									<div class="col-md-3" style="padding-left: 0;">
										<select id="no_pol2" name="no_pol_bln" class="form-control" required="">
											<option value=""></option>
											<?php
							                $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
							                foreach ($months as $key => $value) {
							                	if (($key+1) == $no_pol[1]) {
							                		echo "<option value='".($key+1)."' selected>$value</option>";
							                	} else {
							                		echo "<option value='".($key+1)."'>$value</option>";
							                	}
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
							                	if ($i == $no_pol[2]) {
							                		echo "<option value='$i' selected>$i</option>";
							                	} else {
							                		echo "<option value='$i'>$i</option>";
							                	}
							                }
							                ?>
										</select>
										<label for="no_pol1">No. Polisi (Tahun)</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="no_bpkb" name="no_bpkb" maxlength="15" value="<?=$data->no_bpkb?>">
								<label for="no_bpkb">No. BPKB</label>
							</div>
							<div class="form-group">
								<select id="kon" name="kon" class="form-control" required="">
									<option value=""></option>
									<option value="Baik" <?=($data->keadaan=="Baik") ? "selected" : ""?>>Baik</option>
									<option value="Kurang Baik" <?=($data->keadaan=="Kurang Baik") ? "selected" : ""?>>Kurang Baik</option>
									<option value="Rusak Berat" <?=($data->keadaan=="Rusak Berat") ? "selected" : ""?>>Rusak Berat</option>
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
									// 	if ($sk->id_unit == $data->satuan_unit) {
									// 		echo "
									// 		<option value='$sk->id_unit' selected>$sk->unit_kerja</option>
									// 		";
									// 	} else {
									// 		echo "
									// 		<option value='$sk->id_unit'>$sk->unit_kerja</option>
									// 		";
									// 	}
									// }
									// $sql_satuan_kerja = 0;
									?>
								</select>
								<label for="unit">Satuan Unit</label>
							</div> -->
							<div class="form-group">
								<input type="text" name="harga" id="harga" class="form-control auto" data-a-sep="." data-a-dec="," data-a-sign="Rp " required="" value="<?=$harga?>">
								<label for="harga">Harga</label>
							</div>
							<div class="form-group">
								<textarea name="ket" id="ket" class="form-control" rows="3" maxlength="150"><?=$data->ket?></textarea>
								<label for="ket">Keterangan</label>
							</div>
						</div><!--end .card-body -->
						<div class="card-actionbar">
							<div class="card-actionbar-row">
								<input type="hidden" name="edit" value="edit">
								<button class="btn btn-warning ink-reaction" type="reset">Reset</button>
								<button type="submit" class="btn btn-raised btn-success ink-reaction">Perbarui <i class="fa fa-check"></i></button>
							</div>
						</div><!--end .card-actionbar -->
					</div><!--end .card -->
				</form>
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END DATA KENDARAAN -->

	</div><!--end .section-body -->
</section>