<?php
include_once("../route.php");
$aktif = "";

//jika bukan full hak akses maka arahkan ke halaman 404.php
if ($_SESSION['id_level'] != "999") {
	header("location: $host/404.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Data Akun</title>
		<?php include_once("$docs/source-css.php"); ?>
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
				include_once("akun.php");
				?>
			</div><!--end #content-->
			<!-- END CONTENT -->

			<?php include_once("$docs/menubar.php"); ?>

		</div><!--end #base-->
		<!-- END BASE -->

	<?php include_once("$docs/source-js.php"); ?>
	<script>
		(function(namespace, $) {
			"use strict";

			var DemoTableDynamic = function() {
				// Create reference to this instance
				var o = this;
				// Initialize app when document is ready
				$(document).ready(function() {
					o.initialize();
				});

			};
			var p = DemoTableDynamic.prototype;

			// =========================================================================
			// INIT
			// =========================================================================

			p.initialize = function() {
				this._initDataTables();
			};

			// =========================================================================
			// DATATABLES
			// =========================================================================

			p._initDataTables = function() {
				if (!$.isFunction($.fn.dataTable)) {
					return;
				}

				// Init the demo DataTables
				this._createDataTable2();
			};

			p._createDataTable2 = function() {
				var table = $('#datatable2').DataTable({
					"dom": 'T<"clear">lfrtip',
					"ajax": $('#datatable2').data('source'),
					"columns": [
						{"data": "no"},
						{"data": "user"},
						{"data": "btn"}
					],
					"tableTools": {
						"sSwfPath": $('#datatable2').data('swftools')
					},
					"order": [[0, 'asc']],
					"language": {
						"lengthMenu": '_MENU_ entries per page',
						"search": '<i class="fa fa-search"></i>',
						"paginate": {
							"previous": '<i class="fa fa-angle-left"></i>',
							"next": '<i class="fa fa-angle-right"></i>'
						}
					}
				});

			};

			// =========================================================================
			namespace.DemoTableDynamic = new DemoTableDynamic;
		}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):

		//proses input data akun
		$(function() {
			$("#form-akun").submit(function(e) {
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
							//show alert
							tampil_alert("success", dt.pesan);
							//reset fields
							$("#form-akun")[0].reset();
							//reload table
							$('#datatable2').DataTable().ajax.reload();
						} else if (dt.info == "gagal") {
							tampil_alert("error", dt.pesan);
						} else {
							tampil_alert("warning", dt.pesan);
						}
					},
					error: function() {
						alert("Error: Terjadi kesalahan! silakan coba lagi.");
					}
				});
			});
		});

		//proses hapus data
		function del_data(id, nama) {
		  swal({
		      title: "Yakin Ingin Hapus?",
		      text: "Yakin Ingin Hapus Data Akun '"+nama+"'?",
		      type: "warning",
		      showCancelButton: true,
		      confirmButtonColor: "#DD6B55",
		      confirmButtonText: "Ya, hapus!",
		      closeOnConfirm: false
		      },
		      function(){
		        $.ajax({
		            url: host+'/akun/CRUD_akun.php',
		            type: 'POST',
		            dataType: 'html',
		            data: 'delete='+id,
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
		                      text: "Hapus data akun '"+nama+"' berhasil!",
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
		                swal("Gagal!", "Hapus data akun '"+nama+"' gagal!", "error");
		              }
		            },
		            error: function(event, textStatus, errorThrown) {
		               alert('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
		            }
		        });
		      });
		}
	</script>

	</body>
</html>
