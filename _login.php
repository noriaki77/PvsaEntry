<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="css/styles-site.css" type="text/css" />
<link rel="stylesheet" href="css/css3_button.css" type="text/css" />
</head>

<body>
<div id="container">

<!--ヘッダーここから-->
<h1>ホームページ テンプレート #001_blue 見出しタグ&lt;h1&gt;を使用</h1>
<div id="header"><img src="images/rogo.png" width="257" height="100" /></div>
<!--ヘッダーここまで-->

<!--ヘッダーメニューここから-->
<div id="menu">
<ul>
<li class="home"><a href="index.html">TOP</a></li>
</ul>
</div>
<!--ヘッダーメニューここまで-->

<!--メインここから-->
<div id="main">

<!--<img src="images/648.gif" width="648" height="300" />-->

<!--パンくずリストここから-->
<div class="pan"><a href="index.html">トップ</a> ＞ ログイン</div>
<!--パンくずリストここまで-->

<div class="category">
<h2 class="heading2">ログイン</h2>
<div class="entry_body">

<?php
	session_start();

	#データベース取得
	require("login/db.php");

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
//以下HTML
?>
	
<?php
	if( $_SESSION["login_id"] == "" ){
?>
	<!-- ユーザー登録画面へ -->

	<!-- ログインフォーム -->
	<form name="login_form" action="login.php" method="POST">
	<input type="hidden" name="spls" value="do_login"/>
<?php
		// ログインに失敗した時のエラー表示。
		if( $is_login == 0 and $_REQUEST["spls"] == "do_login" )
		{
			 $error_message = "ログインに失敗しました";
		}
?>


<p>ユーザID、パスワードを入力して「ログイン」ボタンを押してください。</p>

<p><font color="red">
<?php
if ($error_message) {
print $error_message;
}
?>
</font></p>

<table class="table2" >
<tr>
	<td>　ユーザID</td>
	<td><input type="text" size="30" name="login_id" class="input" /></td>
</tr><tr>
	<td>　パスワード</td>
	<td><input type="password" size="30" name="login_pass" class="input" /></td>
</tr><tr>
	<td></td>
	<td align="right" colspan="2"><input type="submit" name="loginbtn" value="ログイン" /></td>
</tr>
</table>
<p><a Href="fgp.php">パスワードを忘れた方はこちら</a></p>
</form>

<?php
}else{
?>
<!-- ログインしたままトップページに戻った場合 -->
<p>一度ログアウトして下さい。</p>
<center>
<p><A Href="./login/logout.php" class="button white">ログアウト</A></p>
<?php
}
?>
</center>
</div>
</div>


<!--更新情報ここから-->
<!--更新情報ここまで-->


</div>
<!--メインここまで-->

<!--[if !IE]>サイドメニューここから<![endif]-->
<div id="sub">
<div class="category">
<h3 class="accordion_head">初めて利用される方へ</h3>
<div class="entry_body">
<p>はじめて利用される方はユーザ登録をお願いいたします。 下の「ユーザ登録」ボタンから登録を開始できます。</p>
<p><center><A Href="signup.php" class="button orange">ユーザ登録</A></center></p>
</div>
</div>

<div class="category">
<h3 class="accordion_head">ユーザ登録がおすみの方へ</h3>
<div class="entry_body">
<p>すでにユーザー登録がおすみの方はこちらからログインしてください。</p>
<p><center><A Href="login.php" class="button orange">ログイン</A></center></p>
<p><center><a Href="fgp.php">パスワードを忘れた方はこちら</a></center></p>
</div>
</div>

</div>
<!--[if !IE]>サイドメニューここまで<![endif]-->

<div style="clear:both;"></div>

<!--フッターここから-->
<div id="footer">
<p>Copyright(C) ホームページ名 All Rights Reserved.</p>
</div>
<!--フッターここまで-->

</div><!--"container"-->

</body>
</html>
