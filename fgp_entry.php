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
	
<div class="entry_body">
<h4>ステップ1：「パスワード再登録のお知らせ」メールの送信</h4>	

<?php

include_once 'fgp_entry/inc/php/config.php';
include_once 'fgp_entry/inc/php/functions.php';

//setup some variables/arrays
$action = array();
$action['result'] = null;
$text = array();
$fgp_count = 0;

//check if the form has been submitted
if(isset($_POST['signup'])){

	//cleanup the variables
	//prevent mysql injection
	$username = mysql_real_escape_string($_POST['username']);
	$RandomString = 'x6htmf4wb4y526iw' ;
 	$password = mysql_real_escape_string($RandomString);
	$email = mysql_real_escape_string($_POST['email']);
	
	$query = mysql_query("SELECT * FROM entry_users WHERE username ='$username' AND email ='$email'");
	$rows_query = mysql_num_rows($query);
	
	//quick/simple validation
	if(empty($username)){ $action['result'] = 'error'; array_push($text,'ユーザIDを入力して下さい。'); }
	
	if(empty($email)){ $action['result'] = 'error'; array_push($text,'メールアドレスを入力して下さい。'); }
	elseif(!preg_match('/^([\w])+([\w\._-])*\@([\w])+([\w\._-])*\.([a-zA-Z])+$/', $email)){
	$action['result'] = 'error'; array_push($text,'メールアドレスを正しく入力して下さい。');
	}
	if(empty($email)){ }
	elseif($rows_query){
	}else{
	$action['result'] = 'error'; array_push($text,'入力したメールアドレスは登録されていません。または、IDとの組み合わせが違います。');
	}



	if($action['result'] != 'error'){
				
		$password = md5($password);	
			
		//add to the database
		$add = mysql_query("INSERT INTO `entry_users_fgp` VALUES(NULL,'$username','$password','$email',0)");
		
		if($add){
			
			//get the new user id
			$userid = mysql_insert_id();
			
			//create a random key
			$key = $username . $email . $password  . date('YmdHis');
			$key = md5($key);
			
			//add confirm row
			$confirm = mysql_query("INSERT INTO `entry_confirm_fgp` VALUES(NULL,'$userid','$key','$email')");	
			
			if($confirm){
			
				//include the swift class
				include_once 'signup_entry/inc/php/swift/swift_required.php';
			
				//put info into an array to send to the function
				$info = array(
					'username' => $username,
					'email' => $email,
					'key' => $key);
			
				//send the email
				if(send_email($info)){
					$fgp_count = 1;
					//email sent
					$action['result'] = 'success';
					array_push($text,'「パスワード再登録のお知らせ」メールをお送りしました。<br /><br />1時間経ってもメールが確認できない場合は、迷惑メールとして処理されていたり、誤ったメールアドレスを登録されている場合もあります。迷惑メールフォルダや登録メールアドレスを確認のうえ、お問い合わせ窓口までご連絡ください。');
				
				}else{
					
					$action['result'] = 'error';
					array_push($text,'Could not send confirm email');
				
				}
			
			}else{
				
				$action['result'] = 'error';
				array_push($text,'Confirm row was not added to the database. Reason: ' . mysql_error());
				
			}
			
		}else{
		
			$action['result'] = 'error';
			array_push($text,'User could not be added to the database. Reason: ' . mysql_error());
		
		}
	
	}
	
	$action['text'] = $text;

}

?>

<div id="login1">
    <div class="box_login">
ユーザID、メールアドレスを入力して「送信」ボタンを押してください。
				<hr>
<p></p>
<?= show_errors($action); ?>

<?php if ($fgp_count == 0): ?>

<form method="post" action="">
            <label><span>ユーザID</span><input type="text" size="40" value="<?= $_POST['username'] ?>" name="username" />（半角英数5文字以上）</label>
            <label><span>メールアドレス</span><input type="text" size="40" value="<?= $_POST['email'] ?>" name="email" /></label>
			<div class="spacer"><input type="submit" value="送信" name="signup" /></div>
</form>

<?php endif; ?>
    </div>
</div>

</div>
	
<!-- END main --></div>

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

