<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>�z�[���y�[�W �e���v���[�g</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../css/styles-site2.css" type="text/css" />
<link rel="stylesheet" href="../css/css3_button.css" type="text/css" />
</head>

<body>
<div id="container"><!--"container"���폜����ƃf�U�C��������܂�-->

<!--�w�b�_�[��������-->
<h1>�z�[���y�[�W �e���v���[�g #001_blue ���o���^�O&lt;h1&gt;���g�p</h1>
<div id="header">
<!--img src="images/rogo.png" width="257" height="100" />-->
</div>
<!--�w�b�_�[�����܂�-->

<!--�w�b�_�[���j���[��������-->
<div id="menu">
<ul>
<li class="home"><a href="../index.html">TOP</a></li>
</ul>
</div>
<!--�w�b�_�[���j���[�����܂�-->

<!--���C����������-->
<div id="main">

<!--<img src="images/648.gif" width="648" height="300" />-->

<!--�p���������X�g��������-->
<div class="pan"><a href="../index.html">�g�b�v</a> �� ���[�U�o�^</div>
<!--�p���������X�g�����܂�-->

<div class="category">
<h2 class="heading2">���[�U�o�^</h2>
<div class="entry_body">
<h4>���[�U�o�^�̗���ɂ���</h4>	
<table class="table3">
<tr>
<td width="25%" class="tdtitle2">�X�e�b�v1</td>
<td></td>
<td width="25%" class="tdtitle2">�X�e�b�v2</div></td>
<td></td>
<td width="25%" class="tdtitle2">�X�e�b�v3</div></td>
<td></td>
<td width="25%" class="tdtitle">�X�e�b�v4</div></td>
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
<h4>�X�e�b�v4�F���[�U�o�^�葱���̊���</h4>	

<?php

include_once 'inc/php/config.php';
include_once 'inc/php/functions.php';

?>

<?php
include 'inc/elements/header.php'; ?>

<?php

//setup some variables
$action = array();
$action['result'] = null;

//check if the $_GET variables are present
	
//quick/simple validation
if(empty($_GET['email']) || empty($_GET['key'])){
	$action['result'] = 'error';
	$action['text'] = 'We are missing variables. Please double check your email.';			
}
		
if($action['result'] != 'error'){

	//cleanup the variables
	$email = mysql_real_escape_string($_GET['email']);
	$key = mysql_real_escape_string($_GET['key']);
	
	//check if the key is in the database
	$check_key = mysql_query("SELECT * FROM `confirm` WHERE `email` = '$email' AND `key` = '$key' LIMIT 1") or die(mysql_error());
	
	if(mysql_num_rows($check_key) != 0){
				
		//get the confirm info
		$confirm_info = mysql_fetch_assoc($check_key);
		
		//confirm the email and update the users database
		$update_users = mysql_query("UPDATE `users` SET `active` = 1 WHERE `id` = '$confirm_info[userid]' LIMIT 1") or die(mysql_error());
		//delete the confirm row
		$delete = mysql_query("DELETE FROM `confirm` WHERE `id` = '$confirm_info[id]' LIMIT 1") or die(mysql_error());
		
		if($update_users){
						
			$action['result'] = 'success';
			$action['text'] = '���[�U�o�^�������������܂����B���O�C����ʂւ��i�݂��������B';
		
		}else{

			$action['result'] = 'error';
			$action['text'] = 'The user could not be updated Reason: '.mysql_error();;
		
		}
	
	}else{
	
		$action['result'] = 'error';
		$action['text'] = '���łɃ��[�U�o�^�͊������Ă���܂��B���O�C����ʂւ��i�݂��������B';
	
	}

}


?>

<?= 
show_errors($action); ?>

<?php
include 'inc/elements/footer.php'; ?>

<p><center><A Href="../login.php" class="button orange">���O�C��</A></center></p><br />

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
<p><center><A Href="../signup.php" class="button orange">���[�U�o�^</A></center></p>
</div>
</div>

<div class="category">
<h3 class="accordion_head">���[�U�o�^�������݂̕���</h3>
<div class="entry_body">
<p>���łɃ��[�U�[�o�^�������݂̕��͂����炩�烍�O�C�����Ă��������B</p>
<p><center><A Href="../login.php" class="button orange">���O�C��</A></center></p>
<p><center><a Href="../fgp.php">�p�X���[�h��Y�ꂽ���͂�����</a></center></p>
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
