<?php
	session_start();

	if( $_SESSION["login_id"] == "" ){
			$login_url = "http://{$_SERVER["HTTP_HOST"]}/login_entry.php";
			header("Location: {$login_url}");
			exit;
	}else{
		$UserName = $_SESSION["name"];
		$LoginId = $_SESSION["login_id"];
	}
	
?>