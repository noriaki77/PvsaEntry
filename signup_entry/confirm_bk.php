<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>�z�[���y�[�W �e���v���[�g</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../css/styles-site_signup.css" type="text/css" />
</head>

<body>
<div id="container"><!--"container"���폜����ƃf�U�C��������܂�-->

<!--�w�b�_�[��������-->
<h1>�z�[���y�[�W �e���v���[�g #001_blue ���o���^�O&lt;h1&gt;���g�p</h1>
<div id="header"><img src="../images/rogo.png" width="257" height="100" /></div>
<!--�w�b�_�[�����܂�-->

<!--�w�b�_�[���j���[��������-->
<div id="menu">
<ul>
<li class="home"><a href="#1">TOP</a></li>
<li><a href="#2">MAIL</a></li>
<li><a href="#3">LINKS</a></li>
<li><a href="#4">���j���[�̓e�L�X�g�̕ύX�A���̑������\�ł�</a></li>
</ul>
</div>
<!--�w�b�_�[���j���[�����܂�-->

<!--���C����������-->
<div id="main">

<!--<img src="images/648.gif" width="648" height="300" />-->

<!--�p���������X�g��������-->
<div class="pan"><a href="#01">�g�b�v</a> �� <a href="#01">�J�e�S��</a> �� �p���������X�g��&lt;div class=&quot;pan&quot;&gt;�ň͂�ł��������B�i�i���^�O&lt;p&gt;�͎g�p���Ȃ��ł��������B�j</div>
<!--�p���������X�g�����܂�-->

<div class="category">
<h2>���[�U�o�^</h2>
<div class="entry_body">
<h4>�X�e�b�v1�F���o�^���[���̑��M</h4>	

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
			$action['text'] = '<a href="http://xoops.pvsa.mmrs.jp/login.php">���O�C����ʂ�</a>';
		
		}else{

			$action['result'] = 'error';
			$action['text'] = 'The user could not be updated Reason: '.mysql_error();;
		
		}
	
	}else{
	
		$action['result'] = 'error';
		$action['text'] = 'The key and email is not in our database.';
	
	}

}


?>

<?= 
show_errors($action); ?>

<?php
include 'inc/elements/footer.php'; ?>

</div>
</div>

<!--�X�V��񂱂�����-->
<!--�X�V��񂱂��܂�-->


</div>
<!--���C�������܂�-->

<!--[if !IE]>�T�C�h���j���[��������<![endif]-->
<div id="sub">
<div class="category">
<h3><div class="h3kazari">���߂Ă̕���</div></h3>
<div class="entry_body">
<p>�T�C�h���j���[�̌��o����&lt;h3&gt;�^�O��&lt;div class=&quot;h3kazari&quot;&gt;�ň͂ނƕ\������܂��B</p>
<p><img src="images/200.gif" width="200" height="90" /></p>
<p>�ʏ�̃e�L�X�g��&lt;div class=&quot;entry_body&quot;&gt;�̒��Ɏ��܂�悤�ɂ��Ă��������B</p>
<blockquote>���p�^�O&lt;blockquote&gt;���g�p����Ƃ���Ȋ����݂̈͂ɂȂ�܂��B</blockquote>
</div>
</div>

<div class="category">
<h3><div class="h3kazari">�T�C�h���j���[�ł̃��X�g�̕\��</div></h3>
<ul>
<li><a href="#4">�J�e�S��001</a></li>
<li><a href="#4">�J�e�S��002</a></li>
<li><a href="#4">�J�e�S��003</a></li>
<li><a href="#4">�J�e�S��004</a></li>
</ul>
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
