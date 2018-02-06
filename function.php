<?php
function indo_date($date) {
	//pecah string tanggal berdasarkan "-", utk diambil perbagian
	$d = explode("-", $date);
	$tgl = $d[2];
	$bln = $d[1];
	$thn = $d[0];

	switch ($bln) {
		case '01':
			$bln = "Januari";
			break;
		case '02':
			$bln = "Februari";
			break;
		case '03':
			$bln = "Maret";
			break;
		case '04':
			$bln = "April";
			break;
		case '05':
			$bln = "Mei";
			break;
		case '06':
			$bln = "Juni";
			break;
		case '07':
			$bln = "Juli";
			break;
		case '08':
			$bln = "Agustus";
			break;
		case '09':
			$bln = "September";
			break;
		case '10':
			$bln = "Oktober";
			break;
		case '11':
			$bln = "November";
			break;
		case '12':
			$bln = "Desember";
			break;
		
		default:
			$bln = "Error";
			break;
	}

	return "$tgl-$bln-$thn";
}

function hari($date) {
	//ambil hari dari tanggal
	$d = date("D", strtotime($date));

	switch ($d) {
		case 'Mon':
			$hari = "Senin";
			break;
		case 'Tue':
			$hari = "Selasa";
			break;
		case 'Wed':
			$hari = "Rabu";
			break;
		case 'Thu':
			$hari = "Kamis";
			break;
		case 'Fri':
			$hari = "Jumat";
			break;
		case 'Sat':
			$hari = "Sabtu";
			break;
		case 'Sun':
			$hari = "Minggu";
			break;
		
		default:
			$hari = "Error";
			break;
	}

	return $hari;
}
?>