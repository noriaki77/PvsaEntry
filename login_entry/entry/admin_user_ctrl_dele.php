<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../css/styles-site2.css" type="text/css" />

</head>

<body>

<?php
require_once("../session2.php");
?>

<div id="container"><!--"container"を削除するとデザインが崩れます-->

<!--ヘッダーここから-->
<h1>ホームページ テンプレート #001_blue 見出しタグ&lt;h1&gt;を使用</h1>
<div id="header">
<!--img src="images/rogo.png" width="257" height="100" />-->
</div>
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
<div class="pan"><a href="index.php">トップ</a> ＞ ユーザ管理</div>
<!--パンくずリストここまで-->

<div class="category">
<h2 class="heading2">ユーザ管理</h2>
<div class="entry_body">

<?php

session_start();

$key=$_POST['inpnum'];

require("../db.php");

// 管理ユーザ判定
$sql2 = "SELECT email FROM users_admin "; // SQL文
$sql2.= "WHERE username = '" . $LoginId . "'";
$result2 = executeQuery($sql2);
if (mysql_num_rows($result2)){
	$admin_flag = true;
	}else{
	$admin_flag = false;
}

//SQL文 tab1表からnumber列の値がが入力フィールドで入力された値と等しい行を抽出
//$sql = "select * from users where username = '$key'";
$sql = "SELECT * FROM users "; // SQL文
$sql.= "WHERE username = '" . $key . "'";

//SQL文を実行する
$rs = executeQuery($sql);

//mysql_num_rows　関数を使用し行数を取得する
$rows = mysql_num_rows($rs);

//入力されたnumberの行があった場合は該当データを削除する
if ($rows > 0) {

//SQL文 tab1表からnumber列の値が入力フィールドで入力された値と等しい行を削除
$sql = "delete from users "; // SQL文
$sql.= "WHERE username = '" . $key . "'";

	
//SQL文を実行する
	$rs = executeQuery($sql);

//削除完了のメッセージを出力
	print("userID：" .$key . "のデータを削除しました。<br>");
}
//入力されたnumberの行が存在しなかった場合はエラーメッセージを出力する
else {
	print("userID：" .$key . "のデータは登録されていません。<br>");
}	

mysql_free_result($result);
//--- 終了 --->
?>
<br />
<input type="button" value="ユーザ一覧へ戻る" onClick="history.go(-2)">
</div>
</div>

<!--更新情報ここから-->
<!--更新情報ここまで-->


</div>
<!--メインここまで-->

<!--[if !IE]>サイドメニューここから<![endif]-->
<div id="sub">
<div class="category">
<div class="entry_body">

<p>ようこそ！ <?= $LoginId ?> さん<br />
<a href="user_regi.php">[登録情報の変更]</a></p>
<p><form>
	<input type="button" value="ログアウト" onClick="location.href='../logout.php'">
</form></p>
</div>
</div>

<div class="category">
<h3 class="accordion_head">メニューリスト</h3>
<ul>
<li><a href="form_summary.php">登録フォーム</a></li>
<li><a href="upload/upload.php">ファイルアップ</a></li>
</ul>
</div>

<?php if ($admin_flag == true): ?>
<div class="category">
<h3 class="accordion_head">管理者メニュー</h3>
<ul>
<li><a href="admin_user.php">ユーザ管理</a></li>
<li><a href="admin_upload.php">ファイルアップ管理</a></li>
<li><a href="admin_price.php">参加費設定</a></li>
<li><a href="#">メール通知管理</a></li>
<li><a href="#">登録受付管理</a></li>
</ul>
</div>
<?php endif; ?>

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
