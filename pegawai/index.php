<?php
include_once("../route.php");
$aktif = "pegawai";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Data Pegawai</title>
		<?php include_once("$docs/source-css.php"); ?>
	</head>
	<body class="menubar-hoverable header-fixed <?=(isset($_GET['d'])) ? "menubar-pin" : ""?>">

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
				if (isset($_GET['d'])) {
					if (file_exists("$_GET[d].php")) {
						include_once("$_GET[d].php");
					} else {
						header("location: $host/404.php");
					}
				} else {
					include_once("konten.php");
				}
				?>
			</div><!--end #content-->
			<!-- END CONTENT -->

			<?php include_once("$docs/menubar.php"); ?>

		</div><!--end #base-->
		<!-- END BASE -->

	<?php include_once("$docs/source-js.php"); ?>
	<?php if (isset($_SESSION['admin'])) : //login as admin ?>
	<script src="<?="$host/assets/js/libs/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js"?>"></script>
	<?php endif; ?>
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
						{
							"class": 'details-control',
							"orderable": false,
							"data": null,
							"defaultContent": ''
						},
						{"data": "no"},
						{"data": "nip"},
						{"data": "nama"},
						{"data": "pangkat"},
						{"data": "golongan"},
						{"data": "jabatan"},
						{"data": "eselon"},
						{"data": "unit_kerja"},
						{"data": "btn"}
					],
					"tableTools": {
						"sSwfPath": $('#datatable2').data('swftools')
					},
					"order": [[1, 'asc']],
					"language": {
						"lengthMenu": '_MENU_ entries per page',
						"search": '<i class="fa fa-search"></i>',
						"paginate": {
							"previous": '<i class="fa fa-angle-left"></i>',
							"next": '<i class="fa fa-angle-right"></i>'
						}
					}
				});
				
				//Add event listener for opening and closing details
				var o = this;
				$('#datatable2 tbody').on('click', 'td.details-control', function() {
					var tr = $(this).closest('tr');
					var row = table.row(tr);

					if (row.child.isShown()) {
						// This row is already open - close it
						row.child.hide();
						tr.removeClass('shown');
					}
					else {
						// Open this row
						row.child(o._formatDetails(row.data())).show();
						tr.addClass('shown');
					}
				});
			};

			// =========================================================================
			// DETAILS
			// =========================================================================

			p._formatDetails = function(d) {
				// `d` is the original data object for the row
				return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
						'<tr>' +
						'<td>Tempat, Tgl Lahir:</td>' +
						'<td>' + d.tmpt_lahir + ', ' + d.tgl_lahir + '</td>' +
						'</tr>' +
						'<tr>' +
						'<td>Jenis Kelamin:</td>' +
						'<td>' + d.jkl + '</td>' +
						'</tr>' +
						'<tr>' +
						'<td>Agama:</td>' +
						'<td>' + d.agama + '</td>' +
						'</tr>' +
						'<tr>' +
						'<td>Pendidikan:</td>' +
						'<td>' + d.pendidikan + '</td>' +
						'</tr>' +
						'<tr>' +
						'<td>Tahun Lulus:</td>' +
						'<td>' + d.thn_lulus + '</td>' +
						'</tr>' +
						'<tr>' +
						'<td>Diklat Jabatan Terakhir:</td>' +
						'<td>' + d.diklat + '</td>' +
						'</tr>' +
						'<tr>' +
						'<td>Masa Kerja:</td>' +
						'<td>' + d.mk_thn + ' tahun ' + d.mk_bln + ' bulan</td>' +
						'</tr>' +
						'<tr>' +
						'<td>TMT Golongan:</td>' +
						'<td>' + d.tmt_golongan + '</td>' +
						'</tr>' +
						'<tr>' +
						'<td>TMT Jabatan:</td>' +
						'<td>' + d.tmt_jabatan + '</td>' +
						'</tr>' +
						'<tr>' +
						'<td>Keterangan:</td>' +
						'<td>' + d.ket + '</td>' +
						'</tr>' +
						'</table>';
			};

			// =========================================================================
			namespace.DemoTableDynamic = new DemoTableDynamic;
		}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):

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
	</script>

	</body>
</html>
