<!-- BEGIN HEADER-->
<header id="header" >
	<div class="headerbar">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="headerbar-left">
			<ul class="header-nav header-nav-options">
				<li class="header-nav-brand" >
					<div class="brand-holder">
						<a href="<?=$host?>">
							<span class="text-lg text-bold text-primary">SIMPEG & INVENTARIS</span>
						</a>
					</div>
				</li>
				<li>
					<a class="btn btn-icon-toggle menubar-toggle" data-toggle="menubar" href="javascript:void(0);">
						<i class="fa fa-bars"></i>
					</a>
				</li>
			</ul>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="headerbar-right">
			<ul class="header-nav header-nav-options">
				<li>
					<!-- Search form -->
					<form class="navbar-search" role="search">
						<div class="form-group">
							<input type="text" class="form-control" name="headerSearch" placeholder="Enter your keyword">
						</div>
						<button type="submit" class="btn btn-icon-toggle ink-reaction"><i class="fa fa-search"></i></button>
					</form>
				</li>
			</ul><!--end .header-nav-options -->
			<ul class="header-nav header-nav-profile">
				<li class="dropdown">
					<a href="javascript:void(0);" class="dropdown-toggle ink-reaction" data-toggle="dropdown">
						<img src="<?="$host/images/avatar_2x.png"?>" alt="" />
						<span class="profile-info">
							<?=ucfirst($_SESSION['nama'])?>
							<small><?=ucfirst($_SESSION['level'])?></small>
						</span>
					</a>
					<ul class="dropdown-menu animation-dock">
						<li class="dropdown-header">Config</li>
						<?php if (isset($_SESSION['admin']) && $_SESSION['id_level'] === "999") : //login as admin ?>
						<li><a href="<?="$host/akun/"?>"><i class="fa fa-cogs"></i> Akun</a></li>
						<?php endif; ?>
						<li><a href="#" data-toggle="modal" data-target="#formModalchpass"><i class="fa fa-key"></i> Ganti Password</a></li>
						<li class="divider"></li>
						<li><a href="<?="$host/logout.php"?>"><i class="fa fa-fw fa-power-off text-danger"></i> Logout</a></li>
					</ul><!--end .dropdown-menu -->
				</li><!--end .dropdown -->
			</ul><!--end .header-nav-profile -->
			<ul class="header-nav header-nav-toggle">
				<li>
					<a class="btn btn-icon-toggle btn-default" href="#offcanvas-search" data-toggle="offcanvas" data-backdrop="false">
						<i class="fa fa-ellipsis-v"></i>
					</a>
				</li>
			</ul><!--end .header-nav-toggle -->
		</div><!--end #header-navbar-collapse -->
	</div>
</header>
<!-- END HEADER-->