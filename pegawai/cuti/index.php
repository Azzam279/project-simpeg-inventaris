<?php
include_once("../../route.php");
$aktif = "cuti";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Surat Cuti</title>
		<?php include_once("$docs/source-css.php"); ?>
 		<link type="text/css" rel="stylesheet" href="<?="$host/assets/css/bootstrap-datetimepicker.min.css"?>" />
	</head>
	<body class="menubar-hoverable header-fixed menubar-pin">

		<!-- iframe surat cuti -->
		<iframe src="cuti-tahunan-pejabat.php" frameborder="0" width="100%" height="100%" style="display: none;"></iframe>
		<iframe src="cuti-tahunan-non-pejabat.php" frameborder="0" width="100%" height="100%" style="display: none;"></iframe>
		<!-- end iframe -->

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
				include_once("cuti.php");
				?>
			</div><!--end #content-->
			<!-- END CONTENT -->

			<?php include_once("$docs/menubar.php"); ?>

		</div><!--end #base-->
		<!-- END BASE -->

	<?php include_once("$docs/source-js.php"); ?>
	<script src="<?="$host/assets/js/bootstrap-datetimepicker.min.js"?>"></script>
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
						{"data": "jenis"},
						{"data": "tgl_mulai"},
						{"data": "tgl_selesai"},
						{"data": "hari"},
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

		//proses input data cuti
		$(function() {
			$("#form-cuti").submit(function(e) {
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
						ini.find("button[type='submit']").removeAttr("disabled");

						var dt = $.parseJSON(respon);
						if (dt.info == "sukses") {
							$('#datatable2').DataTable().ajax.reload(); //reload table
							tampil_alert("success", dt.pesan);
							if (ini.find("button[type='submit']").val() == "input") {
								//reset fields
								$("#form-cuti")[0].reset();
							}
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
		function del_data(id) {
		  swal({
		      title: "Yakin Ingin Hapus?",
		      text: "Yakin Ingin Hapus Data Cuti ini?",
		      type: "warning",
		      showCancelButton: true,
		      confirmButtonColor: "#DD6B55",
		      confirmButtonText: "Ya, hapus!",
		      closeOnConfirm: false
		      },
		      function(){
		        $.ajax({
		            url: host+'/pegawai/cuti/CRUD_cuti.php',
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
		              if (hasil.trim() == "Sukses") {
		                  swal({
		                      title: "Sukses!",
		                      text: "Hapus data cuti berhasil!",
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
		                swal("Gagal!", "Hapus data cuti gagal!", "error");
		              }
		            },
		            error: function(event, textStatus, errorThrown) {
		               alert('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
		            }
		        });
		      });
		}

		//edit data
		function edit_data(id) {
			$.ajax({
				url: host+"/pegawai/cuti/ajax.php",
				type: 'POST',
				data: 'id_cuti='+id,
				success: function(result) {
					var dt = $.parseJSON(result);
					$("#jenis").val(dt.jenis);
					$("#hari").val(dt.hari);
					$("#tgl_mulai").val(dt.tgl_mulai);
					$("#tgl_selesai").val(dt.tgl_selesai);
					$("#alamat").val(dt.alamat);
				},
				error: function() {
					console.log('Error: gagal request data!');
				}
			});
		}

		//cetak surat cuti
		function cetak(id, tipe) {
			$.ajax({
				url: host+'/pegawai/cuti/ajax.php',
				type: 'POST',
				data: 'cuti_thn_pejabat='+id,
				success: function(result) {
					if (result == "Sukses") {
						var cek = "<?=(empty($_SESSION['id_cuti'])) ? "" : $_SESSION['id_cuti']?>";
						if (cek == "") {
							window.location.reload();
						} else if (tipe == "pejabat") {
							window.frames[0].print();
						} else {
							window.frames[1].print();
						}
					} else {
						alert("Gagal membuat session.");
					}
				},
				error: function() {
					alert("Error: Gagal membuat session.");
				}
			});
		}

		//fungsi menghitung cuti tahunan selesai
		function cuti_tahunan() {
		  var hari  = $("#form-cuti input[name='hari']").val();
		  var mulai = $("#form-cuti input[name='tgl_mulai']").val();

		  if (hari != "" && mulai != "") {
		    $.ajax({
		      url: host+"/pegawai/cuti/ajax.php",
		      type: 'POST',
		      data: 'hari='+hari+'&mulai='+mulai,
		      success: function(result) {
		        $("#form-cuti input[name='tgl_selesai']").val(result);
		      },
		      error: function() {
		        console.log('Error: gagal request data!');
		      }
		    });
		  }
		}

		//datetimepicker bootstrap
		 $('.form_date').datetimepicker({
		        language:  'id',
		        weekStart: 1,
		        todayBtn:  1,
		  autoclose: 1,
		  todayHighlight: 1,
		  startView: 2,
		  minView: 2,
		  forceParse: 0,
		  pickerPosition: "bottom-left"
		  //format: 'dd-mm-yyyy',
		    });
	</script>

	</body>
</html>
