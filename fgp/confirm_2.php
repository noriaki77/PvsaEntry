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
<div id="header"><img src="../images/rogo.png" width="257" height="100" /></div>
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
<div class="pan"><a href="../index.html">トップ</a> ＞ パスワードの再登録</div>
<!--パンくずリストここまで-->

<div class="category">
<h2 class="heading2">パスワードの再登録</h2>
<div class="entry_body">
<h4>パスワード再登録の流れについて</h4>	
<table class="table3">
<tr>
<td width="25%" class="tdtitle2">ステップ1</td>
<td></td>
<td width="25%" class="tdtitle2">ステップ2</td>
<td></td>
<td width="25%" class="tdtitle2">ステップ3</td>
<td></td>
<td width="25%" class="tdtitle">ステップ4</td>
</tr>
<tr>
<td width="25%" class="tdexplain">ユーザID、メールアドレスを入力して「送信」ボタンを押してください。</td>
<td></td>
<td width="25%" class="tdexplain">入力されたメールアドレスへ「パスワード再登録のお知らせ」メールをお送りします。</td>
<td></td>
<td width="25%" class="tdexplain">メールの案内に従ってパスワード再登録ページのURLにアクセスしてください。</td>
<td></td>
<td width="25%" class="tdexplain">新しいパスワードを入力して再登録します。</td>
</tr>
</table>

</div>
</div>

<br />

<div class="category">
<div class="entry_body">
<h4>ステップ4：パスワードの再登録</h4>	
<div id="login2">
    <div class="box_login2">
<?php

$email = $_POST['email'];
$password = $_POST['password'];
$password = md5($password);	

$link = mysql_connect('db1.mmrs.jp', 'pv1_adm', 'cc1256cc');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}

//print('<p>接続に成功しました。</p>');

$db_selected = mysql_select_db('pv1_adm_mrs', $link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}

$sql=<<<eof
UPDATE `users`
SET `password`="{$password}"
WHERE `email`="{$email}"
eof;

$result=mysql_query($sql) or die($sql.mysql_error());

$close_flag = mysql_close($link);

if ($close_flag){
print('<FONT COLOR="#2a7836">パスワードの再登録が完了いたしました。</FONT><hr><br />次回ログインから新しいパスワードがご利用いただけます。<P></P>');
}

?>

</div>
</div>
<br /><center><A Href="../login.php" class="button orange">ログイン</A></center><br /><br />
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
