<!-- BEGIN MENUBAR-->
<div id="menubar" class="">
	<div class="menubar-fixed-panel">
		<div>
			<a class="btn btn-icon-toggle btn-default menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
				<i class="fa fa-bars"></i>
			</a>
		</div>
		<div class="expanded">
			<a href="<?=$host?>">
				<span class="text-lg text-bold text-primary ">SIMPEG & INVENTARIS</span>
			</a>
		</div>
	</div>
	<div class="menubar-scroll-panel">

		<!-- BEGIN MAIN MENU -->
		<ul id="main-menu" class="gui-controls">

			<!-- BEGIN DASHBOARD -->
			<li class="<?=empty($aktif) ? "active": ""?>">
				<a href="<?=$host?>">
					<div class="gui-icon"><i class="md md-home"></i></div>
					<span class="title">Dashboard</span>
				</a>
			</li><!--end /menu-li -->
			<!-- END DASHBOARD -->

			<?php if (isset($_SESSION['admin'])) : //login as admin ?>

			<!-- BEGIN PEGAWAI -->
			<li class="<?=($aktif == "pegawai") ? "active": ""?>">
				<a href="<?="$host/pegawai/"?>">
					<div class="gui-icon"><i class="fa fa-users"></i></div>
					<span class="title">Pegawai</span>
				</a>
			</li><!--end /menu-li -->
			<!-- END PEGAWAI -->

			<!-- BEGIN DATA MASTER PEGAWAI -->
			<li class="gui-folder <?=($aktif == "master-pegawai") ? "active expanding": ""?>">
				<a>
					<div class="gui-icon"><i class="md md-contacts"></i></div>
					<span class="title">Data Master Pegawai</span>
				</a>
				<!--start submenu -->
				<ul>
					<li><a href="<?="$host/pegawai/pangkat/"?>" ><span class="title">Pangkat</span></a></li>
					<li><a href="<?="$host/pegawai/golongan/"?>" ><span class="title">Golongan</span></a></li>
					<li><a href="<?="$host/pegawai/jabatan/"?>" ><span class="title">Jabatan</span></a></li>
					<li><a href="<?="$host/pegawai/eselon/"?>" ><span class="title">Eselon</span></a></li>
					<li><a href="<?="$host/pegawai/unit-kerja/"?>" ><span class="title">Unit Kerja</span></a></li>
					<?php if ($_SESSION['id_level'] == "999"): ?>
					<li><a href="<?="$host/pegawai/absensi/"?>" ><span class="title">Absensi</span></a></li>
					<?php endif; ?>
				</ul><!--end /submenu -->
			</li><!--end /menu-li -->
			<!-- END DATA MASTER PEGAWAI -->

			<!-- BEGIN DATA MASTER INVENTARIS -->
			<li class="gui-folder <?=($aktif == "master-inventaris") ? "active expanding": ""?>">
				<a>
					<div class="gui-icon"><i class="md md-archive"></i></div>
					<span class="title">Data Master Inventaris</span>
				</a>
				<!--start submenu -->
				<ul>
					<li><a href="<?="$host/inventaris/barang/"?>" ><span class="title">Barang</span></a></li>
					<li><a href="<?="$host/inventaris/kendaraan/"?>" ><span class="title">Kendaraan</span></a></li>
				</ul><!--end /submenu -->
			</li><!--end /menu-li -->
			<!-- END DATA MASTER INVENTARIS -->

			<!-- BEGIN DATA MASTER LAPORAN PEGAWAI -->
			<li class="gui-folder">
				<a>
					<div class="gui-icon"><i class="fa fa-book"></i></div>
					<span class="title">Laporan Pegawai</span>
				</a>
				<!--start submenu -->
				<ul>
					<li><a href="javascript:void(0);" onclick="window.open('<?="$host/pegawai/laporan/pegawai.php"?>','_blank','scrollbars=yes, resizeable=yes, top=0, left=100, width=1170, height=660')"><span class="title">Laporan Pegawai</span></a></li>
					<li><a href="javascript:void(0);" onclick="window.open('<?="$host/pegawai/laporan/mutasi.php"?>','_blank','scrollbars=yes, resizeable=yes, top=0, left=100, width=1170, height=660')"><span class="title">Laporan Mutasi Pegawai</span></a></li>
					<li><a href="javascript:void(0);" onclick="report_pgw('pangkat')"><span class="title">Laporan Pegawai<br>Berdasarkan Pangkat</span></a></li>
					<li><a href="javascript:void(0);" onclick="report_pgw('golongan')"><span class="title">Laporan Pegawai<br>Berdasarkan Golongan</span></a></li>
					<li><a href="javascript:void(0);" onclick="report_pgw('jabatan')"><span class="title">Laporan Pegawai<br>Berdasarkan Jabatan</span></a></li>
					<li><a href="javascript:void(0);" onclick="report_pgw('eselon')"><span class="title">Laporan Pegawai<br>Berdasarkan Eselon</span></a></li>
					<li><a href="javascript:void(0);" onclick="report_pgw('unit-kerja')"><span class="title">Laporan Pegawai<br>Berdasarkan Unit Kerja</span></a></li>
				</ul><!--end /submenu -->
			</li><!--end /menu-li -->
			<!-- END DATA MASTER LAPORAN PEGAWAI -->

			<!-- BEGIN DATA MASTER LAPORAN INVENTARIS -->
			<li class="gui-folder <?=($aktif == "master-lap-inventaris") ? "active": ""?>">
				<a>
					<div class="gui-icon"><i class="fa fa-book"></i></div>
					<span class="title">Laporan Inventaris</span>
				</a>
				<!--start submenu -->
				<ul>
					<li><a href="javascript:void(0);" onclick="$('#formModalReportBarang').modal();"><span class="title">Laporan Barang</span></a></li>
					<li><a href="javascript:void(0);" onclick="$('#formModalReportKendaraan').modal();"><span class="title">Laporan Kendaraan</span></a></li>
				</ul><!--end /submenu -->
			</li><!--end /menu-li -->
			<!-- END DATA MASTER LAPORAN INVENTARIS -->

			<?php endif; ?>

			<?php if (isset($_SESSION['pegawai'])) : // login as pegawai ?>
			<!-- BEGIN PROFIL -->
			<li class="<?=($aktif == "profil") ? "active": ""?>">
				<a href="<?="$host/pegawai/profil/"?>">
					<div class="gui-icon"><i class="fa fa-user" style="margin-left: 14px;"></i></div>
					<span class="title">Profil</span>
				</a>
			</li><!--end /menu-li -->
			<!-- END PROFIL -->

			<!-- BEGIN PEGAWAI -->
			<li class="<?=($aktif == "pegawai") ? "active": ""?>">
				<a href="<?="$host/pegawai/"?>">
					<div class="gui-icon"><i class="fa fa-users"></i></div>
					<span class="title">Daftar Pegawai</span>
				</a>
			</li><!--end /menu-li -->
			<!-- END PEGAWAI -->

			<!-- BEGIN DATA INVENTARIS -->
			<li class="gui-folder <?=($aktif == "master-inventaris") ? "active expanding": ""?>">
				<a>
					<div class="gui-icon"><i class="md md-archive"></i></div>
					<span class="title">Inventaris</span>
				</a>
				<!--start submenu -->
				<ul>
					<li><a href="<?="$host/inventaris/barang/"?>" ><span class="title">Barang</span></a></li>
					<li><a href="<?="$host/inventaris/kendaraan/"?>" ><span class="title">Kendaraan</span></a></li>
				</ul><!--end /submenu -->
			</li><!--end /menu-li -->
			<!-- END DATA INVENTARIS -->

			<!-- BEGIN CUTI -->
			<li class="<?=($aktif == "cuti") ? "active": ""?>">
				<a href="<?="$host/pegawai/cuti/"?>">
					<div class="gui-icon"><i class="fa fa-envelope"></i></div>
					<span class="title">Surat Cuti</span>
				</a>
			</li><!--end /menu-li -->
			<!-- END CUTI -->
			<?php endif; ?>

		</ul><!--end .main-menu -->
		<!-- END MAIN MENU -->

		<div class="menubar-foot-panel">
			<small class="no-linebreak hidden-folded">
				<span class="opacity-75">Copyright &copy; 2016</span> <strong>Azzam</strong>
			</small>
		</div>
	</div><!--end .menubar-scroll-panel-->
</div><!--end #menubar-->
<!-- END MENUBAR -->

<?php //include_once("$docs/canvas-right.php"); ?>