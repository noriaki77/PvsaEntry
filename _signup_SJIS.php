<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>�z�[���y�[�W �e���v���[�g</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="css/styles-site.css" type="text/css" />
<link rel="stylesheet" href="css/css3_button.css" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="/login/member/form/jquery.zip2addr.js"></script>
<script src="http://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3.js" charset="UTF-8"></script>

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
<div class="pan"><a href="index.html">�g�b�v</a> �� ���[�U�o�^</div>
<!--�p���������X�g�����܂�-->

<div class="category">
<h2 class="heading2">���[�U�o�^</h2>
<div class="entry_body">
<h4>���[�U�o�^�̗���ɂ���</h4>	
<table class="table3">
<tr>
<td width="25%" class="tdtitle">�X�e�b�v1</td>
<td></td>
<td width="25%" class="tdtitle2">�X�e�b�v2</div></td>
<td></td>
<td width="25%" class="tdtitle2">�X�e�b�v3</div></td>
<td></td>
<td width="25%" class="tdtitle2">�X�e�b�v4</div></td>
</tr>
<tr>
<td width="25%" class="tdexplain">�{�y�[�W��œo�^������͂��āu���M�v�{�^���������Ă��������B</td>
<td></td>
<td width="25%" class="tdexplain">���͂��ꂽ���[���A�h���X�ցu���o�^�����̂��m�点�v���[���������肵�܂��B</td>
<td></td>
<td width="25%" class="tdexplain">���[���̈ē��ɏ]���Ďw���URL�ɃA�N�Z�X���Ă��������B</td>
<td></td>
<td width="25%" class="tdexplain">���[�U�o�^�葱���̊����B</td>
</tr>
</table>

</div>
</div>

<br />

<div class="category">
<div class="entry_body">
<h4>�X�e�b�v1�F���o�^���[���̑��M</h4>	
			<p>���L���ڂ̂����͂����肢�������܂��B<br />
���͂��I���܂�����u���M�v�{�^���������Ă��������B<br />
			<span class="red">*</span>�͓��͕K�{���ڂł��B</p>

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
	$yubin = mysql_real_escape_string($_POST['yubin']);
	$tel = mysql_real_escape_string($_POST['tel']);
	$kana1 = $_POST['kana1'];
	$name4 = mysql_real_escape_string($_POST['name4']);
	
	//quick/simple validation
	if(empty($username)){ $action['result'] = 'error'; array_push($text,'���[�UID����͂��ĉ������B'); }
	elseif(!preg_match("/^[a-zA-Z0-9]+$/", $username)){
	$action['result'] = 'error'; array_push($text,'���[�UID�ɔ��p�p���ȊO���g�p����Ă��܂��B');
	}
	elseif(mb_strlen($username) < 5){
	$action['result'] = 'error'; array_push($text,'���[�UID��5�����ȏ�Őݒ肵�Ă��������B');
	}
	
	$result_id = mysql_query("SELECT * FROM users WHERE username ='$username'");
	$rows_id = mysql_num_rows($result_id);
	if($rows_id){
	$action['result'] = 'error'; array_push($text,'����]�̃��[�UID�͂��łɎg�p����Ă��܂��B');
	}
	
	if(empty($password)){ $action['result'] = 'error'; array_push($text,'�p�X���[�h����͂��ĉ������B'); }
	elseif(!preg_match("/^[a-zA-Z0-9]+$/", $password)){
	$action['result'] = 'error'; array_push($text,'�p�X���[�h�ɔ��p�p���ȊO���g�p����Ă��܂��B');
	}
	elseif(mb_strlen($password) < 5){
	$action['result'] = 'error'; array_push($text,'�p�X���[�h��5�����ȏ�Őݒ肵�Ă��������B');
	}
	if(empty($email)){ $action['result'] = 'error'; array_push($text,'���[���A�h���X����͂��ĉ������B'); }
	elseif(!preg_match('/^([\w])+([\w\._-])*\@([\w])+([\w\._-])*\.([a-zA-Z])+$/', $email)){
	$action['result'] = 'error'; array_push($text,'���[���A�h���X�𐳂������͂��ĉ������B');
	}
	if(empty($email2)){ $action['result'] = 'error'; array_push($text,'���[���A�h���X�i�m�F�p�j����͂��ĉ������B'); }
	elseif(!preg_match('/^([\w])+([\w\._-])*\@([\w])+([\w\._-])*\.([a-zA-Z])+$/', $email2)){
	$action['result'] = 'error'; array_push($text,'���[���A�h���X�i�m�F�p�j�𐳂������͂��ĉ������B');
	}
	if($email <> $email2){ $action['result'] = 'error'; array_push($text,'���[���A�h���X�ƃ��[���A�h���X�i�m�F�p�j����v���Ă��܂���B'); }
	
	$result_mail = mysql_query("SELECT * FROM users WHERE email ='$email'");
	$rows_mail = mysql_num_rows($result_mail);
	if($rows_mail){
	$action['result'] = 'error'; array_push($text,'����]�̃��[���A�h���X�͂��łɎg�p����Ă��܂��B');
	}
	
	mb_internal_encoding('UTF-8');
	mb_regex_encoding('UTF-8');
	$data2='�A�C�E�G�I�J�L�N�P�R�T�V�X�Z�\�^�`�c�e�g�i�j�k�l�m�n�q�t�w�z�}�~�����������������������������K�M�O�Q�S�U�W�Y�[�]�_�a�d�f�h�p�s�v�y�|�o�r�u�x�{�b�@�B�D�F�H���������[';
	if(!preg_match('/^[$data2]+$/u', $kana1)) {
	$action['result'] = 'error'; array_push($text,'�t���K�i�i���j�͑S�p�J�i�œ��͂��ĉ������B');
	}
	if (!mb_ereg_match('/^[�@-���[]+$/', $name4) && $name4 != "" ) {
	$action['result'] = 'error'; array_push($text,'�t���K�i�i���j�͑S�p�J�i�œ��͂��ĉ������B');
	}
	echo $kana1;
	
	if(!preg_match("/^\d{7}$/", $yubin) && $yubin != "" ){
	$action['result'] = 'error'; array_push($text,'�X�֔ԍ��͔��p����(�n�C�t���Ȃ�)�œ��͂��ĉ������B');
	}
	
	if(!preg_match("/^[0-9]+$/", $tel) && $tel != "" ){ 
	$action['result'] = 'error'; array_push($text,'�d�b�ԍ��͔��p�����œ��͂��ĉ������B');
	}
	
	if($action['result'] != 'error'){
				
		$password = md5($password);	
			
		//add to the database
		$add = mysql_query("INSERT INTO `users` VALUES(NULL,'$username','$password','$email',0)");
		
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
					array_push($text,'�u���o�^�����̂��m�点�v���[���������肵�܂����B<br /><br />1���Ԍo���Ă����[�����m�F�ł��Ȃ��ꍇ�́A���f���[���Ƃ��ď�������Ă�����A��������[���A�h���X��o�^����Ă���ꍇ������܂��B���f���[���t�H���_��o�^���[���A�h���X���m�F�̂����A���₢���킹�����܂ł��A�����������B');
				
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
	<th><label for="username">���[�UID<span class="red">*</span>�i���p�p���j</label></th>
	<td><input type="text" size="40" value="<?= $_POST['username'] ?>" name="username" />�i5�����ȏ�j</td>
</tr>
<tr>
	<th><label for="password">�p�X���[�h<span class="red">*</span>�i���p�p���j</label></th>
	<td><input type="password" size="40" value="<?= $_POST['password'] ?>" name="password" />�i5�����ȏ�j</td>
</tr>
<tr>
	<th><label for="email">���[���A�h���X<span class="red">*</span></label></th>
	<td><input type="text" size="40" value="<?= $_POST['email'] ?>" name="email" /></td>
</tr><tr>
	<th><label for="email2">���[���A�h���X�i�m�F�p�j<span class="red">*</span></label></th>
	<td><input type="text" size="40" value="<?= $_POST['email2'] ?>" name="email2" /></td>
</tr>
<tr>
	<th>�����O�i�����j</th>
	<td>��<input type="text" size="12" name="name1" value="<?= $_POST['name1'] ?>" />
		��<input type="text" size="12" name="name2" value="<?= $_POST['name2'] ?>" />�i��F�R�c�@���Y�j
	</td>
</tr>
<tr>
	<th>�t���K�i�i�S�p�J�i�j</th>
	<td>��<input type="text" size="12" name="kana1" value="<?= $_POST['kana1'] ?>" />
		��<input type="text" size="12" name="name4" value="<?= $_POST['name4'] ?>" />�i��F���}�_�@�^���E�j
	</td>
</tr>
<tr>
	<th>�X�֔ԍ��i���p�����j</th>
	<td><input type="text" name="yubin" size="10" maxlength="8" value="<?= $_POST['yubin'] ?>" />�i��F1001111�j
	<input type="button" onclick="AjaxZip3.zip2addr(yubin,'','pref','jusho');" value="�Z��������" title="�{�^���������ƁA�X�֔ԍ�����Z�����������ĕ\�����܂��B" />
	<br />
	<div class="t1"><span class="red">���X�֔ԍ��𔼊p����7���ł����͂��������B<br />
	�u�Z���������v�{�^���������ƁA�X�֔ԍ�����Z�����������ĕ\�����܂��B</span></div>
	</td>
</tr>
<tr>
	<th>�s���{��</th>
	<td><input type="text" name="pref" size="20" value="<?= $_POST['pref'] ?>" />
	</td>
</tr>
<tr>
	<th>�ȍ~�̏Z��</th>
	<td><input type="text" name="jusho" size="55" value="<?= $_POST['jusho'] ?>" />
	<div class="t1"><span class="red">���Ԓn�E�}���V�������ȂǓ��͂��Ă��������B</span></div>
	</td>
</tr>
<tr>
	<th>�d�b�ԍ��i���p�����j</th>
	<td><input type="text" name="tel" value="<?= $_POST['tel'] ?>" />�i��:0355551234�j
	</td>
</tr>
</table>
</center>
				</div>
<script>
$('#zip').zip2addr('#addr')
</script>
				<center>
				<div><input type="submit" value="���M" name="signup" /></div>
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
