<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../css/styles-site.css" type="text/css" />
<link rel="stylesheet" href="../../login/style.css" />
<link rel="stylesheet" href="../../css/styles-site_login.css" type="text/css" />
</head>

<body>
<div id="container"><!--"container"を削除するとデザインが崩れます-->

<!--ヘッダーここから-->
<h1>ホームページ テンプレート #001_blue 見出しタグ&lt;h1&gt;を使用</h1>
<div id="header"><img src="../../images/rogo.png" width="257" height="100" /></div>
<!--ヘッダーここまで-->

<!--ヘッダーメニューここから-->
<div id="menu">
<ul>
<li class="home"><a href="#1">TOP</a></li>
<li><a href="#2">MAIL</a></li>
<li><a href="#3">LINKS</a></li>
<li><a href="#4">メニューはテキストの変更、数の増減が可能です</a></li>
</ul>
</div>
<!--ヘッダーメニューここまで-->

<!--メインここから-->
<div id="main">

<!--<img src="images/648.gif" width="648" height="300" />-->

<!--パンくずリストここから-->
<div class="pan"><a href="index.php">トップ</a> ＞ 管理者ログイン</div>
<!--パンくずリストここまで-->

<div class="category">
<h2>管理者ログイン</h2>
<div class="entry_body">
<?php
session_start();

// エラーメッセージを格納する変数を初期化
$error_message = "";

// ログインボタンが押されたかを判定
// 初めてのアクセスでは認証は行わずエラーメッセージは表示しないように
if (isset($_POST["login"])) {

// user_nameが「php」でpasswordが「admin」だとログイン出来るようになっている
if ($_POST["user_name"] == "php" && $_POST["password"] == "admin") {

// ログインが成功した証をセッションに保存
$_SESSION["user_name"] = $_POST["user_name"];

// 管理者専用画面へリダイレクト
$login_url = "http://{$_SERVER["HTTP_HOST"]}/login/member/anq_result.php";
header("Location: {$login_url}");
exit;
}
$error_message = "ユーザ名もしくはパスワードが違っています。";
}
?>


<?php
if ($error_message) {
print '<font color="red">'.$error_message.'</font>';
}
?>
<form action="login.php" method="POST">
管理者ＩＤ：<input type="text" name="user_name" value="" /><br />
パスワード：<input type="password" name="password" value"" /><br />
<input type="submit" name="login" value="ログイン" />
</form>

</div>
</div>

</div>
<!--メインここまで-->

<!--[if !IE]>サイドメニューここから<![endif]-->
<div id="sub">
<div class="category">
<h3><div class="h3kazari">ユーザ情報</div></h3>
<div class="entry_body">
<?php
require_once("../session.php");
?>
<p>ようこそ！ <?= $LoginId ?> さん</p>
<p><form>
	<input type="button" value="ログアウト" onClick="location.href='../logout.php'">
</form></p>
</div>
</div>

<div class="category">
<h3><div class="h3kazari">サイドメニューでのリストの表示</div></h3>
<ul>
<li><a href="#4">カテゴリ001</a></li>
<li><a href="#4">カテゴリ002</a></li>
<li><a href="#4">カテゴリ003</a></li>
<li><a href="#4">カテゴリ004</a></li>
</ul>
</div>

<div class="category">
<h3><div class="h3kazari">管理者メニュー</div></h3>
<ul>
<li><a href="login.php">管理者ログイン</a></li>
</ul>
</div>

</div>
<!--[if !IE]>サイドメニューここまで<![endif]-->

<div style="clear:both;"></div><!--デザインが崩れるので削除しない事-->

<!--フッターここから-->
<div id="footer">
<p>Copyright(C) ホームページ名 All Rights Reserved.</p>
</div>
<!--フッターここまで-->

</div><!--"container"-->

</body>
</html>
