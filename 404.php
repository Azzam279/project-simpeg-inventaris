<?php include_once("route.php"); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Data Pegawai</title>
		<?php include_once("$docs/source-css.php"); ?>
	</head>
	<body class="menubar-hoverable header-fixed ">

		<?php include_once("$docs/header.php"); ?>

		<!-- BEGIN BASE-->
		<div id="base">

			<!-- BEGIN OFFCANVAS LEFT -->
			<div class="offcanvas">
			</div><!--end .offcanvas-->
			<!-- END OFFCANVAS LEFT -->

			<!-- BEGIN CONTENT-->
			<div id="content">
				<!-- BEGIN 404 MESSAGE -->
				<section>
					<div class="section-header">
						<ol class="breadcrumb">
							<li><a href="<?=$host?>">Home</a></li>
							<li class="active">404</li>
						</ol>
					</div>
					<div class="section-body contain-lg">
						<div class="row">
							<div class="col-lg-12 text-center">
								<h1><span class="text-xxxl text-light">404 <i class="fa fa-search-minus text-primary"></i></span></h1>
								<h2 class="text-light">This page does not exist</h2>
							</div><!--end .col -->
						</div><!--end .row -->
					</div><!--end .section-body -->
				</section>
				<!-- END 404 MESSAGE -->
			</div><!--end #content-->
			<!-- END CONTENT -->

			<?php include_once("$docs/menubar.php"); ?>

		</div><!--end #base-->
		<!-- END BASE -->

	<?php include_once("$docs/source-js.php"); ?>

	</body>
</html>
