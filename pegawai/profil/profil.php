<section>
	<div class="section-header">
		<ol class="breadcrumb" style="display: inline-block;">
			<li><a href="<?=$host?>">Home</a></li>
			<li class="active">Profil <?=$_SESSION['nama']?></li>
		</ol>
	</div>
	<div class="section-body contain-lg">

		<?php
		include_once("$docs/database/koneksi.php");
		$sql = $db->prepare("SELECT * FROM pegawai, pangkat, jabatan, golongan, eselon, unit_kerja, agama WHERE pegawai.no_pangkat = pangkat.id_pangkat AND pegawai.no_jabatan = jabatan.id_jabatan AND pegawai.no_eselon = eselon.id_eselon AND pegawai.no_golongan = golongan.id_golongan AND pegawai.unit_kerja = unit_kerja.id_unit AND pegawai.no_agama = agama.id_agama AND pegawai.id_pegawai = :id");
		$sql->execute([':id' => $_SESSION['id']]);
		$data = $sql->fetch(PDO::FETCH_OBJ);
		$sql = 0;

		//foto pegawai
		$foto = (empty($data->foto)) ? "no-photo-available.jpg" : $data->foto;
		?>

		<!-- BEGIN PROFIL -->
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="card tabs-left style-default-light">
					<ul class="card-head nav nav-tabs" data-toggle="tabs">
						<li class="active"><a href="#first5">Personal</a></li>
						<li><a href="#second5">Pangkat, Jabatan,<br>Gol. Ruang, Eselon, Unit Kerja</a></li>
						<li><a href="#third5">Pendidikan</a></li>
						<li><a href="#fourth5">Absensi</a></li>
					</ul>
					<div class="card-body tab-content style-default-bright">
						<div class="tab-pane active" id="first5">
							<div class="row">
								<div class="col-md-9">
									<table>
										<tr>
											<td>NIP</td>
											<td width="80" align="right">:</td>
											<td><?=$data->nip?></td>
										</tr>
										<tr>
											<td>Nama</td>
											<td align="right">:</td>
											<td><?=$data->nama?></td>
										</tr>
										<tr>
											<td>Tempat, Tanggal Lahir</td>
											<td align="right">:</td>
											<td><?=$data->tmpt_lahir?>, <?=$data->tgl_lahir?></td>
										</tr>
										<tr>
											<td>Jenis Kelamin</td>
											<td align="right">:</td>
											<td><?=$data->jkl?></td>
										</tr>
										<tr>
											<td>Agama</td>
											<td align="right">:</td>
											<td><?=$data->agama?></td>
										</tr>
										<tr>
											<td>Status Pegawai</td>
											<td align="right">:</td>
											<td><?=$data->status?></td>
										</tr>
										<tr>
											<td>Masa Kerja</td>
											<td align="right">:</td>
											<td><?=$data->masa_kerja_thn?> Tahun <?=$data->masa_kerja_bln?> Bulan</td>
										</tr>
									</table>
								</div>
								<div class="col-md-3">
									<div>
										<center>
											<div id="uploads" class="thumbnail" style="display: inline-block;">
												<img src="<?="$host/images/pegawai/$foto"?>" alt="foto-pegawai" class="img-reponsive" style="max-width: 155px;">
											</div>
										</center>
									</div>
									<div>
										<center>
											<form method="post" enctype="multipart/form-data" id="form-foto">
											<input type="file" name="foto" required="" class="form-control" id="foto-pgw"><p></p>
											<p id="showpesan"></p>
											</form>
										</center>
									</div>
								</div>
							</div>
						</div>
						<div class="tab-pane" id="second5">
							<table>
								<tr>
									<td width="150">Jabatan</td>
									<td align="right">:</td>
									<td><?=$data->jabatan?></td>
								</tr>
								<tr>
									<td>TMT Jabatan</td>
									<td align="right">:</td>
									<td><?=$data->tmt_jabatan?></td>
								</tr>
								<tr>
									<td>Gol. Ruang</td>
									<td align="right">:</td>
									<td><?=$data->golongan?></td>
								</tr>
								<tr>
									<td>TMT Gol. Ruang</td>
									<td align="right">:</td>
									<td><?=$data->tmt_golongan?></td>
								</tr>
								<tr>
									<td>Pangkat</td>
									<td align="right">:</td>
									<td><?=$data->pangkat?></td>
								</tr>
								<tr>
									<td>Eselon</td>
									<td align="right">:</td>
									<td><?=$data->eselon?></td>
								</tr>
								<tr>
									<td>Unit Kerja</td>
									<td align="right">:</td>
									<td><?=$data->unit_kerja?></td>
								</tr>
								<tr>
									<td>Diklat Jabatan Terakhir</td>
									<td align="right">:</td>
									<td><?=$data->diklat_jabatan?></td>
								</tr>
								<tr>
									<td>Keterangan</td>
									<td align="right">:</td>
									<td><?=$data->ket?></td>
								</tr>
							</table>
						</div>
						<div class="tab-pane" id="third5">
							<table>
								<tr>
									<td width="100">Pendidikan</td>
									<td align="right">:</td>
									<td><?=$data->pendidikan?></td>
								</tr>
								<tr>
									<td>Tahun Lulus</td>
									<td align="right">:</td>
									<td><?=($data->thn_lulus!="") ? $data->thn_lulus : "-"?></td>
								</tr>
							</table>
						</div>
						<div class="tab-pane" id="fourth5">
							<?php echo "<h4><b>Absensi Tahun ".date("Y")."</b></h4>"; ?>
							<table class="table table-hover table-bordered">
							<?php
							$sql_hadir = $db->prepare("SELECT SUM(hadir) as hadir FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");
							$sql_izin = $db->prepare("SELECT SUM(izin) as izin FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");
							$sql_sakit = $db->prepare("SELECT SUM(sakit) as sakit FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");
							$sql_cuti = $db->prepare("SELECT SUM(cuti) as cuti FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");
							$sql_tl = $db->prepare("SELECT SUM(tl) as tl FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");
							$sql_tk = $db->prepare("SELECT SUM(tanpa_kabar) as tk FROM absensi WHERE tgl LIKE :tgl AND no_pegawai = :id_pgw");

							$thn = date("Y");
							$nm_bln = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
							$arr_bln = array("01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12");
							foreach ($arr_bln as $i => $bln) {
								$sql_hadir->execute(array(":tgl" => "%$thn-$bln%", ":id_pgw" => $data->id_pegawai));
								$sql_izin->execute(array(":tgl" => "%$thn-$bln%", ":id_pgw" => $data->id_pegawai));
								$sql_sakit->execute(array(":tgl" => "%$thn-$bln%", ":id_pgw" => $data->id_pegawai));
								$sql_cuti->execute(array(":tgl" => "%$thn-$bln%", ":id_pgw" => $data->id_pegawai));
								$sql_tl->execute(array(":tgl" => "%$thn-$bln%", ":id_pgw" => $data->id_pegawai));
								$sql_tk->execute(array(":tgl" => "%$thn-$bln%", ":id_pgw" => $data->id_pegawai));
								$hadir = $sql_hadir->fetch(PDO::FETCH_OBJ);
								$izin = $sql_izin->fetch(PDO::FETCH_OBJ);
								$sakit = $sql_sakit->fetch(PDO::FETCH_OBJ);
								$cuti = $sql_cuti->fetch(PDO::FETCH_OBJ);
								$tl = $sql_tl->fetch(PDO::FETCH_OBJ);
								$tk = $sql_tk->fetch(PDO::FETCH_OBJ);
								$ha = (!empty($hadir->hadir)) ? $hadir->hadir : 0;
								$iz = (!empty($izin->izin)) ? $izin->izin : 0;
								$sa = (!empty($sakit->sakit)) ? $sakit->sakit : 0;
								$cu = (!empty($cuti->cuti)) ? $cuti->cuti : 0;
								$tu = (!empty($tl->tl)) ? $tl->tl : 0;
								$ta = (!empty($tk->tk)) ? $tk->tk : 0;

								if (date('m') == $bln) {
									echo "
									<tr class='info'>
										<td width='100'>$nm_bln[$i]</td>
										<td align='right'>:</td>
										<td>Hadir = $ha</td>
										<td>Izin = $iz</td>
										<td>Sakit = $sa</td>
										<td>Cuti = $cu</td>
										<td>Tugas Luar = $tu</td>
										<td>Tanpa Kabar = $ta</td>
									</tr>
									";
								} else {
									echo "
									<tr>
										<td width='100'>$nm_bln[$i]</td>
										<td align='right'>:</td>
										<td>Hadir = $ha</td>
										<td>Izin = $iz</td>
										<td>Sakit = $sa</td>
										<td>Cuti = $cu</td>
										<td>Tugas Luar = $tu</td>
										<td>Tanpa Kabar = $ta</td>
									</tr>
									";
								}
							}
							//tutup koneksi db
							$sql_jml = 0;
							$sql_hadir = 0;
							$sql_izin = 0;
							$sql_sakit = 0;
							$sql_cuti = 0;
							$sql_tl = 0;
							$sql_tk = 0;
							?>
							</table>
						</div>
					</div><!--end .card-body -->
				</div><!--end .card -->
			</div><!--end .col -->
		</div><!--end .row -->
		<!-- END PROFIL -->

	</div><!--end .section-body -->
</section>