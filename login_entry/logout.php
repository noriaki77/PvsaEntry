<?php
session_start();

	$_SESSION = array();

	if(isset($_COOKIE[session_name()])) {
		setcookie(session_name(), '', time()-42000, '/');
	}

	session_destroy();
//ログアウト後のURL
	$logout_url = "http://{$_SERVER["HTTP_HOST"]}/logout_entry.html";
	header("Location: {$logout_url}");
	exit;