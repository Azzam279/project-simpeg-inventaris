<?php
include_once("../../route.php");
include_once("$docs/database/koneksi.php");
//jika level user pegawai maka redirect halaman ke halaman utama
if ($_SESSION['level'] == "Pegawai" || $_SESSION['id_level'] != "999") {
  header("location: $host");
}

$aktif = "master-pegawai";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Absensi Pegawai</title>
	<?php include_once("$docs/source-css.php"); ?>
  <link type="text/css" rel="stylesheet" href="<?="$host/assets/css/bootstrap-datetimepicker.min.css"?>" />
	<style>
		.funkyradio div {
		  clear: both;
		  overflow: hidden;
		}

		.funkyradio label {
		  width: 100%;
		  border-radius: 3px;
		  border: 1px solid #D1D3D4;
		  font-weight: normal;
		}

		.funkyradio input[type="radio"]:empty,
		.funkyradio input[type="checkbox"]:empty {
		  display: none;
		}

		.funkyradio input[type="radio"]:empty ~ label,
		.funkyradio input[type="checkbox"]:empty ~ label {
		  position: relative;
		  line-height: 2.5em;
		  text-indent: 3.25em;
		  margin-top: 2em;
		  cursor: pointer;
		  -webkit-user-select: none;
		     -moz-user-select: none;
		      -ms-user-select: none;
		          user-select: none;
		}

		.funkyradio input[type="radio"]:empty ~ label:before,
		.funkyradio input[type="checkbox"]:empty ~ label:before {
		  position: absolute;
		  display: block;
		  top: 0;
		  bottom: 0;
		  left: 0;
		  content: '';
		  width: 2.5em;
		  background: #D1D3D4;
		  border-radius: 3px 0 0 3px;
		}

		.funkyradio input[type="radio"]:hover:not(:checked) ~ label,
		.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label {
		  color: #888;
		}

		.funkyradio input[type="radio"]:hover:not(:checked) ~ label:before,
		.funkyradio input[type="checkbox"]:hover:not(:checked) ~ label:before {
		  content: '\2714';
		  text-indent: .9em;
		  color: #C2C2C2;
		}

		.funkyradio input[type="radio"]:checked ~ label,
		.funkyradio input[type="checkbox"]:checked ~ label {
		  color: #777;
		}

		.funkyradio input[type="radio"]:checked ~ label:before,
		.funkyradio input[type="checkbox"]:checked ~ label:before {
		  content: '\2714';
		  text-indent: .9em;
		  color: #333;
		  background-color: #ccc;
		}

		.funkyradio input[type="radio"]:focus ~ label:before,
		.funkyradio input[type="checkbox"]:focus ~ label:before {
		  box-shadow: 0 0 0 3px #999;
		}

    .funkyradio-primary .absensi:checked ~ .funky-check:before {
      color: #fff;
      background-color: #337ab7;
    }

    .funkyradio .absensi:empty ~ .blue-checked:before {
      content: '\2714';
      text-indent: .9em;
      color: #333;
      background-color: #ccc;
      color: #fff;
      background-color: #337ab7;
    }

    .funkyradio-primary .absensi:checked ~ .blue-checked:before {
      color: #fff;
      background-color: #337ab7;
    }

    #table-absensi {display: none;}
	</style>
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
				if (isset($_GET['a'])) {
					if (file_exists("$_GET[a].php")) {
						include_once("$_GET[a].php");
					}else{
						header("location: $host");
					}
				}else{
					include_once("content.php");
				}
				?>
      </div><!--end #content-->
      <!-- END CONTENT -->

      <?php include_once("$docs/menubar.php"); ?>

    </div><!--end #base-->
    <!-- END BASE -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      <form action="<?php echo htmlspecialchars("CRUD_absensi.php") ?>" method="post" class="form-horizontal" id="buat-absensi">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Buat Daftar Absensi</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="col-md-3 label-control">Tanggal :</label>
                <div class="col-md-5">
                    <div class="input-group date form_date"  data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                        <input class="form-control" type="text" name="tgl" maxlength="10" placeholder="Tahun-Bulan-Tanggal" readonly required>
                        <input type="hidden" name="ajax" value="true">
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar">
                            </span>
                        </span>
                    </div>
                </div>
              </div>
            </div> <!-- ./col -->
          </div> <!-- ./row -->
        </div> <!-- ./modal-body -->
        <div class="modal-footer">
          <button class="btn btn-primary" type="submit">Buat Daftar Absensi</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
    </div>
  </div> <!-- ./modal -->

<?php include_once("$docs/source-js.php"); ?>
<script src="<?="$host/assets/js/bootstrap-datetimepicker.min.js"?>"></script>
<!-- END JAVASCRIPT -->
<script>
var dTable;
  // #datatable adalah id pada table
  $(document).ready(function() {
    dTable = $('#datatablez').DataTable( {
      "bProcessing": true,
      "bServerSide": true,
      "bJQueryUI": false,
      "responsive": true,
      "sPaginationType": "full_numbers",
      "sAjaxSource": host+"/pegawai/absensi/serverSide.php", // Load Data
      "sServerMethod": "POST",
      "columnDefs": [
      { "orderable": false, "targets": 0, "searchable": false },
      { "orderable": true, "targets": 1, "searchable": true },
      { "orderable": true, "targets": 2, "searchable": true },
      { "orderable": false, "targets": 3, "searchable": false }
      ],
      "aaSorting" : [[2, "desc"]]
    } );
});

//cetak absensi bulanan
function cetak_absensi() {
  var bln = $("#pick-bulan").val().split("-");
  var thn = $("#pick-tahun").val();
  var bln_index = bln[0];
  var bln_name = bln[1];

  window.open(host+'/pegawai/absensi/cetak_absensi.php?bln_index='+bln_index+'&bln_name='+bln_name+'&thn='+thn,'_blank','scrollbars=yes, resizeable=yes, top=0, left=100, width=1170, height=660');
}

//proses hapus data absensi berdasarkan tanggal absensi
function del_absen_tgl(tgl1,tgl2) {
  swal({
      title: "Yakin Ingin Hapus?",
      text: "Yakin Ingin Hapus Absensi Tanggal '"+tgl2+"'?",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Ya, hapus!",
      closeOnConfirm: false
      },
      function() {
        $.ajax({
            url: host+'/pegawai/absensi/CRUD_absensi.php',
            type: 'POST',
            dataType: 'html',
            data: 'del_tgl='+tgl1,
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
                      text: "Hapus absensi tanggal '"+tgl2+"' berhasil!",
                      type: "success",
                      showCancelButton: false,
                      confirmButtonColor: "#86CCEB",
                      confirmButtonText: "Ok",
                      closeOnConfirm: true
                      },
                      function(){
                          $('#datatablez').DataTable().ajax.reload();
                      });
              } else if (hasil == "Warning") {
                swal("Peringatan!", "Hanya Admin yang dapat menghapus data!", "warning");
              } else {
                swal("Gagal!", "Hapus absensi tanggal '"+tgl2+"' gagal!", "error");
              }
            },
            error:function(event, textStatus, errorThrown) {
               alert('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
            }
        });
      });
}

$(function() {

//proses buat daftar absensi baru
$("#buat-absensi").submit(function() {
  var input = $(this).find("input[type='text']").val();
  var ini = $(this);
  if (input != "") {
    $.ajax({
      url: $(this).attr("action"),
      type: 'POST',
      data: $(this).serialize(),
      beforeSend: function() {
        ini.find("button").attr("disabled","disabled");
        ini.find("button").prepend("<i class='fa fa-refresh fa-spin'></i> ");
      },
      success: function(hasil) {
        var respon = $.parseJSON(hasil);
        if (respon.Ada == "Ada") {
          sweetAlert("Oops...", "Tanggal "+input+" sudah terdaftar!", "warning");
        } else if (respon.status == "Sukses") {
          swal({
              title: "Sukses!",
              text: "Buat daftar absensi sukses!",
              type: "success",
              showCancelButton: false,
              confirmButtonColor: "#86CCEB",
              confirmButtonText: "Ok",
              closeOnConfirm: false
              },
              function(){
                  window.location = host+'/pegawai/absensi/?a=absensi&tgl='+respon.tgl;
              });
        } else {
          sweetAlert("Gagal!", "Buat daftar absensi gagal!", "error");
        }
        ini.find("button").removeAttr("disabled");
        ini.find("button i").remove();
      },
      error: function() {
        sweetAlert("Oops...", "Error: Terjadi kesalahan! silakan coba lagi.", "warning");
      }
    });
  } else {
    sweetAlert("Oops...", "Masukkan Tanggal Terlebih Dahulu!", "warning");
  }
  return false;
});

$(".absensi").click(function() {
  var ini = $(this);
  var status = $(this).attr("status");
  var notif = $(this).attr("nomor");
  var no = $(this).attr("nomor");
  var label = $(this).siblings("label");

  //proses update kehadiran pegawai
  var id_absen = $(this).val();
  $.ajax({
    url: host+"/pegawai/absensi/CRUD_absensi.php",
    type: 'POST',
    data: "id_absen="+id_absen+"&absen="+label.text(),
    beforeSend: function() {
      $(".absensi").attr("disabled","disabled");
    },
    success: function(hasil) {
      $(".absensi").removeAttr("disabled");
      if (hasil == "Sukses") { //jika sukses
        $("#notif-"+notif).html("<i class='fa fa-check-circle-o notifikasi' style='color: green;'></i>");
      } else if (hasil == "Warning") { //peringatan
        $("#notif-"+notif).html("<i class='fa fa-exclamation-triangle notifikasi' style='color: orange;'></i>");
        if (status == "1") {
          ini.attr("checked","checked");
          $("#label-"+no).removeClass("funky-check").addClass("blue-checked");
        } else {
          ini.removeAttr("checked");
          $("#label-"+no).removeClass("blue-checked").addClass("funky-check");
        }
        sweetAlert("Peringatan!", "Hanya Admin yang dapat merubah data!", "warning");
      } else { //jika gagal
        $("#notif-"+notif).html("<i class='fa fa-times-circle-o notifikasi' style='color: red;'></i>");
        if (status == "1") {
          ini.attr("checked","checked");
          $("#label-"+no).removeClass("funky-check").addClass("blue-checked");
        } else {
          ini.removeAttr("checked");
          $("#label-"+no).removeClass("blue-checked").addClass("funky-check");
        }
      }
      $(".notifikasi").delay(2000).fadeOut();
    },
    error: function() {
      sweetAlert("Oops...", "Error: Terjadi kesalahan! silakan coba lagi.", "warning");
    }
  });
});

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

});
</script>
</body>
</html>