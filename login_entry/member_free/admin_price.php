<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../css/styles-site.css" type="text/css" />

<link rel="stylesheet" href="calendar/dhtmlgoodies_calendar.css?" media="screen"></LINK>
<SCRIPT type="text/javascript" src="calendar/dhtmlgoodies_calendar.js?"></script>

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
<h2 class="heading2">参加費設定</h2>
<div class="entry_body">


<?php

session_start();

// データベースに接続する
require("../db.php");

$sql = "SELECT username as userID,email,active FROM users"; // SQL文

$result = executeQuery($sql);
$num = mysql_num_fields($result);

// 管理ユーザ判定
$sql2 = "SELECT email FROM users_admin "; // SQL文
$sql2.= "WHERE username = '" . $LoginId . "'";
$result2 = executeQuery($sql2);
if (mysql_num_rows($result2)){
	$admin_flag = true;
	}else{
	$admin_flag = false;
}

?>

<?php

include_once '../../signup/inc/php/config.php';
include_once '../../signup/inc/php/functions.php';

//setup some variables/arrays
$action = array();
$action['result'] = null;
$text = array();
$signup_count = 0;

//check if the form has been submitted
if(isset($_POST['signup'])){

	//cleanup the variables
	//prevent mysql injection
	$date1 = mysql_real_escape_string($_POST['thedate1']);
	$price1 = mysql_real_escape_string($_POST['price1']);
	$price2 = mysql_real_escape_string($_POST['price2']);
	$price3 = mysql_real_escape_string($_POST['price3']);
	$price4 = mysql_real_escape_string($_POST['price4']);
	$date2 = mysql_real_escape_string($_POST['thedate2']);
	$price5 = mysql_real_escape_string($_POST['price5']);
	$price6 = mysql_real_escape_string($_POST['price6']);
	$price7 = mysql_real_escape_string($_POST['price7']);
	$price8 = mysql_real_escape_string($_POST['price8']);
	
	//quick/simple validation
	if(!preg_match("/^[0-9]+$/", $price1) && $price1 != "" ){ 
	$action['result'] = 'error'; array_push($text,'金額は半角数字で入力して下さい。');
	}
	if(!preg_match("/^[0-9]+$/", $price2) && $price2 != "" ){ 
	$action['result'] = 'error'; array_push($text,'金額は半角数字で入力して下さい。');
	}
	if(!preg_match("/^[0-9]+$/", $price3) && $price3 != "" ){ 
	$action['result'] = 'error'; array_push($text,'金額は半角数字で入力して下さい。');
	}
	if(!preg_match("/^[0-9]+$/", $price4) && $price4 != "" ){ 
	$action['result'] = 'error'; array_push($text,'金額は半角数字で入力して下さい。');
	}
	if(!preg_match("/^[0-9]+$/", $price5) && $price5 != "" ){ 
	$action['result'] = 'error'; array_push($text,'金額は半角数字で入力して下さい。');
	}
	if(!preg_match("/^[0-9]+$/", $price6) && $price6 != "" ){ 
	$action['result'] = 'error'; array_push($text,'金額は半角数字で入力して下さい。');
	}
	if(!preg_match("/^[0-9]+$/", $price7) && $price7 != "" ){ 
	$action['result'] = 'error'; array_push($text,'金額は半角数字で入力して下さい。');
	}
	if(!preg_match("/^[0-9]+$/", $price8) && $price8 != "" ){ 
	$action['result'] = 'error'; array_push($text,'金額は半角数字で入力して下さい。');
	}

	if($action['result'] != 'error'){
		
		//add to the database
		$regiup = mysql_query("UPDATE price SET date1='$date1',price1='$price1',price2='$price2',price3='$price3',price4='$price4',date2='$date2',price5='$price5',price6='$price6',price7='$price7',price8='$price8' WHERE id='1'");
		
		if($regiup)
		{
		$signup_count = 1;
		$action['result'] = 'success';
		array_push($text,'設定情報の変更が完了しました。');
		}
		else{
			$action['result'] = 'error';
			array_push($text,'User could not be updated to the database. Reason: ' . mysql_error());
		}
	}
	$action['text'] = $text;
}

?>

<?= show_errors($action); ?>

<?php
if($action['result'] == null){
 // SQL文
$sql = "SELECT date1,price1,price2,price3,price4,date2,price5,price6,price7,price8 FROM price ";
$sql.= "WHERE id = '1'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result, MYSQL_NUM);

$_POST['thedate1'] = $row[0];
$_POST['price1'] = $row[1];
$_POST['price2'] = $row[2];
$_POST['price3'] = $row[3];
$_POST['price4'] = $row[4];
$_POST['thedate2'] = $row[5];
$_POST['price5'] = $row[6];
$_POST['price6'] = $row[7];
$_POST['price7'] = $row[8];
$_POST['price8'] = $row[9];

}
?>


<form method="post" action="">
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
			<td style="text-align: right">
<input type="text" size="12" name="price1" value="<?= $_POST['price1'] ?>" style="text-align:right" />円</td>
			<td style="text-align: right">
<input type="text" size="12" name="price2" value="<?= $_POST['price2'] ?>" style="text-align:right" />円</td>
			<td style="text-align: right">
<input type="text" size="12" name="price3" value="<?= $_POST['price3'] ?>" style="text-align:right" />円</td>
			<td style="text-align: right">
<input type="text" size="12" name="price4" value="<?= $_POST['price4'] ?>" style="text-align:right" />円</td>
		</tr>
		<tr>
			<th style="text-align: left">非会員</th>
			<td style="text-align: right">
<input type="text" size="12" name="price5" value="<?= $_POST['price5'] ?>" style="text-align:right" />円</td>
			<td style="text-align: right">
<input type="text" size="12" name="price6" value="<?= $_POST['price6'] ?>" style="text-align:right" />円</td>
			<td style="text-align: right">
<input type="text" size="12" name="price7" value="<?= $_POST['price7'] ?>" style="text-align:right" />円</td>
			<td style="text-align: right">
<input type="text" size="12" name="price8" value="<?= $_POST['price8'] ?>" style="text-align:right" />円</td>
		</tr>
		<tr>
			<th style="text-align: left">早期割引期限</th>
			<td colspan="2" style="text-align: center">

<input type="text" value="<?= $_POST['thedate1'] ?>" style="text-align:right" readonly name="thedate1"><input type="button" value="日付選択" onclick="displayCalendar(document.forms[0].thedate1,'yyyy-mm-dd',this)"></td>

			<td colspan="2" style="text-align: center">

<input type="text" value="<?= $_POST['thedate2'] ?>" style="text-align:right" readonly name="thedate2"><input type="button" value="日付選択" onclick="displayCalendar(document.forms[0].thedate2,'yyyy-mm-dd',this)"></td>

		</tr>
</table>
<center>
				<div><input value="トップへもどる" onclick="location.href='index.php'" type="button">&nbsp;<input type="submit" value="設定" name="signup" /></div>
				</center>
</form>

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
<li><a href="admin_regi.php">&nbsp;登録受付管理</a></li>
<li><a href="upload/upload.php">&nbsp;ファイルアップ</a></li>
<li><a href="admin_upload.php">&nbsp;ファイルアップ管理</a></li>
<li><a href="admin_price.php">&nbsp;参加費設定</a></li>
<li><a href="admin_user.php">&nbsp;ユーザ管理</a></li>
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

