<?php include_once("route.php"); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Home - Selamat Datang</title>
		<?php include_once("$docs/source-css.php"); ?>
		<link rel="stylesheet" href="<?="$host/assets/css/animate.min.css"?>">
	</head>
	<body class="menubar-hoverable header-fixed menubar-pin">

		<?php include_once("$docs/header.php"); ?>

		<!-- BEGIN BASE-->
		<div id="base">

			<!-- BEGIN OFFCANVAS LEFT -->
			<div class="offcanvas">
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS LEFT -->

			<!-- BEGIN CONTENT-->
			<div id="content">
				<section>
					<div class="section-header">
						<ol class="breadcrumb">
							<li class="active"><i class="fa fa-home"></i> Home</li>
						</ol>
					</div>
					<div class="section-body contain-lg">

						<!-- BEGIN KONTEN -->
						<div class="row">
							<div class="col-md-12">
								<div class="card card-bordered style-primary">
									<div class="card-head">
										<div class="tools">
											<div class="btn-group">
												<?php include_once("$docs/colorize.php"); ?>
												<a class="btn btn-icon-toggle btn-collapse"><i class="fa fa-angle-down"></i></a>
												<a class="btn btn-icon-toggle btn-close"><i class="md md-close"></i></a>
											</div>
										</div>
										<header>Selamat Datang</header>
									</div>
									<div class="card-body style-default-bright">
										<div id="header-home">
											<embed src="<?="$host/images/header.swf"?>" class="animated bounceIn" width="100%" height="130" style="padding-right: 50px;">
										</div>
										<div id="img-home">
											<img src="<?="$host/images/pemprov-office.jpg"?>" alt="Kantor Pemprov Kalsel" class="img-responsive animated zoomInUp" style="margin: auto;" width="80%">
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- END KONTEN -->

					</div><!--end .section-body -->
				</section>
			</div><!--end #content-->
			<!-- END CONTENT -->

			<?php include_once("$docs/menubar.php"); ?>

		</div><!--end #base-->
		<!-- END BASE -->

	<?php include_once("$docs/source-js.php"); ?>

	</body>
</html>
