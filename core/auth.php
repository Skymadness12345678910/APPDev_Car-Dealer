<?php

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

// always load a fresh copy of the page
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// if not logged in, send the visitor to the login page
if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
	exit;
}

?>