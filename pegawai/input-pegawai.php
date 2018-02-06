<div id="top"></div>

<section>
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li><a href="./">Data Pegawai</a></li>
			<li class="active">Input Data Pegawai</li>
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

		<!-- BEGIN DATA PEGAWAI -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<form class="form form-validate floating-label" method="post" action="<?=htmlspecialchars("CRUD_pegawai.php")?>" id="form-input" novalidate="novalidate">
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
							<header>Input Data Pegawai</header>
						</div>
						<div class="card-body style-default-bright">
							<div class="form-group">
								<input type="text" class="form-control" id="Name" name="nama" required data-rule-minlength="2" maxlength="50">
								<label for="Name">Nama</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="nip" name="nip" maxlength="22" required>
								<label for="nip">NIP</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="tmpt_lahir" name="tmpt_lahir" required maxlength="35">
								<label for="tmpt_lahir">Tempat Lahir</label>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" id="tgl_lahir" data-inputmask="'alias': 'date'" name="tgl_lahir" required="">
								<label for="tgl_lahir">Tanggal Lahir</label>
							</div>
							<div class="form-group">
								<label for="jkl" style="font-size: 16px;">Jenis Kelamin</label><br>
								<div class="btn-group" data-toggle="buttons" id="jkl">
									<label class="btn ink-reaction btn-default">
										<input type="radio" name="jkl" required="" value="Laki-laki">
										<i class="fa fa-male fa-fw"></i>
									</label>
									<label class="btn ink-reaction btn-default">
										<input type="radio" name="jkl" required="" value="Perempuan">
										<i class="fa fa-female fa-fw"></i>
									</label>
								</div>
							</div>
							<div class="form-group">
								<select id="agama" name="agama" class="form-control" required>
									<option value=""></option>
									<?php
									$sql_agama = $db->prepare("SELECT * FROM agama");
									$sql_agama->execute();
									while ($agm = $sql_agama->fetch(PDO::FETCH_OBJ)) {
										echo "
										<option value='$agm->id_agama'>$agm->agama</option>
										";
									}
									$sql_agama = 0;
									?>
								</select>
								<label for="agama">Agama</label>
							</div>
							<div class="form-group">
								<select id="pangkat" name="pangkat" class="form-control" required>
									<option value=""></option>
									<?php
									$sql_pkt = $db->prepare("SELECT * FROM pangkat");
									$sql_pkt->execute();
									while ($pkt = $sql_pkt->fetch(PDO::FETCH_OBJ)) {
										echo "
										<option value='$pkt->id_pangkat'>$pkt->pangkat</option>
										";
									}
									$sql_pkt = 0;
									?>
								</select>
								<label for="pangkat">Pangkat</label>
							</div>
							<div class="form-group">
								<select id="golongan" name="golongan" class="form-control" required>
									<option value=""></option>
									<?php
									$sql_gol = $db->prepare("SELECT * FROM golongan");
									$sql_gol->execute();
									while ($gol = $sql_gol->fetch(PDO::FETCH_OBJ)) {
										echo "
										<option value='$gol->id_golongan'>$gol->golongan</option>
										";
									}
									$sql_gol = 0;
									?>
								</select>
								<label for="golongan">Golongan</label>
							</div>
							<div class="form-group control-width-normal">
								<div class="input-group date demo-date">
									<div class="input-group-content">
										<input type="text" class="form-control" name="tmt_gol" required="">
										<label>TMT Golongan</label>
									</div>
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
							</div><!--end .form-group -->
							<div class="form-group">
								<select id="jabatan" name="jabatan" class="form-control" required>
									<option value=""></option>
									<?php
									$sql_jbt = $db->prepare("SELECT * FROM jabatan");
									$sql_jbt->execute();
									while ($jbt = $sql_jbt->fetch(PDO::FETCH_OBJ)) {
										echo "
										<option value='$jbt->id_jabatan'>$jbt->jabatan</option>
										";
									}
									$sql_jbt = 0;
									?>
								</select>
								<label for="jabatan">Jabatan</label>
							</div>
							<div class="form-group control-width-normal">
								<div class="input-group date demo-date">
									<div class="input-group-content">
										<input type="text" class="form-control" name="tmt_jbt" required="">
										<label>TMT Jabatan</label>
									</div>
									<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
								</div>
							</div><!--end .form-group -->
							<div class="form-group">
								<select id="eselon" name="eselon" class="form-control" required="">
									<option value=""></option>
									<?php
									$sql_ese = $db->prepare("SELECT * FROM eselon");
									$sql_ese->execute();
									while ($ese = $sql_ese->fetch(PDO::FETCH_OBJ)) {
										echo "
										<option value='$ese->id_eselon'>$ese->eselon</option>
										";
									}
									$sql_ese = 0;
									?>
								</select>
								<label for="eselon">Eselon</label>
							</div>
							<div class="form-group">
								<select id="unit_kerja" name="unit_kerja" class="form-control" required="">
									<option value=""></option>
									<?php
									$sql_unit = $db->prepare("SELECT * FROM unit_kerja WHERE id_unit != :id");
									$sql_unit->execute([':id' => 999]);
									while ($unit = $sql_unit->fetch(PDO::FETCH_OBJ)) {
										echo "
										<option value='$unit->id_unit'>$unit->unit_kerja</option>
										";
									}
									$sql_unit = 0;
									?>
								</select>
								<label for="unit_kerja">Unit Kerja</label>
							</div>
							<div class="form-group">
								<input type="text" name="pendidikan" id="pendidikan" class="form-control" maxlength="40" required="">
								<label for="pendidikan">Pendidikan</label>
							</div>
							<div class="form-group">
								<input type="text" name="thn_lulus" id="thn_lulus" class="form-control" maxlength="4" onkeypress="return isNumberKeyAngka(event)">
								<label for="thn_lulus">Tahun Lulus</label>
							</div>
							<div class="form-group">
								<input type="text" name="diklat" id="diklat" class="form-control" maxlength="30">
								<label for="diklat">Diklat Jabatan</label>
							</div>
							<div class="form-group">
								<input type="text" name="masa_kerja_thn" id="masa_kerja_thn" class="form-control" maxlength="2" required="" onkeypress="return isNumberKeyAngka(event)">
								<label for="masa_kerja_thn">Masa Kerja (Jumlah Tahun)</label>
							</div>
							<div class="form-group">
								<input type="text" name="masa_kerja_bln" id="masa_kerja_bln" class="form-control" maxlength="2" onkeypress="return isNumberKeyAngka(event)">
								<label for="masa_kerja_bln">Masa Kerja (Jumlah Bulan)</label>
							</div>
							<div class="form-group">
								<select name="status" id="status" class="form-control" required="">
									<option value=""></option>
									<option value="Aktif">Aktif</option>
									<option value="Pindah">Pindah</option>
									<option value="Pensiun">Pensiun</option>
									<option value="Berhenti">Berhenti</option>
									<option value="Meninggal Dunia">Meninggal Dunia</option>
								</select>
								<label for="status">Status Pegawai</label>
							</div>
							<div class="form-group">
								<textarea name="ket" id="ket" class="form-control" rows="3"></textarea>
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
		<!-- END DATA PEGAWAI -->

	</div><!--end .section-body -->
</section>