<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>ホームページ テンプレート</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../css/styles-site_signup.css" type="text/css" />
</head>

<body>
<div id="container"><!--"container"を削除するとデザインが崩れます-->

<!--ヘッダーここから-->
<h1>ホームページ テンプレート #001_blue 見出しタグ&lt;h1&gt;を使用</h1>
<div id="header"><img src="../images/rogo.png" width="257" height="100" /></div>
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
<div class="pan"><a href="#01">トップ</a> ＞ <a href="#01">カテゴリ</a> ＞ パンくずリストは&lt;div class=&quot;pan&quot;&gt;で囲んでください。（段落タグ&lt;p&gt;は使用しないでください。）</div>
<!--パンくずリストここまで-->

<div class="category">
<h2>ユーザ登録</h2>
<div class="entry_body">
<h4>ステップ1：仮登録メールの送信</h4>	

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
			$action['text'] = '<a href="http://xoops.pvsa.mmrs.jp/login.php">ログイン画面へ</a>';
		
		}else{

			$action['result'] = 'error';
			$action['text'] = 'The user could not be updated Reason: '.mysql_error();;
		
		}
	
	}else{
	
		$action['result'] = 'error';
		$action['text'] = 'The key and email is not in our database.';
	
	}

}


?>

<?= 
show_errors($action); ?>

<?php
include 'inc/elements/footer.php'; ?>

</div>
</div>

<!--更新情報ここから-->
<!--更新情報ここまで-->


</div>
<!--メインここまで-->

<!--[if !IE]>サイドメニューここから<![endif]-->
<div id="sub">
<div class="category">
<h3><div class="h3kazari">初めての方へ</div></h3>
<div class="entry_body">
<p>サイドメニューの見出しは&lt;h3&gt;タグと&lt;div class=&quot;h3kazari&quot;&gt;で囲むと表示されます。</p>
<p><img src="images/200.gif" width="200" height="90" /></p>
<p>通常のテキストは&lt;div class=&quot;entry_body&quot;&gt;の中に収まるようにしてください。</p>
<blockquote>引用タグ&lt;blockquote&gt;を使用するとこんな感じの囲みになります。</blockquote>
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
