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
<div class="pan"><a href="index.php">トップ</a> ＞ 参加費設定</div>
<!--パンくずリストここまで-->

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
	$date1 = mysql_real_escape_string($_POST['date1']);
	$price1 = mysql_real_escape_string($_POST['price1']);
	$price2 = mysql_real_escape_string($_POST['price2']);
	$price3 = mysql_real_escape_string($_POST['price3']);
	$price4 = mysql_real_escape_string($_POST['price4']);
	$date2 = mysql_real_escape_string($_POST['date2']);
	$price5 = mysql_real_escape_string($_POST['price5']);
	$price6 = mysql_real_escape_string($_POST['price6']);
	$price7 = mysql_real_escape_string($_POST['price7']);
	$price8 = mysql_real_escape_string($_POST['price8']);
	
	//quick/simple validation
	//if(!preg_match("/^[0-9]+$/", $price1) && $price1 != "" ){ 
	//$action['result'] = 'error'; array_push($text,'金額は半角数字で入力して下さい。');
	//}
	
	if($action['result'] != 'error'){
		
		$date1 =  '.$_POST["year1"]. '-' .$_POST["month1"]. '-' .$_POST["day1"].' ;
		$date2 =  '.$_POST["year2"]. '-' .$_POST["month2"]. '-' .$_POST["day2"].' ;
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

$date1 = $row[0];
$year1 = DATE_FORMAT($date1,'%Y');
$month1 = DATE_FORMAT($date1,'%m');
$day1 = DATE_FORMAT($date1,'%d');
$_POST['price1'] = $row[1];
$_POST['price2'] = $row[2];
$_POST['price3'] = $row[3];
$_POST['price4'] = $row[4];
$date2 = $row[5];
$year2 = DATE_FORMAT($date2,'%Y');
$month2 = DATE_FORMAT($date2,'%m');
$day2 = DATE_FORMAT($date2,'%d');
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
<input type="text" size="12" name="price1" value="<?= $_POST['price1'] ?>" />円</td>
			<td style="text-align: right">
<input type="text" size="12" name="price2" value="<?= $_POST['price2'] ?>" />円</td>
			<td style="text-align: right">
<input type="text" size="12" name="price3" value="<?= $_POST['price3'] ?>" />円</td>
			<td style="text-align: right">
<input type="text" size="12" name="price4" value="<?= $_POST['price4'] ?>" />円</td>
		</tr>
		<tr>
			<th style="text-align: left">非会員</th>
			<td style="text-align: right">
<input type="text" size="12" name="price5" value="<?= $_POST['price5'] ?>" />円</td>
			<td style="text-align: right">
<input type="text" size="12" name="price6" value="<?= $_POST['price6'] ?>" />円</td>
			<td style="text-align: right">
<input type="text" size="12" name="price7" value="<?= $_POST['price7'] ?>" />円</td>
			<td style="text-align: right">
<input type="text" size="12" name="price8" value="<?= $_POST['price8'] ?>" />円</td>
		</tr>
		<tr>
			<th style="text-align: left">早期割引期限</th>
			<td colspan="2" style="text-align: center">
<select name="year1">
<option value="">--</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>

<option value="2012">2021</option>
<option value="2012">2022</option>
<option value="2013">2023</option>
<option value="2014">2024</option>
<option value="2015">2025</option>
<option value="2016">2026</option>
<option value="2017">2027</option>
<option value="2018">2028</option>
<option value="2019">2029</option>
<option value="2020">2030</option>
</select>
年 
<SELECT name="month1">
<option value="">--</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</SELECT>
月 
<SELECT name="day1">
<option value="">--</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
日
</form>
			<td colspan="2" style="text-align: center">
<form name="yyyymmdd" method="post" action="#">
<select name="year2">
<option value="">--</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>

<option value="2012">2021</option>
<option value="2012">2022</option>
<option value="2013">2023</option>
<option value="2014">2024</option>
<option value="2015">2025</option>
<option value="2016">2026</option>
<option value="2017">2027</option>
<option value="2018">2028</option>
<option value="2019">2029</option>
<option value="2020">2030</option>

<option value="2012">2031</option>
<option value="2012">2032</option>
<option value="2013">2033</option>
<option value="2014">2034</option>
<option value="2015">2035</option>
<option value="2016">2036</option>
<option value="2017">2037</option>
<option value="2018">2038</option>
<option value="2019">2039</option>
<option value="2020">2040</option>
</select>
年 
<SELECT name="month2">
<option value="">--</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
</SELECT>
月 
<SELECT name="day2">
<option value="">--</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
日
</td>
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
<div class="category">
<div class="entry_body">

<p>ようこそ！ <?= $LoginId ?> さん</p>
<p><form>
	<input type="button" value="ログアウト" onClick="location.href='../logout.php'">
</form></p>
</div>
</div>

<div class="category">
<h3 class="accordion_head">メニューリスト</h3>
<ul>
<li><a href="#4">カテゴリ001</a></li>
<li><a href="#4">カテゴリ002</a></li>
<li><a href="#4">カテゴリ003</a></li>
</ul>
</div>

<?php if ($admin_flag == true): ?>
<div class="category">
<h3 class="accordion_head">管理者メニュー</h3>
<ul>
<li><a href="admin_user.php">ユーザ管理</a></li>
<li><a href="admin_news.php">新着情報管理</a></li>
<li><a href="admin_mail.php">メール通知管理</a></li>
<li><a href="admin_regi.php">登録受付管理</a></li>
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
