<?php
	session_start();

	#データベース取得
	require("db.php");

	#ログイン処理
	if( $_REQUEST["spls"] == "do_login" )
	{
		$sql = "SELECT * FROM users ";
		$sql.= "WHERE username = '" . $_REQUEST["login_id"] . "'";
		$pass = md5($_REQUEST["login_pass"]);
		$sql.= "AND password='" . $pass . "'";
		$sql.= "AND active=1";
		$result = executeQuery($sql);
		$is_login = 0;

		if( $row = mysql_fetch_array( $result ) ) 
		{
			$_SESSION["login_id"] = $_REQUEST["login_id"];
			$_SESSION["name"] = $row["name"];
			$is_login = 1;

			#ログイン後のページ（メンバーのみに公開されるページ）
			$login_url = "http://{$_SERVER["HTTP_HOST"]}/login/member/";
			header("Location: {$login_url}");
			exit;
		}
		mysql_free_result($result);
	}
//以下HTMLです。適宜変更してください。
//ちなみにすぐ下にある  ?＞  ←は消さないでね。消しちゃうと動かないよ。
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="jp" lang="jp">
<head>
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>LOGIN SYSTEM</title>
	<link rel="stylesheet" href="style.css" />
</head>
<body>
<?php
	if( $_SESSION["login_id"] == "" ){
?>
	<!-- ユーザー登録画面へ -->
<div style="margin:0px;padding:0px 0px 10px 0px;font-size:10px;">
	<a href="signup/">sign up?</a>
</div>
	<!-- ログインフォーム -->
	<form name="login_form" action="index.php" method="POST">
	<input type="hidden" name="spls" value="do_login"/>
<?php
		// ログインに失敗した時のエラー表示。
		if( $is_login == 0 and $_REQUEST["spls"] == "do_login" )
		{
			 $error_message = "ログインに失敗しました。";
		}
?>


<table border="0" cellpadding="0" cellspacing="5" style="padding-left:20px;">
<tr>
	<td>UserID</td>
	<td><input type="text" name="login_id" class="input" /></td>
</tr><tr>
	<td>Pass</td>
	<td><input type="password" name="login_pass" class="input" /></td>
</tr><tr>
	<td align="right" colspan="2"><input type="submit" name="loginbtn" value="log in" /></td>
</tr><tr>
	<td style="font-size:12px;text-align:right;padding:10px;" colspan="2">
<?php
if ($error_message) {
print $error_message;
}
?>
	</td>
</tr>
</table>
</form>


<?php
}else{
?>
<!-- ログインしたままトップページに戻った場合 -->
<div style="margin:0px;padding:0px 0px 10px 0px;font-size:10px;">
	<a href="logout.php">logout</a>
</div>
ログアウトして下さい。
<?php
}
?>
</body>
</html>
