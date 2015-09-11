<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>ホームページ</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../css/styles-site.css" type="text/css" />
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
<div class="pan"><a href="index.php">トップ</a></div>
<!--パンくずリストここまで-->

<div class="category">
<h2>タイトル</h2>
<div class="entry_body">
</div>
</div>
<?php echo realpath(dirname(__FILE__)); ?>
<!--form-->
 <?php include_once(dirname(__FILE__).'/form/'); ?>
<!--form-->


</div>
<!--メインここまで-->

<!--[if !IE]>サイドメニューここから<![endif]-->
<div id="sub">
<div class="category">
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
<h3><div class="h3kazari">メニューリスト</div></h3>
<ul>
<li><a href="form.php">登録フォーム</a></li>
<li><a href="#4">カテゴリ002</a></li>
<li><a href="#4">カテゴリ003</a></li>
</ul>
</div>

<?php if ($LoginId == 'admin' or $LoginId == 'admin2'): ?>
<div class="category">
<h3><div class="h3kazari">管理者メニュー</div></h3>
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
