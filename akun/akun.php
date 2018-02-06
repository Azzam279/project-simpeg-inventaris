<section>
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li class="active">Akun</li>
		</ol>
	</div>
	<div class="section-body contain-lg">

		<?php
		include_once("$docs/database/koneksi.php");
		?>

		<!-- BEGIN DATA AKUN -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<form class="form form-validate floating-label" method="post" action="<?=htmlspecialchars("CRUD_akun.php")?>" id="form-akun" novalidate="novalidate">
					<div class="card card-bordered style-primary">
						<div class="card-head">
							<div class="tools">
								<div class="btn-group">
									<?php include("$docs/colorize.php"); ?>
									<a class="btn btn-icon-toggle btn-refresh"><i class="md md-refresh"></i></a>
									<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
									<a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
								</div>
							</div>
							<header>Input Data Akun Admin</header>
						</div>
						<div class="card-body style-default-bright">
							<div class="form-group">
								<input type="text" class="form-control" id="user" name="user" required="" maxlength="50">
								<label for="user">Username</label>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" id="pass" name="pass" maxlength="150" required="">
								<label for="user">Password</label>
							</div>
							<div class="form-group">
								<input type="password" class="form-control" id="pass2" name="pass2" maxlength="150" required="">
								<label for="user2">Konfirmasi Password</label>
							</div>
							<div class="form-group">
								<select class="form-control" id="level" name="level" required="">
									<option value=""></option>
									<option value="999">FULL HAK AKSES</option>
									<?php
									$sql_satuan_kerja = $db->prepare("SELECT * FROM unit_kerja WHERE id_unit != :id");
									$sql_satuan_kerja->execute([':id' => 999]);
									while ($sk = $sql_satuan_kerja->fetch(PDO::FETCH_OBJ)) {
										echo "
										<option value='$sk->id_unit'>$sk->unit_kerja</option>
										";
									}
									$sql_satuan_kerja = 0;
									?>
								</select>
								<label for="level">Level Admin</label>
							</div>
							<div class="form-group">
								<input type="hidden" name="input" value="input">
								<button class="btn btn-warning ink-reaction" type="reset">Reset</button>
								<button type="submit" class="btn btn-raised btn-success ink-reaction">Simpan <i class="fa fa-check"></i></button>
							</div>
						</div><!--end .card-body -->
					</div><!--end .card -->
				</form>
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END DATA AKUN -->

		<!-- BEGIN LIST DATA AKUN -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="card card-bordered style-primary">
					<div class="card-head">
						<div class="tools">
							<div class="btn-group">
								<?php include("$docs/colorize.php"); ?>
								<a class="btn btn-icon-toggle btn-refresh"><i class="md md-refresh"></i></a>
								<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
								<a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
							</div>
						</div>
						<header>List Data Akun Admin</header>
					</div>
					<div class="card-body style-default-bright">
						<table id="datatable2" class="table order-column hover" data-source="data.php">
							<thead>
								<tr>
									<th width="40">No</th>
									<th>Username</th>
									<th width="100">Opsi</th>
								</tr>
							</thead>
						</table>
					</div><!--end .card-body -->
				</div><!--end .card -->
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END LIST DATA AKUN -->

	</div><!--end .section-body -->
</section>