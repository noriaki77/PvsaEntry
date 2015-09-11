<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../css/styles-site.css" type="text/css" />

</head>

<body>

<?php
require_once("../session.php");
?>

<div id="container"><!--"container"を削除するとデザインが崩れます-->

<!--ヘッダーここから-->
<!--
<h1>ホームページ テンプレート #001_blue 見出しタグ&lt;h1&gt;を使用</h1>
-->
<div id="header">
<!--
<img src="../../images/rogo.png" width="257" height="100" />
-->
</div>
<!--ヘッダーここまで-->

<!--ヘッダーメニューここから-->

<!--パンくずリストここから-->
<div class="pan"><a href="index.php">トップ</a></div>
<!--パンくずリストここまで-->

<!--ヘッダーメニューここまで-->

<!--メインここから-->
<div id="main">

<!--<img src="images/648.gif" width="648" height="300" />-->

<div class="category">
<h2 class="heading2">登録ユーザ管理</h2>
<div class="entry_body">

<?php

session_start();

$key=$_POST['inpnum'];

require("../db.php");
/*
// 管理ユーザ判定
$sql2 = "SELECT email FROM users_admin "; // SQL文
$sql2.= "WHERE username = '" . $LoginId . "'";
$result2 = executeQuery($sql2);
if (mysql_num_rows($result2)){
	$admin_flag = true;
	}else{
	$admin_flag = false;
}
*/
//SQL文 tab1表からnumber列の値がが入力フィールドで入力された値と等しい行を抽出
//$sql = "select * from users where username = '$key'";
$sql = "SELECT * FROM users_ref "; // SQL文
$sql.= "WHERE id = '" . $key . "'";

//SQL文を実行する
$rs = executeQuery($sql);

//mysql_num_rows　関数を使用し行数を取得する
$rows = mysql_num_rows($rs);

//入力されたnumberの行があった場合は該当データを削除する
if ($rows > 0) {

//SQL文 tab1表からnumber列の値が入力フィールドで入力された値と等しい行を削除
$sql3 = "delete from users_ref "; // SQL文
$sql3.= "WHERE id = '" . $key . "'";

	
//SQL文を実行する
	$rs = executeQuery($sql3);

//削除完了のメッセージを出力
	print("登録番号" .$key . "のデータを削除しました。<br>");
}
//入力されたnumberの行が存在しなかった場合はエラーメッセージを出力する
else {
	print("登録番号" .$key . "のデータは登録されていません。<br>");
}	

mysql_free_result($result);
//--- 終了 --->
?>
<br />
<input type="button" value="一覧へ戻る" onClick="history.go(-2)">
</div>
</div>

<!--更新情報ここから-->
<!--更新情報ここまで-->


</div>
<!--メインここまで-->

<!--[if !IE]>サイドメニューここから<![endif]-->
<div id="sub">
<!--
<div class="category">
<div class="entry_body">

<p>ようこそ！ <?= $LoginId ?> さん<br />
<a href="user_regi.php">[登録情報の変更]</a></p>
<p><form>
	<input type="button" value="ログアウト" onClick="location.href='../logout.php'">
</form></p>

</div>
</div>
-->
<div class="category">
<h3 class="accordion_head">コンテンツ</h3>
<ul>
<li><a href="form_summary.php">&nbsp;登録受付</a></li>
<li><a href="form_update.php">&nbsp;登録修正</a></li>
<li><a href="admin_regi.php">&nbsp;登録管理</a></li>
<li><a href="admin_price.php">&nbsp;参加費設定</a></li>
<li><a href="admin_ref.php">&nbsp;登録ユーザ管理</a></li>
<li><a href="text_update.php">&nbsp;要約修正</a></li>
<li><a href="text_ref_summary.php">&nbsp;要約参照</a></li>
<li><a href="upload/upload.php">&nbsp;ファイルアップ</a></li>
<li><a href="admin_upload.php">&nbsp;ファイルアップ管理</a></li>
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

