<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>ホームページ テンプレート</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../css/styles-site2.css" type="text/css" />
<link rel="stylesheet" href="../css/css3_button.css" type="text/css" />
</head>

<body>
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
<li class="home"><a href="../index.html">TOP</a></li>
</ul>
</div>
<!--ヘッダーメニューここまで-->

<!--メインここから-->
<div id="main">

<!--<img src="images/648.gif" width="648" height="300" />-->

<!--パンくずリストここから-->
<div class="pan"><a href="../index.html">トップ</a> ＞ ユーザ登録</div>
<!--パンくずリストここまで-->

<div class="category">
<h2 class="heading2">ユーザ登録</h2>
<div class="entry_body">
<h4>ユーザ登録の流れについて</h4>	
<table class="table3">
<tr>
<td width="25%" class="tdtitle2">ステップ1</td>
<td></td>
<td width="25%" class="tdtitle2">ステップ2</div></td>
<td></td>
<td width="25%" class="tdtitle2">ステップ3</div></td>
<td></td>
<td width="25%" class="tdtitle">ステップ4</div></td>
</tr>
<tr>
<td width="25%" class="tdexplain">本ページ上で登録情報を入力して「送信」ボタンを押してください。</td>
<td></td>
<td width="25%" class="tdexplain">入力されたメールアドレスへ「仮登録完了のお知らせ」メールをお送りします。</td>
<td></td>
<td width="25%" class="tdexplain">メールの案内に従って指定のURLにアクセスしてください。</td>
<td></td>
<td width="25%" class="tdexplain">ユーザ登録手続きの完了。</td>
</tr>
</table>

</div>
</div>

<br />

<div class="category">
<div class="entry_body">
<h4>ステップ4：ユーザ登録手続きの完了</h4>	

<?php

include_once 'inc/php/config.php';
include_once 'inc/php/functions.php';

?>

<?php
include 'inc/elements/header.php'; ?>

<?php

//setup some variables
$action = array();
$action['result'] = null;

//check if the $_GET variables are present
	
//quick/simple validation
if(empty($_GET['email']) || empty($_GET['key'])){
	$action['result'] = 'error';
	$action['text'] = 'We are missing variables. Please double check your email.';			
}
		
if($action['result'] != 'error'){

	//cleanup the variables
	$email = mysql_real_escape_string($_GET['email']);
	$key = mysql_real_escape_string($_GET['key']);
	
	//check if the key is in the database
	$check_key = mysql_query("SELECT * FROM `confirm` WHERE `email` = '$email' AND `key` = '$key' LIMIT 1") or die(mysql_error());
	
	if(mysql_num_rows($check_key) != 0){
				
		//get the confirm info
		$confirm_info = mysql_fetch_assoc($check_key);
		
		//confirm the email and update the users database
		$update_users = mysql_query("UPDATE `users` SET `active` = 1 WHERE `id` = '$confirm_info[userid]' LIMIT 1") or die(mysql_error());
		//delete the confirm row
		$delete = mysql_query("DELETE FROM `confirm` WHERE `id` = '$confirm_info[id]' LIMIT 1") or die(mysql_error());
		
		if($update_users){
						
			$action['result'] = 'success';
			$action['text'] = 'ユーザ登録が完了いたしました。ログイン画面へお進みください。';
		
		}else{

			$action['result'] = 'error';
			$action['text'] = 'The user could not be updated Reason: '.mysql_error();;
		
		}
	
	}else{
	
		$action['result'] = 'error';
		$action['text'] = 'すでにユーザ登録は完了しております。ログイン画面へお進みください。';
	
	}

}


?>

<?= 
show_errors($action); ?>

<?php
include 'inc/elements/footer.php'; ?>

<p><center><A Href="../login.php" class="button orange">ログイン</A></center></p><br />

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
<p><center><A Href="../signup.php" class="button orange">ユーザ登録</A></center></p>
</div>
</div>

<div class="category">
<h3 class="accordion_head">ユーザ登録がおすみの方へ</h3>
<div class="entry_body">
<p>すでにユーザー登録がおすみの方はこちらからログインしてください。</p>
<p><center><A Href="../login.php" class="button orange">ログイン</A></center></p>
<p><center><a Href="../fgp.php">パスワードを忘れた方はこちら</a></center></p>
</div>
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
