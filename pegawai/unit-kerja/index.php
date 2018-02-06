<?php
include_once("../../route.php");
$aktif = "master-pegawai";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Data Unit Kerja</title>
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
				<?php
				include_once("konten.php");
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
					{"data": "unit_kerja"},
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

	$(function() {
		// BEGIN proses insert data
		$("#form-input").submit(function(e) {
			e.preventDefault();
			var ini = $(this);

			$.ajax({
				url: ini.attr("action"),
				type: 'POST',
				data: ini.serialize(),
				beforeSend: function() {
					ini.find("button[type='submit']").append(" <i class='fa fa-spinner fa-spin'></i>");
					ini.find("button[type='submit']").attr("disabled","disabled");
				},
				success: function(respon) {
					ini.find("button[type='submit'] i").remove();
					ini.find("button[type='submit']").removeAttr("disabled");

					var dt = $.parseJSON(respon);
					if (dt.info == "sukses") {
						ini.find("input").val('');
						$("#show-alert").html("<div class='alert alert-callout alert-success'><i class='fa fa-check'></i> "+dt.data+"</div>");
						$('#datatable2').DataTable().ajax.reload();
					} else if (dt.info == "gagal") {
						$("#show-alert").html("<div class='alert alert-callout alert-danger'><i class='fa fa-times'></i> "+dt.data+"</div>");
					} else {
						$("#show-alert").html("<div class='alert alert-callout alert-warning'><i class='fa fa-exclamation-triangle'></i> "+dt.data+"</div>");
					}
					$(".alert-callout").delay(5000).slideUp();
				},
				error: function() {
					alert("Error: Terjadi kesalahan! silakan coba lagi.");
				}
			});
		});
		// END proses insert data

		// BEGIN proses update data
		$("#form-edit").submit(function(e) {
			e.preventDefault();
			var ini = $(this);

			$.ajax({
				url: ini.attr("action"),
				type: 'POST',
				data: ini.serialize(),
				beforeSend: function() {
					ini.find("button[type='submit']").append(" <i class='fa fa-spinner fa-spin'></i>");
					ini.find("button[type='submit']").attr("disabled","disabled");
				},
				success: function(respon) {
					ini.find("button[type='submit'] i").remove();
					ini.find("button[type='submit']").removeAttr("disabled");

					var dt = $.parseJSON(respon);
					if (dt.info == "sukses") {
						$("#show-alert2").html("<div class='alert alert-callout alert-success'><i class='fa fa-check'></i> "+dt.data+"</div>");
						$('#datatable2').DataTable().ajax.reload();
					} else if (dt.info == "gagal") {
						$("#show-alert2").html("<div class='alert alert-callout alert-danger'><i class='fa fa-times'></i> "+dt.data+"</div>");
					} else {
						$("#show-alert2").html("<div class='alert alert-callout alert-warning'><i class='fa fa-exclamation-triangle'></i> "+dt.data+"</div>");
					}
					$(".alert-callout").delay(5000).slideUp();
				},
				error: function() {
					alert("Error: Terjadi kesalahan! silakan coba lagi.");
				}
			});
		});
		// END proses update data
	});

	//proses hapus data
	function del_data(id, nama) {
	  swal({
	      title: "Yakin Ingin Hapus?",
	      text: "Yakin Ingin Hapus Unit Kerja '"+nama+"'?",
	      type: "warning",
	      showCancelButton: true,
	      confirmButtonColor: "#DD6B55",
	      confirmButtonText: "Ya, hapus!",
	      closeOnConfirm: false
	      },
	      function(){
	        $.ajax({
	            url: host+'/pegawai/unit-kerja/CRUD_unit.php',
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
	                      text: "Hapus unit kerja '"+nama+"' berhasil!",
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
	                swal("Gagal!", "Hapus unit kerja '"+nama+"' gagal! Pastikan tidak ada data pegawai, barang, atau admin yang menggunakan data unit kerja '"+nama+"'", "error");
	              }
	            },
	            error: function(event, textStatus, errorThrown) {
	               alert('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
	            }
	        });
	      });
	}

	//fungsi menampilkan detail edit data
	function edit_data(id) {
		$.ajax({
			url: host+'/pegawai/unit-kerja/edit-detail.php',
			type: 'POST',
			data: 'id='+id,
			beforeSend: function() {
				$("#detail-edit").html("<center>Loading...</center>");
			},
			success: function(respon) {
				$("#detail-edit").html(respon);
			},
			error: function() {
				alert("Error: Terjadi kesalahan! silakan coba lagi.");
			}
		});
	}
	</script>

	</body>
</html>
