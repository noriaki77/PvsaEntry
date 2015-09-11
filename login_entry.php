<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="ja" />
    <meta name="robots" content="" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    
    <link rel="stylesheet" media="screen,projection" type="text/css" href="css_entry/main.css" />
    <!--[if lte IE 6]><link rel="stylesheet" type="text/css" href="css_entry/main-msie.css" /><![endif]-->
    <link rel="stylesheet" media="screen,projection" type="text/css" href="css_entry/scheme.css" />
    <link rel="stylesheet" media="print" type="text/css" href="css_entry/print.css" />
	<link rel="stylesheet" href="css_entry/search.css" type="text/css" />
	
	<script type="text/javascript" src="js/smartRollover.js"></script>

    <title>Your website name | Homepage</title>


</head>

<body>

<div id="main">
	
<div id="header_top">
    <div id="nav_top" class="box">
        <ul>
            <li><a href="login_entry.php">ログイン</a></li>
			<li><span>こんにちわ、ゲストさん</span></li>
        </ul>
    </div><!-- END nav_top -->
</div><!-- END header_top -->

    <!-- Header -->
    <div id="header" class="box">

        <!-- Your logo -->
        <h1 id="logo"><a href="#" title="[Go to homepage]">Your website name</a></h1>
        
        <!-- Your slogan -->
        <p id="slogan">Place for your slogan</p>
        
    </div> <!-- /header -->

    <div id="nav" class="box">
        <ul>
            <li id="nav-active"><a href="index_entry.html"><img src="images/menu1.png"></a></li> <!-- Active page (highlighted) -->
            <li><a href="#"><img src="images/menu2.png"></a></li>
            <li><a href="#"><img src="images/menu3.png"></a></li>
            <li><a href="#"><img src="images/menu4.png"></a></li>
            <li><a href="#"><img src="images/menu5.png"></a></li>
        </ul>
    </div><!-- END nav -->

<div id="content">

<div id="main_left">
	
<?php
	session_start();

	#データベース取得
	require("login_entry/db.php");

	#ログイン処理
	if( $_REQUEST["spls"] == "do_login" )
	{
		$sql = "SELECT * FROM entry_users ";
		$sql.= "WHERE username = '" . $_REQUEST["login_id"] . "'";
		$pass = md5($_REQUEST["login_pass"]);
		$sql.= "AND password='" . $pass . "'";
		$sql.= "AND active=1";
		$result = executeQuery($sql);
		$is_login = 0;

		if( $row = mysql_fetch_array( $result ) ) 
		{
			$_SESSION["login_id"] = $_REQUEST["login_id"];
			$_SESSION["name"] = $row["name"];
			$is_login = 1;

			#ログイン後のページ（メンバーのみに公開されるページ）
			$login_url = "http://{$_SERVER["HTTP_HOST"]}/login_entry/entry/";
			header("Location: {$login_url}");
			exit;
		}
		mysql_free_result($result);
	}
//以下HTML
?>
	
<?php
	if( $_SESSION["login_id"] == "" ){
?>
	<!-- ユーザー登録画面へ -->
	<!-- ログインフォーム -->
	<form name="login_form" action="login_entry.php" method="POST">
	<input type="hidden" name="spls" value="do_login"/>
<?php
		// ログインに失敗した時のエラー表示。
		if( $is_login == 0 and $_REQUEST["spls"] == "do_login" )
		{
		$sql_1 = "SELECT * FROM entry_users ";
		$sql_1.= "WHERE username = '" . $_REQUEST["login_id"] . "'";
		//$pass_1 = md5($_REQUEST["login_pass"]);
		//$sql_1.= "AND password='" . $pass_1 . "'";
		$sql_1.= "AND active=0";
		$result_1 = executeQuery($sql_1);
		if( $row_1 = mysql_fetch_array( $result_1 ) ) 
		{
			 $error_message = "現在は仮登録の状態です。「仮登録完了のお知らせ」メールをご確認いただき、本登録を完了させてからログインしてください。";
		}
		else{
			 $error_message = "ユーザーID、またはパスワードを正しく入力してください。";
		}
		}
?>

<div id="login1">
	<h3><div class="h3kazari"><img src="images/title_login.png"></div></h3>
	<p>会員IDをお持ちの方は、こちらからログインしてください。</p>

<div class="err">
<?php
if ($error_message) {
print $error_message;
}
?>
</div><!-- END err -->
	
    <div class="box_login">
        <div class="spacer">
        <form action="" method="post">
			<span>会員ID</span>
            <label><input type="text" size="30" name="login_id" value="<?= $_REQUEST["login_id"] ?>" class="input" /></label>
			<p>（半角英数5文字以上）</p>
			<span>パスワード</span>
            <label><input type="password" size="30" name="login_pass" class="input" /></label>
			<p>（半角英数5文字以上）</p>
        
			<div id="btn_box"><input class="loginbtn" type="submit" name="loginbtn" value="ログイン" id="btn_submit"/></div>
			<br>
			<p>パスワードを忘れた方はこちら：<a href="fgp_entry.php">新しいパスワードを再登録する</a></p>
        </div><!-- END spacer -->
	</div><!-- END box_login -->
</div><!-- END login1 -->
		
		</form>


<?php
}else{
?>
<!-- ログインしたままトップページに戻った場合 -->
<p>一度ログアウトして下さい。</p>
<center>
<p><A Href="./login_entry/logout.php" class="button white">ログアウト</A></p>

<?php
}
?>

<div id="login2">
	<h3><div class="h3kazari"><img src="images/title_new_member.png"></div></h3>
	<p>下記ボタンより、会員情報の新規登録をお願いいたします。</p>

	<div class="spacer">
		<p><a href="signup_entry.php"><img src="images/new_member_off.png"></a></p>
	</div>
</div>	

</div><!-- END main_left -->

<div id="side">
<div class="category">
<!-- Google -->
<div id="cse-search-form" style="width: 100%;">Loading</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
  google.load('search', '1', {language : 'ja'});
  google.setOnLoadCallback(function() {
    var customSearchOptions = {};  var customSearchControl = new google.search.CustomSearchControl(
      '017090131003369021131:qfd23v8b5lm', customSearchOptions);
    customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
    var options = new google.search.DrawOptions();
    options.enableSearchboxOnly("http://www.google.com/cse?cx=017090131003369021131:qfd23v8b5lm");
    customSearchControl.draw('cse-search-form', options);
  }, true);
</script>

<!-- Google -->
</div>
	
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
</div><!-- END side -->

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
		
<div id="footer_bottom">
    <div id="nav_bottom" class="box">
        <ul>
			<li><span>&copy;&nbsp;2012 Your website name</span></li>
        </ul>
    </div><!-- END nav_bottom -->
</div><!-- END footer_bottom -->

</div> <!-- /main -->

</body>
</html>
