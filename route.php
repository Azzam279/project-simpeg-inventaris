<?php
ob_start();
session_start();

$host = "http://$_SERVER[HTTP_HOST]/project-simpeg-inventaris";
$docs = "$_SERVER[DOCUMENT_ROOT]/project-simpeg-inventaris";

if (empty($_SESSION['level'])) { //jika tdk ada session level redirect ke login page
	header("location: $host/login/");
}
?>