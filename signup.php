<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ テンプレート</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="css/styles-site2.css" type="text/css" />
<link rel="stylesheet" href="css/css3_button.css" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="/login/member/form/jquery.zip2addr.js"></script>
<script src="http://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3.js" charset="UTF-8"></script>

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
<div class="pan"><a href="index.html">トップ</a> ＞ ユーザ登録</div>
<!--パンくずリストここまで-->

<div class="category">
<h2 class="heading2">ユーザ登録</h2>
<div class="entry_body">
<h4>ユーザ登録の流れについて</h4>	
<table class="table3">
<tr>
<td width="25%" class="tdtitle">ステップ1</td>
<td></td>
<td width="25%" class="tdtitle2">ステップ2</div></td>
<td></td>
<td width="25%" class="tdtitle2">ステップ3</div></td>
<td></td>
<td width="25%" class="tdtitle2">ステップ4</div></td>
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
<h4>ステップ1：仮登録メールの送信</h4>	
			<p>下記項目のご入力をお願いいたします。<br />
入力が終わりましたら「送信」ボタンを押してください。<br />
			<span class="red">*</span>は入力必須項目です。</p>

<?php

include_once 'signup/inc/php/config.php';
include_once 'signup/inc/php/functions.php';

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
	$name1 = mysql_real_escape_string($_POST['name1']);
	$name2 = mysql_real_escape_string($_POST['name2']);
	$kana1 = mysql_real_escape_string($_POST['kana1']);
	$kana2 = mysql_real_escape_string($_POST['kana2']);
	$postal = mysql_real_escape_string($_POST['postal']);
	$pref = mysql_real_escape_string($_POST['pref']);
	$address1 = mysql_real_escape_string($_POST['address1']);
	$tel = mysql_real_escape_string($_POST['tel']);
	
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
				
		$password = md5($password);	
			
		//add to the database
		$add = mysql_query("INSERT INTO `users` VALUES(NULL,'$username','$password','$email',0,'$name1','$name2','$kana1','$kana2','$postal','$pref','$address1','$tel')");
		
		if($add){
			
			//get the new user id
			$userid = mysql_insert_id();
			
			//create a random key
			$key = $username . $email . date('YmdHis');
			$key = md5($key);
			
			//add confirm row
			$confirm = mysql_query("INSERT INTO `confirm` VALUES(NULL,'$userid','$key','$email')");	
			
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
					$signup_count = 1;
					//email sent
					$action['result'] = 'success';
					array_push($text,'「仮登録完了のお知らせ」メールをお送りしました。<br /><br />1時間経ってもメールが確認できない場合は、迷惑メールとして処理されていたり、誤ったメールアドレスを登録されている場合もあります。迷惑メールフォルダや登録メールアドレスを確認のうえ、お問い合わせ窓口までご連絡ください。');
				
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

<?= show_errors($action); ?>

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
	<th><label for="username">ユーザID<span class="red">*</span>（半角英数）</label></th>
	<td><input type="text" size="40" value="<?= $_POST['username'] ?>" name="username" />（5文字以上）</td>
</tr>
<tr>
	<th><label for="password">パスワード<span class="red">*</span>（半角英数）</label></th>
	<td><input type="password" size="40" value="<?= $_POST['password'] ?>" name="password" />（5文字以上）</td>
</tr>
<tr>
	<th><label for="email">メールアドレス<span class="red">*</span></label></th>
	<td><input type="text" size="40" value="<?= $_POST['email'] ?>" name="email" /></td>
</tr><tr>
	<th><label for="email2">メールアドレス（確認用）<span class="red">*</span></label></th>
	<td><input type="text" size="40" value="<?= $_POST['email2'] ?>" name="email2" /></td>
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
				<div><input type="submit" value="送信" name="signup" /></div>
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
