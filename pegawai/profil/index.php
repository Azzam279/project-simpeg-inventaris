<?php
include_once("../../route.php");
$aktif = "profil";
if ($_SESSION['level'] != "Pegawai") {
	header("location: $host");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Profil <?=$_SESSION['nama']?></title>
		<?php include_once("$docs/source-css.php"); ?>
		<style>
			table td:nth-child(2) {
				padding-right: 8px;
			}
		</style>
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
				<?php
				include_once("profil.php");
				?>
			</div><!--end #content-->
			<!-- END CONTENT -->

			<?php include_once("$docs/menubar.php"); ?>

		</div><!--end #base-->
		<!-- END BASE -->

	<?php include_once("$docs/source-js.php"); ?>
	<script src="<?="$host/assets/js/jquery.ajaxfileupload.js"?>"></script>
	<script>
		//proses input data pegawai
		$(function() {
			$("#form-input").submit(function(e) {
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
						ini.find("button[type='submit']").append(" <i class='fa fa-check'></i>");
						ini.find("button[type='submit']").removeAttr("disabled");

						var dt = $.parseJSON(respon);
						if (dt.info == "sukses") {
							tampil_alert("success", dt.pesan);
							//reset fields
							$("#form-input")[0].reset();
							$(".btn-group label").removeClass("active");
						} else if (dt.info == "gagal") {
							tampil_alert("error", dt.pesan);
						} else {
							tampil_alert("warning", dt.pesan);
						}

						$target = "#top";
						$jarak = 0;
						$('html, body').stop().animate(
						    {
						        'scrollTop' : 0
						    },
						    500, //durasi dalam milisekon
						    'swing', //efek transisi (opsi : swing / linear)
						    function(){
						    //    window.location.hash = $target;
						    }
						);
					},
					error: function() {
						alert("Error: Terjadi kesalahan! silakan coba lagi.");
					}
				});
			});
		});

		//proses update data pegawai
		$(function() {
			$("#form-edit").submit(function(e) {
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
						ini.find("button[type='submit']").append(" <i class='fa fa-check'></i>");
						ini.find("button[type='submit']").removeAttr("disabled");

						var dt = $.parseJSON(respon);
						if (dt.info == "sukses") {
							tampil_alert("success", dt.pesan);
						} else if (dt.info == "gagal") {
							tampil_alert("error", dt.pesan);
						} else {
							tampil_alert("warning", dt.pesan);
						}

						$target = "#top";
						$jarak = 0;
						$('html, body').stop().animate(
						    {
						        'scrollTop' : 0
						    },
						    500, //durasi dalam milisekon
						    'swing', //efek transisi (opsi : swing / linear)
						    function(){
						    //    window.location.hash = $target;
						    }
						);
					},
					error: function() {
						alert("Error: Terjadi kesalahan! silakan coba lagi.");
					}
				});
			});
		});

		//proses hapus data
		function del_data(id, nama, foto) {
		  swal({
		      title: "Yakin Ingin Hapus?",
		      text: "Yakin Ingin Hapus Data Pegawai '"+nama+"'?",
		      type: "warning",
		      showCancelButton: true,
		      confirmButtonColor: "#DD6B55",
		      confirmButtonText: "Ya, hapus!",
		      closeOnConfirm: false
		      },
		      function(){
		        $.ajax({
		            url: host+'/pegawai/CRUD_pegawai.php',
		            type: 'POST',
		            dataType: 'html',
		            data: 'delete='+id+'&foto='+foto,
		            beforeSend: function() {
		                swal({
		                    title: "Sedang Memuat...",
		                    text: "",
		                    imageUrl: host+"/assets/img/ajaxloader.gif",
		                    showConfirmButton: false
		                });
		            },
		            success: function(hasil) {
		              if (hasil == "Sukses") {
		                  swal({
		                      title: "Sukses!",
		                      text: "Hapus data pegawai '"+nama+"' berhasil!",
		                      type: "success",
		                      showCancelButton: false,
		                      confirmButtonColor: "#86CCEB",
		                      confirmButtonText: "Ok",
		                      closeOnConfirm: true
		                      },
		                      function() {
		                          $('#datatable2').DataTable().ajax.reload();
		                      });
		              } else {
		                swal("Gagal!", "Hapus data pegawai '"+nama+"' gagal!", "error");
		              }
		            },
		            error: function(event, textStatus, errorThrown) {
		               alert('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
		            }
		        });
		      });
		}

		//fungsi upload foto secara real-time dgn ajax
		$(function() {
		    $("#foto-pgw").AjaxFileUpload({
		      action: host+"/pegawai/profil/upload.php",
		      onComplete: function(filename, response) {
		        if (response.status == 1) {
		          $("#uploads").html('<img src="'+host+'/images/pegawai/'+response.name+'" alt="foto-pegawai-'+response.date+'" class="img-reponsive">').fadeIn();
		          if (response.pesan == "Sukses") {
		            $("#showpesan").html("<font color='green'>Foto berhasil diupload!</font>").delay(3000).fadeOut();
		          } else {
		            $("#showpesan").html("<font color='red'>Foto gagal diupload!</font>").delay(3000).fadeOut();
		          }
		        } else {
		          alert("Gagal upload foto!");
		        }
		      }
		    });
		});
	</script>

	</body>
</html>
