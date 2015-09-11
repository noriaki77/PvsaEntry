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

<?php

include_once 'signup_entry/inc/php/config.php';
include_once 'signup_entry/inc/php/functions.php';

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
	$password = mysql_real_escape_string($_POST['password']);
	$email = mysql_real_escape_string($_POST['email']);
	$email2 = mysql_real_escape_string($_POST['email2']);
	
	//quick/simple validation
	if(empty($username)){ $action['result'] = 'error'; array_push($text,'ユーザIDを入力して下さい。'); }
	elseif(!preg_match("/^[a-zA-Z0-9]+$/", $username)){
	$action['result'] = 'error'; array_push($text,'ユーザIDに半角英数以外が使用されています。');
	}
	elseif(mb_strlen($username) < 5){
	$action['result'] = 'error'; array_push($text,'ユーザIDは5文字以上で設定してください。');
	}
	
	$result_id = mysql_query("SELECT * FROM users WHERE username ='$username'");
	$rows_id = mysql_num_rows($result_id);
	if($rows_id){
	$action['result'] = 'error'; array_push($text,'ご希望のユーザIDはすでに使用されています。');
	}
	
	if(empty($password)){ $action['result'] = 'error'; array_push($text,'パスワードを入力して下さい。'); }
	elseif(!preg_match("/^[a-zA-Z0-9]+$/", $password)){
	$action['result'] = 'error'; array_push($text,'パスワードに半角英数以外が使用されています。');
	}
	elseif(mb_strlen($password) < 5){
	$action['result'] = 'error'; array_push($text,'パスワードは5文字以上で設定してください。');
	}
	if(empty($email)){ $action['result'] = 'error'; array_push($text,'メールアドレスを入力して下さい。'); }
	elseif(!preg_match('/^([\w])+([\w\._-])*\@([\w])+([\w\._-])*\.([a-zA-Z])+$/', $email)){
	$action['result'] = 'error'; array_push($text,'メールアドレスを正しく入力して下さい。');
	}
	if(empty($email2)){ $action['result'] = 'error'; array_push($text,'メールアドレス（確認用）を入力して下さい。'); }
	elseif(!preg_match('/^([\w])+([\w\._-])*\@([\w])+([\w\._-])*\.([a-zA-Z])+$/', $email2)){
	$action['result'] = 'error'; array_push($text,'メールアドレス（確認用）を正しく入力して下さい。');
	}
	if($email <> $email2){ $action['result'] = 'error'; array_push($text,'メールアドレスとメールアドレス（確認用）が一致していません。'); }
	
	$result_mail = mysql_query("SELECT * FROM users WHERE email ='$email'");
	$rows_mail = mysql_num_rows($result_mail);
	if($rows_mail){
	$action['result'] = 'error'; array_push($text,'ご希望のメールアドレスはすでに使用されています。');
	}
	
	mb_internal_encoding('UTF-8');
	mb_regex_encoding('UTF-8');
	
	if($action['result'] != 'error'){
				
		$password = md5($password);	
			
		//add to the database
		$add = mysql_query("INSERT INTO `entry_users` VALUES(NULL,'$username','$password','$email',0)");
		
		if($add){
			
			//get the new user id
			$userid = mysql_insert_id();
			
			//create a random key
			$key = $username . $email . date('YmdHis');
			$key = md5($key);
			
			//add confirm row
			$confirm = mysql_query("INSERT INTO `entry_confirm` VALUES(NULL,'$userid','$key','$email')");	
			
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
					$signup_count = 1;
					//email sent
					$action['result'] = 'success';
					array_push($text,'仮登録完了のお知らせメールをお送りしました。<br /><br />1時間経ってもメールが確認できない場合は、迷惑メールとして処理されていたり、誤ったメールアドレスを登録されている場合もあります。迷惑メールフォルダや登録メールアドレスを確認のうえ、お問い合わせ窓口までご連絡ください。');
				
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

<div id="login1" style="margin:0px 0 30px;">
	<h3><div class="h3kazari"><img src="images/title_login.png"></div></h3>


<div class="err">
<?= show_errors($action); ?>
</div><!-- END err -->

<?php if ($signup_count == 0): ?>
<p>下記項目のご入力をお願いいたします。<br />
入力が終わりましたら「送信」ボタンを押してください。<br />
<span class="red">*</span>は入力必須項目です。</p>

    <div class="box_login">
        <div class="spacer">
			<form method="post" action="">
			<span>会員ID</span>
            <label><input type="text" size="40" value="<?= $_POST['username'] ?>" name="username"  class="input" /></label>
			<p>（半角英数5文字以上）</p>
			<span>パスワード</span>
            <label><input type="password" size="40" value="<?= $_POST['password'] ?>" name="password"  class="input" /></label>
			<p>（半角英数5文字以上）</p>
			<span>メールアドレス</span>
            <label><input type="text" size="30" value="<?= $_POST['email'] ?>" name="email" class="input" /></label>
			<p></p>
			<span>メールアドレス（確認用）</span>
            <label><input type="text" size="30" value="<?= $_POST['email2'] ?>" name="email2" class="input" /></label>
			<p></p>
			<div id="btn_box"><input class="loginbtn" type="submit" name="signup" value="登&nbsp;&nbsp;録" id="btn_submit"/></div>
			<br>
			
        </div><!-- END spacer -->
	</div><!-- END box_login -->

		
		</form>

<?php endif; ?>
</div><!-- END login1 -->
</div>
	
<!-- END main -->

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
