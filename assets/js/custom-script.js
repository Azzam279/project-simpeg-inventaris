var host = $("#host").val();

function tampil_alert(tipe, pesan) {
	(function (namespace, $) {
		"use strict";

		var DemoUIMessages = function () {
			// Create reference to this instance
			var o = this;
			// Initialize app when document is ready
			$(document).ready(function () {
				o.initialize();
			});

		};
		var p = DemoUIMessages.prototype;

		// =========================================================================
		// MEMBER
		// =========================================================================

		p.messageTimer = null;

		// =========================================================================
		// INIT
		// =========================================================================

		p.initialize = function () {
			this._initToastr();
		};

		// =========================================================================
		// INIT TOASTR
		// =========================================================================

		// events
		p._initToastr = function () {
			this._initActionToastr();
		};

		// =========================================================================
		// ACTION TOASTS
		// =========================================================================

		p._initActionToastr = function () {
			var o = this;
			toastr.clear();

			o._toastrStateConfig();
			toastr.options.progressBar = true;
			if (tipe == "success") {
				toastr.success(pesan, '');
			} else if (tipe == "warning") {
				toastr.warning(pesan, '');
			} else if (tipe == "error") {
				toastr.error(pesan, '');
			} else {
				toastr.info(pesan, '');
			}
		};

		// =========================================================================
		// TOAST CONFIG
		// =========================================================================

		p._toastrStateConfig = function () {
			toastr.options.closeButton = false;
			toastr.options.progressBar = false;
			toastr.options.debug = false;
			toastr.options.positionClass = 'toast-top-full-width';
			toastr.options.showDuration = 333;
			toastr.options.hideDuration = 333;
			toastr.options.timeOut = 4000;
			toastr.options.extendedTimeOut = 4000;
			toastr.options.showEasing = 'swing';
			toastr.options.hideEasing = 'swing';
			toastr.options.showMethod = 'slideDown';
			toastr.options.hideMethod = 'slideUp';
		};

		// =========================================================================
		namespace.DemoUIMessages = new DemoUIMessages;

	}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):
}

(function (namespace, $) {
	"use strict";

	var DemoFormComponents = function () {
		// Create reference to this instance
		var o = this;
		// Initialize app when document is ready
		$(document).ready(function () {
			o.initialize();
		});

	};
	var p = DemoFormComponents.prototype;

	// =========================================================================
	// INIT
	// =========================================================================

	p.initialize = function () {
		this._initInputMask();
		this._initDatePicker();
	};

	// =========================================================================
	// InputMask
	// =========================================================================

	p._initInputMask = function () {
		if (!$.isFunction($.fn.inputmask)) {
			return;
		}
		$(":input").inputmask();
		$(".form-control.dollar-mask").inputmask('$ 999,999,999.99', {numericInput: true, rightAlignNumerics: false});
		$(".form-control.euro-mask").inputmask('€ 999.999.999,99', {numericInput: true, rightAlignNumerics: false});
		$(".form-control.time-mask").inputmask('h:s', {placeholder: 'hh:mm'});
		$(".form-control.time12-mask").inputmask('hh:mm t', {placeholder: 'hh:mm xm', alias: 'time12', hourFormat: '12'});
	};

	// =========================================================================
	// Date Picker
	// =========================================================================

	p._initDatePicker = function () {
		if (!$.isFunction($.fn.datepicker)) {
			return;
		}

		$('.demo-date').datepicker({autoclose: true, todayHighlight: true, format: "dd-mm-yyyy"});
		$('#demo-date-month').datepicker({autoclose: true, todayHighlight: true, minViewMode: 1});
		$('#demo-date-format').datepicker({autoclose: true, todayHighlight: true, format: "dd-mm-yyyy"});
		$('#demo-date-range').datepicker({todayHighlight: true});
		$('#demo-date-inline').datepicker({todayHighlight: true});
	};

	// =========================================================================
	namespace.DemoFormComponents = new DemoFormComponents;
}(this.materialadmin, jQuery)); // pass in (namespace, jQuery):

//tooltip bootstrap
$('[data-toggle="tooltip"]').tooltip();

//Hanya boleh Diisi dengan angka
function isNumberKeyAngka(evt) {
   var charCode = (evt.which) ? evt.which : event.keyCode
   if ((charCode >= 48) && (charCode <= 57))
      return true;
   return false;
}

//Hanya boleh Diisi dengan huruf
function isNumberKeyHuruf(evt) {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if ((charCode < 65) && (charCode != 32))
        return false;
     return true;
}

//tampilkan detail data pegawai berdasarkan pangkat, golongan, jabatan, eselon, atau unit kerja
function detail_data_pegawai(id, attr, title, val) {
	$.ajax({
		url: host+'/pegawai/detail-data-pegawai.php',
		type: 'POST',
		data: 'id_pgw='+id+'&attr='+attr+'&title='+title+'&val='+val,
		beforeSend: function() {
			$("#show-detail-data-pgw").html("<center>Loading...</center>");
		},
		success: function(respon) {
			$("#show-detail-data-pgw").html(respon);
		},
		error: function() {
			alert("Error: Terjadi kesalahan! silakan coba lagi.");
		}
	});
}

//fungsi menampilkan form modal pangkat, jabatan, golongan, eselon, atau unit kerja
function report_pgw(data) {
	$("#formModalReport").modal(); //tampil modal

	//konten modal
	$.ajax({
		url: host+'/ajax-report.php',
		type: 'POST',
		data: 'data='+data,
		beforeSend: function() {
			$("#output-report-pgw").html("<center>Loading...</center>");
		},
		success: function(respon) {
			$("#output-report-pgw").html(respon);
		},
		error: function() {
			alert("Error: Terjadi kesalahan! silakan coba lagi.");
		}
	});
}

//fungsi menampilkan ruangan berdasarkan satuan kerja pd form modal report barang
$("#sk-m").change(function() {
	var nil = this.value.split("|");

	$.ajax({
		url: host+'/ajax-report-barang.php',
		type: 'POST',
		data: 'sk='+nil[0],
		success: function(respon) {
			$("#room-m").html(respon);
		},
		error: function() {
			alert("Error: Terjadi kesalahan! silakan coba lagi.");
		}
	});
});

//fungsi print laporan barang
$("#form-inv-barang").submit(function(e) {
	e.preventDefault();

	var sk = $(this).find("select[name='sk-m']").val().split("|");
	var room = $(this).find("select[name='room-m']").val();

	if (room != "") {
		//cetak
		window.open(host+'/inventaris/laporan/barang.php?sk='+sk[0]+'&sk_name='+sk[1]+'&room='+room,'_blank','scrollbars=yes, resizeable=yes, top=0, left=100, width=1170, height=660');
	}
});

//fungsi print laporan kendaraan
$("#form-inv-kend").submit(function(e) {
	e.preventDefault();

	var sub = $(this).find("select[name='sub-m']").val();
	var upb = $(this).find("select[name='upb-m']").val();

	if (upb != "" && sub != "") {
		//cetak
		window.open(host+'/inventaris/laporan/kendaraan.php?sub_unit='+sub+'&upb='+upb,'_blank','scrollbars=yes, resizeable=yes, top=0, left=100, width=1170, height=660');
	}
});

$("#sub-m").change(function() {
	$.ajax({
		url: host+'/inventaris/kendaraan/ajax.php',
		type: 'POST',
		data: 'data='+this.value+'&input='+true,
		success: function(respon) {
			$("#upb-m").html(respon);
		},
		error: function(event, textStatus, errorThrown) {
			alert('Error Message: '+ textStatus + ' , HTTP Error: '+errorThrown);
		}
	});
});

//proses ganti password
$(function() {
	$("#form-chpass").submit(function(e) {
		e.preventDefault();
		var ini = $(this);

		$.ajax({
			url: ini.attr("action"),
			type: 'POST',
			data: ini.serialize(),
			beforeSend: function() {
				ini.find("button[type='submit'] i").remove();
				ini.find("button[type='submit']").prepend("<i class='fa fa-spinner fa-spin'></i> ");
				ini.find("button[type='submit']").attr("disabled","disabled");
			},
			success: function(respon) {
				ini.find("button[type='submit'] i").remove();
				ini.find("button[type='submit']").prepend("<i class='fa fa-check'></i> ");
				ini.find("button[type='submit']").removeAttr("disabled");

				var dt = $.parseJSON(respon);
				if (dt.info == "sukses") {
					tampil_alert("success", dt.pesan);
					//reset fields
					$("#form-chpass")[0].reset();
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