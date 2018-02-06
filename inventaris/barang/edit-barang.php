<div id="top"></div>

<section>
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li><a href="./">Data Barang</a></li>
			<li class="active">Edit Data Barang</li>
		</ol>
	</div>
	<div class="section-body contain-lg">

		<?php
		include_once("$docs/database/koneksi.php");
		$sql = $db->prepare("SELECT * FROM barang WHERE id_barang = :id");
		$sql->execute([':id' => $_GET['edit']]);
		$data = $sql->fetch(PDO::FETCH_OBJ);
		if ($sql->rowCount() < 1) { //jika data tdk ditemukan redirect ke halaman index
			header("location: ./");
		}
		$sql = 0;
		?>

		<!-- BEGIN DATA BARANG -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<form class="form form-validate floating-label" method="post" action="<?=htmlspecialchars("CRUD_barang.php")?>" id="form-edit" novalidate="novalidate">
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
							<header>Edit Data Barang</header>
						</div>
						<div class="card-body style-default-bright">
							<div class="form-group">
								<input type="hidden" name="id" value="<?=$data->id_barang?>">
								<select id="satuan_kerja" name="satuan_kerja" class="form-control" required="">
									<option value=""></option>
									<?php
									if ($_SESSION['id_level'] == "999") {
										$sql_satuan_kerja = $db->prepare("SELECT * FROM unit_kerja WHERE id_unit != :id");
									} else {
										$sql_satuan_kerja = $db->prepare("SELECT * FROM unit_kerja WHERE id_unit != :id AND id_unit = $_SESSION[id_level]");
									}
									$sql_satuan_kerja->execute([':id' => 999]);
									while ($sk = $sql_satuan_kerja->fetch(PDO::FETCH_OBJ)) {
										if ($sk->id_unit == $data->satuan_kerja) {
											echo "
											<option value='$sk->id_unit' selected>$sk->unit_kerja</option>
											";
										} else {
											echo "
											<option value='$sk->id_unit'>$sk->unit_kerja</option>
											";
										}
									}
									$sql_satuan_kerja = 0;
									?>
								</select>
								<label for="satuan_kerja">Satuan Kerja</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="ruangan" name="ruangan" required="" maxlength="25" value="<?=$data->ruangan?>">
								<label for="ruangan">Ruangan</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="nm_barang" name="nm_barang" required="" maxlength="50" value="<?=$data->nm_barang?>">
								<label for="nm_barang">Jenis / Nama Barang</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="model" name="model" maxlength="35" value="<?=$data->model?>">
								<label for="model">Model / Merk</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="kd_barang" name="kd_barang" maxlength="10" value="<?=$data->kode_barang?>">
								<label for="kd_barang">Kode Barang</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="sn" name="sn" maxlength="20" value="<?=$data->sn_pabrik?>">
								<label for="sn">SN Pabrik</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="size" name="size" maxlength="20" value="<?=$data->ukuran?>">
								<label for="size">Ukuran</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="bahan" name="bahan" maxlength="30" value="<?=$data->bahan?>">
								<label for="bahan">Bahan</label>
							</div>
							<div class="form-group">
								<select id="thn" name="thn" class="form-control">
									<option value=""></option>
									<?php
					                $year = date('Y');
					                for ($i = (int)$year; $i >= 1945; $i--) {
					                	if ($i == $data->thn_buat_beli) {
					                		echo "<option value='$i' selected>$i</option>";
					                	} else {
					                		echo "<option value='$i'>$i</option>";
					                	}
					                }
					                ?>
								</select>
								<label for="thn">Tahun Pembuatan / Pembelian</label>
							</div>
							<div class="form-group">
								<input type="text" name="jml" id="jml" class="form-control" maxlength="4" onkeypress="return isNumberKeyAngka(event)" required="" value="<?=$data->jumlah_barang?>">
								<label for="jml">Jumlah Barang</label>
							</div>
							<fieldset style="border: solid 1px #D2D2D2; padding: 8px; border-radius: 6px;">
								<h4><b><u>Kondisi Barang</u></b> <span id="info-kon"></span></h4>
								<div class="form-group">
									<input type="text" name="baik" id="baik" class="form-control" onkeypress="return isNumberKeyAngka(event)" maxlength="4" title="Baik" required="" value="<?=$data->baik?>">
									<label for="baik">Baik</label>
								</div>
								<div class="form-group">
									<input type="text" id="kurang" name="kurangbaik" class="form-control" onkeypress="return isNumberKeyAngka(event)" maxlength="4" title="Kurang Baik" required="" value="<?=$data->kurangbaik?>">
									<label for="kurang">Kurang Baik</label>
								</div>
								<div class="form-group">
									<input type="text" id="rusak" name="rusakberat" class="form-control" onkeypress="return isNumberKeyAngka(event)" maxlength="4" title="Rusak Berat" required="" value="<?=$data->rusakberat?>">
									<label for="rusak">Rusak Berat</label>
								</div>
							</fieldset>
							<div class="form-group">
								<textarea name="ket" id="ket" class="form-control" rows="3"><?=$data->ket?></textarea>
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
		<!-- END DATA BARANG -->

	</div><!--end .section-body -->
</section>