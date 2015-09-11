<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../css/styles-site2.css" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="../../login/member/form/jquery.zip2addr.js"></script>
<script src="http://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3.js" charset="UTF-8"></script>
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
<div class="pan"><a href="index.php">トップ</a> ＞ 登録情報の変更</div>
<!--パンくずリストここまで-->

<div class="category">
<h2 class="heading2">登録情報の変更</h2>
<div class="entry_body">

<p>最初は、すでに登録されている情報が表示されますので、該当の項目を上書し、「変更する」ボタンをクリックしてください。</p>

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
	$username = mysql_real_escape_string($_POST['username']);
	$email = mysql_real_escape_string($_POST['email']);
	$name1 = mysql_real_escape_string($_POST['name1']);
	$name2 = mysql_real_escape_string($_POST['name2']);
	$kana1 = mysql_real_escape_string($_POST['kana1']);
	$kana2 = mysql_real_escape_string($_POST['kana2']);
	$postal = mysql_real_escape_string($_POST['postal']);
	$pref = mysql_real_escape_string($_POST['pref']);
	$address1 = mysql_real_escape_string($_POST['address1']);
	$tel = mysql_real_escape_string($_POST['tel']);
	
	//quick/simple validation
	mb_internal_encoding('UTF-8');
	mb_regex_encoding('UTF-8');
	if(!preg_match('/^[ァ-ヶー]+$/u', $kana1) && $kana1 != "" ) {
	$action['result'] = 'error'; array_push($text,'フリガナ（姓）は全角カナで入力して下さい。');
	}
	if(!preg_match('/^[ァ-ヶー]+$/u', $kana2) && $kana2 != "" ) {
	$action['result'] = 'error'; array_push($text,'フリガナ（名）は全角カナで入力して下さい。');
	}
	
	if(!preg_match("/^\d{7}$/", $postal) && $postal != "" ){
	$action['result'] = 'error'; array_push($text,'郵便番号は半角数字7桁(ハイフンなし)で入力して下さい。');
	}
	
	if(!preg_match("/^[0-9]+$/", $tel) && $tel != "" ){ 
	$action['result'] = 'error'; array_push($text,'電話番号は半角数字で入力して下さい。');
	}
	
	if($action['result'] != 'error'){
			
		//add to the database
		$regiup = mysql_query("UPDATE users SET name1='$name1',name2='$name2',kana1='$kana1',kana2='$kana2',postal='$postal',pref='$pref',address1='$address1',tel='$tel' WHERE username='$username'");
		
		if($regiup)
		{
		$signup_count = 1;
		$action['result'] = 'success';
		array_push($text,'登録情報の変更が完了しました。');
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
$sql = "SELECT username,email,name1,name2,kana1,kana2,postal,pref,address1,tel FROM users ";
$sql.= "WHERE username = '" . $LoginId . "'";
$result = mysql_query($sql);
$row = mysql_fetch_array($result, MYSQL_NUM);

$_POST['username'] = $row[0];
$_POST['email'] = $row[1];
$_POST['name1'] = $row[2];
$_POST['name2'] = $row[3];
$_POST['kana1'] = $row[4];
$_POST['kana2'] = $row[5];
$_POST['postal'] = $row[6];
$_POST['pref'] = $row[7];
$_POST['address1'] = $row[8];
$_POST['tel'] = $row[9];
}
?>

<?php if ($signup_count == 0): ?>

<!--form-->
<div id="content">
	<div class="container">

		<!-- mailform -->
		<div class="section">
			<form method="post" action="">
				<div class="section">
					<center>
					<table class="table5">
<tr>
	<th><label for="username">ユーザID</label></th>
	<td><input type="text" size="40" value="<?= $_POST['username'] ?>" name="username" onFocus="this.blur()" style="background:#EDEDED" /></td>
</tr>
<tr>
	<th><label for="email">メールアドレス</label></th>
	<td><input type="text" size="40" value="<?= $_POST['email'] ?>" name="email" onFocus="this.blur()" style="background:#EDEDED" /></td>
</tr>
<tr>
	<th>お名前（漢字）</th>
	<td>姓<input type="text" size="12" name="name1" value="<?= $_POST['name1'] ?>" />
		名<input type="text" size="12" name="name2" value="<?= $_POST['name2'] ?>" />（例：山田　太郎）
	</td>
</tr>
<tr>
	<th>フリガナ（全角カナ）</th>
	<td>姓<input type="text" size="12" name="kana1" value="<?= $_POST['kana1'] ?>" />
		名<input type="text" size="12" name="kana2" value="<?= $_POST['kana2'] ?>" />（例：ヤマダ　タロウ）
	</td>
</tr>
<tr>
	<th>郵便番号（半角数字）</th>
	<td><input type="text" name="postal" size="10" maxlength="8" value="<?= $_POST['postal'] ?>" />（例：1001111）
	<input type="button" onclick="AjaxZip3.zip2addr(postal,'','pref','address1');" value="住所を検索" title="ボタンを押すと、郵便番号から住所を検索して表示します。" />
	<br />
	<div class="t1"><span class="red">※郵便番号を半角数字7桁でご入力ください。<br />
	「住所を検索」ボタンを押すと、郵便番号から住所を検索して表示します。</span></div>
	</td>
</tr>
<tr>
	<th>都道府県</th>
	<td><input type="text" name="pref" size="20" value="<?= $_POST['pref'] ?>" />
	</td>
</tr>
<tr>
	<th>以降の住所</th>
	<td><input type="text" name="address1" size="55" value="<?= $_POST['address1'] ?>" />
	<div class="t1"><span class="red">※番地・マンション名など入力してください。</span></div>
	</td>
</tr>
<tr>
	<th>電話番号（半角数字）</th>
	<td><input type="text" name="tel" value="<?= $_POST['tel'] ?>" />（例:0355551234）
	</td>
</tr>
</table>
</center>
				</div>
<script>
$('#zip').zip2addr('#addr')
</script>
				<center>
				<div><input value="トップへもどる" onclick="location.href='index.php'" type="button">&nbsp;<input type="submit" value="変更する" name="signup" /></div>
				</center>
			</form>
			<br />
		</div>
		<!-- /mailform -->
	</div>
</div>
<!--form-->

<?php endif; ?>

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
