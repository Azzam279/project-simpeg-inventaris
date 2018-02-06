<?php
//cek apakah variable GET tgl ada atau tdk, jika tdk maka arahkan halaman ke index absensi
if (empty($_GET['tgl'])) {
	header("location: ./");
}

include_once("$docs/function.php");
?>
<section>
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li><a href="../">Data Pegawai</a></li>
			<li><a href="./">Data Absensi</a></li>
			<li class="active">Detail Absensi Pegawai</li>
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
						<header style="line-height: 34px;">Detail Data Absensi Pegawai Tanggal <font color="lime"><?=indo_date($_GET['tgl'])?></font></header>
					</div>
					<div class="card-body style-default-bright">

						<div class="pull-right">
							<button class="btn btn-default" onclick="window.open('<?="$host/pegawai/absensi/cetak.php?tgl=$_GET[tgl]"?>','_blank','scrollbars=yes, resizeable=yes, top=0, left=100, width=1170, height=660')"><i class="fa fa-print"></i> Cetak</button>
						</div>
						<div class="clearfix"></div><p></p>

						<?php
						$sql = $db->prepare("SELECT * FROM unit_kerja");
						$sql->execute();
						$sql_pgw = $db->prepare("SELECT absensi.*, pegawai.id_pegawai, pegawai.nip, pegawai.nama FROM absensi, pegawai WHERE absensi.no_pegawai = pegawai.id_pegawai AND pegawai.unit_kerja = :unit AND absensi.tgl = :tgl AND pegawai.status != :status");
						//jika data yg hndak ditampilkan tdk ditemukan, maka redirect ke halaman index absensi
						if ($sql->rowCount() < 1) {
							header("location: ./");
						}
						?>
						<div class="table-responsive">
							<table class="table table-hover table-bordered">
								<thead>
									<tr>
										<th width="40">#</th>
										<th>NIP & Nama</th>
										<th width="105">Hadir</th>
										<th width="100">Izin</th>
										<th width="105">Sakit</th>
										<th width="100">Cuti</th>
										<th width="90">Tugas Luar</th>
										<th width="100">Tanpa Kabar</th>
									</tr>
								</thead>
								<tbody>
								<?php
								$no = 1;
								while ($unit = $sql->fetch(PDO::FETCH_OBJ)) {
									echo "<tr><td colspan='8'>$unit->unit_kerja</td></tr>";
									$sql_pgw->execute(array(":tgl" => $_GET['tgl'], ":status" => "Pindah", ":unit" => $unit->id_unit));
									while ($data = $sql_pgw->fetch(PDO::FETCH_OBJ)) {
										$hadir  = (!empty($data->hadir)) ? "checked" : "";
										$izin  = (!empty($data->izin)) ? "checked" : "";
										$sakit  = (!empty($data->sakit)) ? "checked" : "";
										$cuti  = (!empty($data->cuti)) ? "checked" : "";
										$tl  = (!empty($data->tl)) ? "checked" : "";
										$tk  = (!empty($data->tanpa_kabar)) ? "checked" : "";
										$stat_hadir = (!empty($data->hadir)) ? "1" : "0";
										$stat_izin = (!empty($data->izin)) ? "1" : "0";
										$stat_sakit = (!empty($data->sakit)) ? "1" : "0";
										$stat_cuti = (!empty($data->cuti)) ? "1" : "0";
										$stat_tl = (!empty($data->tl)) ? "1" : "0";
										$stat_tk = (!empty($data->tanpa_kabar)) ? "1" : "0";
										echo "
										<tr>
											<td>$no</td>
											<td>$data->nama<br>$data->nip <span id='notif-$no'></span></td>
											<td>
												<div class='funkyradio'>
											        <div class='funkyradio-primary'>
											            <input type='radio' class='absensi' name='absensi-$no' id='hadir-$no' value='$data->id_absen' status='$stat_hadir' nomor='$no' $hadir />
											            <label for='hadir-$no' class='funky-check' style='margin-top: 0;' id='label-$no'>Hadir</label>
											        </div>
											    </div>
											</td>
											<td>
												<div class='funkyradio'>
											        <div class='funkyradio-primary'>
											            <input type='radio' class='absensi' name='absensi-$no' id='izin-$no' value='$data->id_absen' status='$stat_izin' nomor='$no' $izin />
											            <label for='izin-$no' class='funky-check' style='margin-top: 0;' id='label-$no'>Izin</label>
											        </div>
											    </div>
											</td>
											<td>
												<div class='funkyradio'>
											        <div class='funkyradio-primary'>
											            <input type='radio' class='absensi' name='absensi-$no' id='sakit-$no' value='$data->id_absen' status='$stat_sakit' nomor='$no' $sakit />
											            <label for='sakit-$no' class='funky-check' style='margin-top: 0;' id='label-$no'>Sakit</label>
											        </div>
											    </div>
											</td>
											<td>
												<div class='funkyradio'>
											        <div class='funkyradio-primary'>
											            <input type='radio' class='absensi' name='absensi-$no' id='cuti-$no' value='$data->id_absen' status='$stat_cuti' nomor='$no' $cuti />
											            <label for='cuti-$no' class='funky-check' style='margin-top: 0;' id='label-$no'>Cuti</label>
											        </div>
											    </div>
											</td>
											<td>
												<div class='funkyradio'>
											        <div class='funkyradio-primary'>
											            <input type='radio' class='absensi' name='absensi-$no' id='tl-$no' value='$data->id_absen' status='$stat_tl' nomor='$no' $tl />
											            <label for='tl-$no' class='funky-check' style='margin-top: 0;' id='label-$no'>TL</label>
											        </div>
											    </div>
											</td>
											<td>
												<div class='funkyradio'>
											        <div class='funkyradio-primary'>
											            <input type='radio' class='absensi' name='absensi-$no' id='tk-$no' value='$data->id_absen' status='$stat_tk' nomor='$no' $tk />
											            <label for='tk-$no' class='funky-check' style='margin-top: 0;' id='label-$no'>TK</label>
											        </div>
											    </div>
											</td>
										</tr>
										";
										$no++;
									}
								}
								//tutup koneksi db
								$sql = 0;
								$sql_pgw = 0;
								?>
								</tbody>
							</table>
						</div>

					</div><!--end .card-body -->
				</div><!--end .card -->
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END DATA PEGAWAI -->

	</div><!--end .section-body -->
</section>