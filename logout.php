<?php
session_start();
if (isset($_SESSION['admin'])) {
	session_destroy();
	header("location: ./login-admin/");
} else {
	session_destroy();
	header("location: ./login/");
}
?>