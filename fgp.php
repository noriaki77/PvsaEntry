<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ テンプレート</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="css/styles-site2.css" type="text/css" />
<link rel="stylesheet" href="css/css3_button.css" type="text/css" />
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
<li class="home"><a href="index.html">TOP</a></li>
</ul>
</div>
<!--ヘッダーメニューここまで-->

<!--メインここから-->
<div id="main">

<!--<img src="images/648.gif" width="648" height="300" />-->

<!--パンくずリストここから-->
<div class="pan"><a href="index.html">トップ</a> ＞ パスワードの再登録</div>
<!--パンくずリストここまで-->

<div class="category">
<h2 class="heading2">パスワードの再登録</h2>
<div class="entry_body">
<h4>パスワード再登録の流れについて</h4>	
<table class="table3">
<tr>
<td width="25%" class="tdtitle">ステップ1</td>
<td></td>
<td width="25%" class="tdtitle2">ステップ2</td>
<td></td>
<td width="25%" class="tdtitle2">ステップ3</td>
<td></td>
<td width="25%" class="tdtitle2">ステップ4</td>
</tr>
<tr>
<td width="25%" class="tdexplain">ユーザID、メールアドレスを入力して「送信」ボタンを押してください。</td>
<td></td>
<td width="25%" class="tdexplain">入力されたメールアドレスへ「パスワード再登録のお知らせ」メールをお送りします。</td>
<td></td>
<td width="25%" class="tdexplain">メールの案内に従ってパスワード再登録ページにアクセスしてください。</td>
<td></td>
<td width="25%" class="tdexplain">新しいパスワードを入力して再登録します。</td>
</tr>
</table>

</div>
</div>

<br />

<div class="category">
<div class="entry_body">
<h4>ステップ1：「パスワード再登録のお知らせ」メールの送信</h4>	

<?php

include_once 'fgp/inc/php/config.php';
include_once 'fgp/inc/php/functions.php';

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
	
	$query = mysql_query("SELECT * FROM users WHERE username ='$username' AND email ='$email'");
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
		$add = mysql_query("INSERT INTO `users_fgp` VALUES(NULL,'$username','$password','$email',0)");
		
		if($add){
			
			//get the new user id
			$userid = mysql_insert_id();
			
			//create a random key
			$key = $username . $email . $password  . date('YmdHis');
			$key = md5($key);
			
			//add confirm row
			$confirm = mysql_query("INSERT INTO `confirm_fgp` VALUES(NULL,'$userid','$key','$email')");	
			
			if($confirm){
			
				//include the swift class
				include_once 'signup/inc/php/swift/swift_required.php';
			
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
<p><center><A Href="signup.php" class="button orange">ユーザ登録</A></center></p>
</div>
</div>

<div class="category">
<h3 class="accordion_head">ユーザ登録がおすみの方へ</h3>
<div class="entry_body">
<p>すでにユーザー登録がおすみの方はこちらからログインしてください。</p>
<p><center><A Href="login.php" class="button orange">ログイン</A></center></p>
<p><center><a Href="fgp.php">パスワードを忘れた方はこちら</a></center></p>
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
