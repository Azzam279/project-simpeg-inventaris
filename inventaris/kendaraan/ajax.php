<?php
if (isset($_POST['input'])) {
	if ($_POST['data'] == "Bidang Pemerintahan") {
		echo "
		<option value=''></option>
		<option value='Biro Pemerintahan'>Biro Pemerintahan</option>
		<option value='Biro Hukum'>Biro Hukum</option>
		<option value='Biro Organisasi'>Biro Organisasi</option>
		";
	} else if ($_POST['data'] == "Bidang Pembangunan") {
		echo "
		<option value=''></option>
		<option value='Biro Perekonomian'>Biro Perekonomian</option>
		<option value='Biro Kesejahteraan Rakyat'>Biro Kesejahteraan Rakyat</option>
		<option value='Biro Hubungan Masyarakat'>Biro Hubungan Masyarakat</option>
		";
	} else if ($_POST['data'] == "Bidang Administrasi Umum") {
		echo "
		<option value=''></option>
		<option value='Biro Umum'>Biro Umum</option>
		<option value='Biro Perlengkapan'>Biro Perlengkapan</option>
		<option value='Biro Keuangan'>Biro Keuangan</option>
		";
	} else {
		echo "
		<option value=''></option>
		";
	}
}

if (isset($_POST['edit'])) {
	if ($_POST['data'] == "Bidang Pemerintahan") {
		$upb1 = $_POST['upb']=="Biro Pemerintahan" ? "selected" : "";
		$upb2 = $_POST['upb']=="Biro Hukum" ? "selected" : "";
		$upb3 = $_POST['upb']=="Biro Organisasi" ? "selected" : "";
		echo "
		<option value=''></option>
		<option value='Biro Pemerintahan' $upb1>Biro Pemerintahan</option>
		<option value='Biro Hukum' $upb2>Biro Hukum</option>
		<option value='Biro Organisasi' $upb3>Biro Organisasi</option>
		";
	} else if ($_POST['data'] == "Bidang Pembangunan") {
		$upb1 = $_POST['upb']=="Biro Perekonomian" ? "selected" : "";
		$upb2 = $_POST['upb']=="Biro Kesejahteraan Rakyat" ? "selected" : "";
		$upb3 = $_POST['upb']=="Biro Hubungan Masyarakat" ? "selected" : "";
		echo "
		<option value=''></option>
		<option value='Biro Perekonomian' $upb1>Biro Perekonomian</option>
		<option value='Biro Kesejahteraan Rakyat' $upb2>Biro Kesejahteraan Rakyat</option>
		<option value='Biro Hubungan Masyarakat' $upb3>Biro Hubungan Masyarakat</option>
		";
	} else if ($_POST['data'] == "Bidang Administrasi Umum") {
		$upb1 = $_POST['upb']=="Biro Umum" ? "selected" : "";
		$upb2 = $_POST['upb']=="Biro Perlengkapan" ? "selected" : "";
		$upb3 = $_POST['upb']=="Biro Keuangan" ? "selected" : "";
		echo "
		<option value=''></option>
		<option value='Biro Umum' $upb1>Biro Umum</option>
		<option value='Biro Perlengkapan' $upb2>Biro Perlengkapan</option>
		<option value='Biro Keuangan' $upb3>Biro Keuangan</option>
		";
	} else {
		echo "
		<option value=''></option>
		";
	}
}
?>