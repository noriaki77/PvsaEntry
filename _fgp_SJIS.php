<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>�z�[���y�[�W �e���v���[�g</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="css/styles-site.css" type="text/css" />
<link rel="stylesheet" href="css/css3_button.css" type="text/css" />
</head>

<body>
<div id="container"><!--"container"���폜����ƃf�U�C��������܂�-->

<!--�w�b�_�[��������-->
<h1>�z�[���y�[�W �e���v���[�g #001_blue ���o���^�O&lt;h1&gt;���g�p</h1>
<div id="header"><img src="images/rogo.png" width="257" height="100" /></div>
<!--�w�b�_�[�����܂�-->

<!--�w�b�_�[���j���[��������-->
<div id="menu">
<ul>
<li class="home"><a href="index.html">TOP</a></li>
</ul>
</div>
<!--�w�b�_�[���j���[�����܂�-->

<!--���C����������-->
<div id="main">

<!--<img src="images/648.gif" width="648" height="300" />-->

<!--�p���������X�g��������-->
<div class="pan"><a href="index.html">�g�b�v</a> �� �p�X���[�h�̍ēo�^</div>
<!--�p���������X�g�����܂�-->

<div class="category">
<h2 class="heading2">�p�X���[�h�̍ēo�^</h2>
<div class="entry_body">
<h4>�p�X���[�h�ēo�^�̗���ɂ���</h4>	
<table class="table3">
<tr>
<td width="25%" class="tdtitle">�X�e�b�v1</td>
<td></td>
<td width="25%" class="tdtitle2">�X�e�b�v2</td>
<td></td>
<td width="25%" class="tdtitle2">�X�e�b�v3</td>
<td></td>
<td width="25%" class="tdtitle2">�X�e�b�v4</td>
</tr>
<tr>
<td width="25%" class="tdexplain">���[�UID�A���[���A�h���X����͂��āu���M�v�{�^���������Ă��������B</td>
<td></td>
<td width="25%" class="tdexplain">���͂��ꂽ���[���A�h���X�ցu�p�X���[�h�ēo�^�̂��m�点�v���[���������肵�܂��B</td>
<td></td>
<td width="25%" class="tdexplain">���[���̈ē��ɏ]���ăp�X���[�h�ēo�^�y�[�W�ɃA�N�Z�X���Ă��������B</td>
<td></td>
<td width="25%" class="tdexplain">�V�����p�X���[�h����͂��čēo�^���܂��B</td>
</tr>
</table>

</div>
</div>

<br />

<div class="category">
<div class="entry_body">
<h4>�X�e�b�v1�F�u�p�X���[�h�ēo�^�̂��m�点�v���[���̑��M</h4>	

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
	if(empty($username)){ $action['result'] = 'error'; array_push($text,'���[�UID����͂��ĉ������B'); }
	
	if(empty($email)){ $action['result'] = 'error'; array_push($text,'���[���A�h���X����͂��ĉ������B'); }
	elseif(!preg_match('/^([\w])+([\w\._-])*\@([\w])+([\w\._-])*\.([a-zA-Z])+$/', $email)){
	$action['result'] = 'error'; array_push($text,'���[���A�h���X�𐳂������͂��ĉ������B');
	}
	if(empty($email)){ }
	elseif($rows_query){
	}else{
	$action['result'] = 'error'; array_push($text,'���͂������[���A�h���X�͓o�^����Ă��܂���B�܂��́AID�Ƃ̑g�ݍ��킹���Ⴂ�܂��B');
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
					array_push($text,'�u�p�X���[�h�ēo�^�̂��m�点�v���[���������肵�܂����B<br /><br />1���Ԍo���Ă����[�����m�F�ł��Ȃ��ꍇ�́A���f���[���Ƃ��ď�������Ă�����A��������[���A�h���X��o�^����Ă���ꍇ������܂��B���f���[���t�H���_��o�^���[���A�h���X���m�F�̂����A���₢���킹�����܂ł��A�����������B');
				
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
���[�UID�A���[���A�h���X����͂��āu���M�v�{�^���������Ă��������B
				<hr>
<p></p>
<?= show_errors($action); ?>

<?php if ($fgp_count == 0): ?>

<form method="post" action="">
            <label><span>���[�UID</span><input type="text" size="40" value="<?= $_POST['username'] ?>" name="username" /></label>
            <label><span>���[���A�h���X</span><input type="text" size="40" value="<?= $_POST['email'] ?>" name="email" /></label>
			<div class="spacer"><input type="submit" value="���M" name="signup" /></div>
</form>

<?php endif; ?>
    </div>
</div>

</div>
</div>

<!--�X�V��񂱂�����-->
<!--�X�V��񂱂��܂�-->


</div>
<!--���C�������܂�-->

<!--[if !IE]>�T�C�h���j���[��������<![endif]-->
<div id="sub">
<div class="category">
<h3 class="accordion_head">���߂ė��p��������</h3>
<div class="entry_body">
<p>�͂��߂ė��p�������̓��[�U�o�^�����肢�������܂��B ���́u���[�U�o�^�v�{�^������o�^���J�n�ł��܂��B</p>
<p><center><A Href="signup.php" class="button orange">���[�U�o�^</A></center></p>
</div>
</div>

<div class="category">
<h3 class="accordion_head">���[�U�o�^�������݂̕���</h3>
<div class="entry_body">
<p>���łɃ��[�U�[�o�^�������݂̕��͂����炩�烍�O�C�����Ă��������B</p>
<p><center><A Href="login.php" class="button orange">���O�C��</A></center></p>
<p><center><a Href="fgp.php">�p�X���[�h��Y�ꂽ���͂�����</a></center></p>
</div>
</div>

</div>
<!--[if !IE]>�T�C�h���j���[�����܂�<![endif]-->

<div style="clear:both;"></div><!--�f�U�C���������̂ō폜���Ȃ���-->

<!--�t�b�^�[��������-->
<div id="footer">
<p>Copyright(C) �z�[���y�[�W�� All Rights Reserved.</p>
</div>
<!--�t�b�^�[�����܂�-->

</div><!--"container"-->

</body>
</html>
