<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="ja" />
    <meta name="robots" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    
    <link rel="stylesheet" media="screen,projection" type="text/css" href="../css_entry/main.css" />
    <!--[if lte IE 6]><link rel="stylesheet" type="text/css" href="../css_entry/main-msie.css" /><![endif]-->
    <link rel="stylesheet" media="screen,projection" type="text/css" href="../css_entry/scheme.css" />
    <link rel="stylesheet" media="print" type="text/css" href="../css_entry/print.css" />

    <title>Your website name | Homepage</title>
</head>

<body>

<section>
<div id="header_top">
    <!-- Navigation -->
    <div id="nav_top" class="box">

        <ul>
            <li><a href="../login_entry.php">ログイン</a></li>
			<li><span>こんにちわ、ゲストさん</span></li>

        </ul>
    
    </div> <!-- /nav -->
</div>
</section>

<div id="main">

    <!-- Header -->
    <div id="header" class="box">

        <!-- Your logo -->
        <h1 id="logo"><a href="#" title="[Go to homepage]">Your website name</a></h1>
        
        <!-- Your slogan -->
        <p id="slogan">Place for your slogan</p>
        
    </div> <!-- /header -->

    <!-- Navigation -->
    <div id="nav" class="box">

        <ul>
            <li id="nav-active"><a href="../index_entry.html">Homepage</a></li> <!-- Active page (highlighted) -->
            <li><a href="#">About me</a></li>
            <li><a href="#">Photos</a></li>
            <li><a href="#">Portfolio</a></li>
            <li><a href="#">Categories</a></li>
            <li><a href="#">Archive</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    
    </div> <!-- /nav -->

    <!-- Main content -->
    <div id="content">

<div id="main_left">
	
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
UPDATE `entry_users`
SET `password`="{$password}"
WHERE `email`="{$email}"
eof;

$result=mysql_query($sql) or die($sql.mysql_error());

$close_flag = mysql_close($link);

if ($close_flag){
print('<FONT COLOR="#2a7836">パスワードの再登録が完了いたしました。</FONT><hr><br />次回ログインから新しいパスワードがご利用いただけます。<P></P>');
}

?>

</div><!-- END box_login2 -->
</div><!-- END login2 -->
<br /><center><A Href="../login_entry.php" class="button orange">ログイン</A></center><br /><br />
</div><!-- END entry_body -->

</div><!-- END main_left -->

<div id="side">
<div class="category">
<h3><div class="h3kazari">エリアで検索</div></h3>
<ul>
<li><a href="#4">すべて</a></li>
<li><a href="#4">北海道・東北</a></li>
<li><a href="#4">関東</a></li>
<li><a href="#4">信越・北陸</a></li>
<li><a href="#4">東海・近畿</a></li>
<li><a href="#4">中国・四国</a></li>
<li><a href="#4">九州・沖縄</a></li>
</ul>
</div>

<div class="category">
<h3><div class="h3kazari">ジャンルで検索</div></h3>
<ul>
<li><a href="#4">すべて</a></li>
<li><a href="#4">イベント</a></li>
<li><a href="#4">グルメ</a></li>
<li><a href="#4">スポーツ</a></li>
<li><a href="#4">ホビー</a></li>
<li><a href="#4">カルチャー</a></li>
<li><a href="#4">レジャー</a></li>
<li><a href="#4">映画</a></li>
<li><a href="#4">音楽</a></li>
<li><a href="#4">住まい・インテリア</a></li>
<li><a href="#4">美容・健康</a></li>
<li><a href="#4">旅行</a></li>
</ul>
</div>
<!-- END side --></div>

<!-- 北海道	[ 北海道 ]
東北	 [ 青森 | 岩手 | 宮城 | 秋田 | 山形 | 福島 ]
関東	 [ 東京 | 神奈川 | 埼玉 | 千葉 | 茨城 | 栃木 | 群馬 | 山梨 ]
信越・北陸	 [ 新潟 | 長野 | 富山 | 石川 | 福井 ]
東海	 [ 愛知 | 岐阜 | 静岡 | 三重 ]
近畿	 [ 大阪 | 兵庫 | 京都 | 滋賀 | 奈良 | 和歌山 ]
中国	 [ 鳥取 | 島根 | 岡山 | 広島 | 山口 ]
四国	 [ 徳島 | 香川 | 愛媛 | 高知 ]
九州	 [ 福岡 | 佐賀 | 長崎 | 熊本 | 大分 | 宮崎 | 鹿児島 ]
沖縄	 [ 沖縄 ] -->

    </div> <!-- /content -->
		
    <!-- Footer -->
<section>
<div id="footer_bottom">

    <!-- Navigation -->
    <div id="nav_bottom" class="box">

        <ul>
			<li><span>&copy;&nbsp;2012 Your website name</span></li>
        </ul>

    </div> <!-- /nav -->

</div>
</section><!-- /footer -->

</div> <!-- /main -->

</body>
</html>
