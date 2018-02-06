<?php
if (isset($_FILES)) {
	session_start();
	include_once("../../database/koneksi.php");

    $whitelist = array('jpg', 'jpeg', 'png', 'gif');
	$filename  = null;
	$error     = 'No file uploaded.';
	$status    = 2;

    if (isset($_FILES['foto'])) {
		$tmp_name = $_FILES['foto']['tmp_name'];
		$filename     = basename(strtolower($_FILES['foto']['name']));
    	$destination = '../../images/pegawai/' . $filename;
		$error    = $_FILES['foto']['error'];

		if ($error === UPLOAD_ERR_OK) {
			$extension = pathinfo($filename, PATHINFO_EXTENSION);

			if (in_array($extension, $whitelist)) {
        		$folder = '../../images/pegawai/'. $filename;
				move_uploaded_file($tmp_name, $destination);

				//identitas file asli
				if ($extension == "jpeg" || $extension == "jpg") {
					if (!imagecreatefromjpeg($folder)) {
						$_SESSION['peringatan'] = "Image Error! Max size 2MB.";
						unlink($folder);
						header("location: ./");
						exit();
					}else{
						$img_src = imagecreatefromjpeg($folder);
					}
				}else if ($extension == "png") {
					if (!imagecreatefrompng($folder)) {
						$_SESSION['peringatan'] = "Image Error! Max size 2MB.";
						unlink($folder);
						header("location: ./");
						exit();
					}else{
						$img_src = imagecreatefrompng($folder);
					}
				}else{
					if (!imagecreatefromgif($folder)) {
						$_SESSION['peringatan'] = "Image Error! Max size 2MB.";
						unlink($folder);
						header("location: ./");
						exit();
					}else{
						$img_src = imagecreatefromgif($folder);
					}
				}
				$src_width = imagesx($img_src);
				$src_height = imagesy($img_src);

				//Set ukuran gambar hasil perubahan
				$dst_width = 155;
				$dst_height = ($dst_width/$src_width)*$src_height;

				//proses perubahan ukuran
				$img  = imagecreatetruecolor($dst_width, $dst_height);
				imagecopyresampled($img, $img_src, 0, 0, 0, 0, $dst_width, $dst_height, $src_width, $src_height);

				//simpan gambar hasil perubahan
				if (imagejpeg($img, "../../images/pegawai/$_SESSION[id]-".time().".jpg" ,80)) {
        			$status = 1;
					//mengambil data foto pegawai berdasarkan id pegawai
					$del_foto = $db->prepare("SELECT foto FROM pegawai WHERE id_pegawai = :id");
					$del_foto->execute(array(":id" => $_SESSION['id']));
					$old_foto = $del_foto->fetch(PDO::FETCH_OBJ);
					//meng-update data foto pegawai berdasarkan id pegawai
					$sql = $db->prepare("UPDATE pegawai SET foto = :foto WHERE id_pegawai = :id");
					$sql->execute(array(
						":id" => $_SESSION['id'],
						":foto" => "$_SESSION[id]-".time().".jpg",
						));
					if ($sql->rowCount() == 1) {
						unlink("../../images/pegawai/$old_foto->foto"); //hapus foto lama
						$pesan = "Sukses";
					} else {
						$pesan = "Gagal";
					}
					$filename = "$_SESSION[id]-".time().".jpg";
				} else {
					$filename = "no-photo-available.jpg";
				}
				//tutup koneksi db
				$del_foto = 0;
				$sql = 0;
				$db = 0;

				//hapus gambar di memory komputer
				imagedestroy($img_src);
				imagedestroy($img);
				unlink($folder);
			} else {
        		$status = 2;
				$error = 'Invalid file type uploaded.';
			}
		}
	}

    $hasil = array(
        'status' => $status,
        'name' => $filename,
        'error' => $error,
        'pesan' => $pesan,
        'date' => time(),
    );
    echo json_encode($hasil);
    die();
}
?>