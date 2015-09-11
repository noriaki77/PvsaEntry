<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../css/styles-site2.css" type="text/css" />
<link rel="stylesheet" href="../../css/css3_button.css" type="text/css" />
</head>

<body>

<?php
require_once("../session2.php");

// データベースに接続する
require("../db.php");
$sql = "SELECT email FROM users "; // SQL文
$sql.= "WHERE username = '" . $LoginId . "'";
$result = executeQuery($sql);
$row = mysql_fetch_assoc($result);

// 管理ユーザ判定
$sql2 = "SELECT email FROM users_admin "; // SQL文
$sql2.= "WHERE username = '" . $LoginId . "'";
$result2 = executeQuery($sql2);
if (mysql_num_rows($result2)){
	$admin_flag = true;
	}else{
	$admin_flag = false;
}

 // SQL文
$sql3 = "SELECT date1,price1,price2,price3,price4,date2,price5,price6,price7,price8 FROM price ";
$sql3.= "WHERE id = '1'";
$result3 = executeQuery($sql3);
$row3 = mysql_fetch_array($result3, MYSQL_NUM);

$day1 = strtotime($row3[0]);
$thedate1 = date("Y年m月d日",$day1);
$price1 = number_format($row3[1]);
$price2 = number_format($row3[2]);
$price3 = number_format($row3[3]);
$price4 = number_format($row3[4]);
$day2 = strtotime($row3[5]);
$thedate2 = date("Y年m月d日",$day2);
$price5 = number_format($row3[6]);
$price6 = number_format($row3[7]);
$price7 = number_format($row3[8]);
$price8 = number_format($row3[9]);

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
<div class="pan"><a href="index.php">トップ</a></div>
<!--パンくずリストここまで-->

<div class="category">
<h2 class="heading2">登録フォーム概要</h2>
<div class="entry_body">
参加費一覧表
<table border="1" cellpadding="1" cellspacing="1">
		<tr>
			<th rowspan="2" style="text-align: center">&nbsp;</th>
			<th colspan="2" style="text-align: center">参加費</th>
			<th colspan="2" style="text-align: center">懇親会費</th>
		</tr>
		<tr>
			<td style="text-align: center">早期割引</td>
			<td style="text-align: center">通常</td>
			<td style="text-align: center">早期割引</td>
			<td style="text-align: center">通常</td>
		</tr>
		<tr>
			<th style="text-align: left">会員</th>
			<td style="text-align: right"><?= $price1 ?>&nbsp;円</td>
			<td style="text-align: right"><?= $price2 ?>&nbsp;円</td>
			<td style="text-align: right"><?= $price3 ?>&nbsp;円</td>
			<td style="text-align: right"><?= $price4 ?>&nbsp;円</td>
		</tr>
		<tr>
			<th style="text-align: left">非会員</th>
			<td style="text-align: right"><?= $price5 ?>&nbsp;円</td>
			<td style="text-align: right"><?= $price6 ?>&nbsp;円</td>
			<td style="text-align: right"><?= $price7 ?>&nbsp;円</td>
			<td style="text-align: right"><?= $price8 ?>&nbsp;円</td>
		</tr>
		<tr>
			<th style="text-align: left">早期割引期限</th>
			<td colspan="2" style="text-align: center"><?= $thedate1 ?></td>
			<td colspan="2" style="text-align: center"><?= $thedate2 ?></td>
		</tr>
</table>
<p><center><a href="form/index.php?<? echo 'LoginId='.$LoginId ?>&<? echo 'email='.$row['email'] ?>" class="button orange">参加登録申込</A></center></p>
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
