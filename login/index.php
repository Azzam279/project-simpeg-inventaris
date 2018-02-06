<?php
include_once("../route-login.php");
if (isset($_SESSION['level'])) {
	header("location: $host");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login Pegawai</title>
		<?php include_once("$docs/source-css.php"); ?>
	</head>
	<body class="menubar-hoverable header-fixed ">

		<!-- BEGIN LOGIN SECTION -->
		<section class="section-account">
			<div class="img-backdrop" style="background-image: url('../assets/img/img16.jpg')"></div>
			<div class="spacer"></div>
			<div class="card contain-xs style-transparent">
				<div class="card-body">
					<div class="row">
						<div class="col-sm-12">
							<img class="img-circle" src="../images/avatar_2x_lg.png" alt="" />
							<h2>Login as Pegawai</h2>
							<form class="form" action="<?=htmlspecialchars("proses-login-pegawai.php")?>" accept-charset="utf-8" method="post" id="form-login">
								<div class="form-group floating-label">
									<div class="input-group">
										<div class="input-group-content">
											<input type="text" id="nip" class="form-control" name="nip" maxlength="50">
											<label for="nip">NIP</label></p>
										</div>
										<div class="input-group-content">
											<input type="password" id="password" class="form-control" name="pass">
											<label for="password">Password</label></p>
										</div>
										<div class="input-group-btn">
											<button class="btn btn-floating-action btn-primary" type="submit"><i class="fa fa-sign-in"></i></button>
										</div>
									</div><!--end .input-group -->
								</div><!--end .form-group -->
							</form>
						</div><!--end .col -->
					</div><!--end .row -->
				</div><!--end .card-body -->
			</div><!--end .card -->
		</section>
		<!-- END LOGIN SECTION -->

		<?php include_once("$docs/source-js.php"); ?>
		<script>
		//proses login pegawai
		$(function() {
			$("#form-login").submit(function(e) {
				e.preventDefault();
				var ini = $(this);

				$.ajax({
					url: ini.attr("action"),
					type: 'POST',
					data: ini.serialize(),
					beforeSend: function() {
						ini.find("button[type='submit'] i").remove();
						ini.find("button[type='submit']").append(" <i class='fa fa-spinner fa-spin'></i>");
						ini.find("button[type='submit']").attr("disabled","disabled");
					},
					success: function(respon) {
						ini.find("button[type='submit'] i").remove();
						ini.find("button[type='submit']").append(" <i class='fa fa-sign-in'></i>");
						ini.find("button[type='submit']").removeAttr("disabled");

						var dt = $.parseJSON(respon);
						if (dt.info == "sukses") {
							//redirect ke dashboard
							window.location = host+'/pegawai/profil/';
						} else if (dt.info == "gagal") {
							swal("Oops...", dt.pesan, "error");
						} else {
							swal("Warning!", dt.pesan, "warning");
						}
					},
					error: function() {
						alert("Error: Terjadi kesalahan! silakan coba lagi.");
					}
				});
			});
		});
		</script>
	</body>
</html>
