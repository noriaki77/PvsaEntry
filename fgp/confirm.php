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
<div class="pan"><a href="../index.html">�g�b�v</a> �� �p�X���[�h�̍ēo�^</div>
<!--�p���������X�g�����܂�-->

<div class="category">
<h2 class="heading2">�p�X���[�h�̍ēo�^</h2>
<div class="entry_body">
<h4>�p�X���[�h�ēo�^�̗���ɂ���</h4>	
<table class="table3">
<tr>
<td width="25%" class="tdtitle2">�X�e�b�v1</td>
<td></td>
<td width="25%" class="tdtitle2">�X�e�b�v2</td>
<td></td>
<td width="25%" class="tdtitle2">�X�e�b�v3</td>
<td></td>
<td width="25%" class="tdtitle">�X�e�b�v4</td>
</tr>
<tr>
<td width="25%" class="tdexplain">���[�UID�A���[���A�h���X����͂��āu���M�v�{�^���������Ă��������B</td>
<td></td>
<td width="25%" class="tdexplain">���͂��ꂽ���[���A�h���X�ցu�p�X���[�h�ēo�^�̂��m�点�v���[���������肵�܂��B</td>
<td></td>
<td width="25%" class="tdexplain">���[���̈ē��ɏ]���ăp�X���[�h�ēo�^�y�[�W��URL�ɃA�N�Z�X���Ă��������B</td>
<td></td>
<td width="25%" class="tdexplain">�V�����p�X���[�h����͂��čēo�^���܂��B</td>
</tr>
</table>

</div>
</div>

<br />

<div class="category">
<div class="entry_body">
<h4>�X�e�b�v4�F�p�X���[�h�̍ēo�^</h4>

<?php

include_once 'inc/php/config.php';
include_once 'inc/php/functions.php';

?>

<?php

//setup some variables
$action = array();
$action['result'] = null;
$count = 0;
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
	$check_key = mysql_query("SELECT * FROM `confirm_fgp` WHERE `email` = '$email' AND `key` = '$key' LIMIT 1") or die(mysql_error());
	
	if(mysql_num_rows($check_key) != 0){
				
		//get the confirm info
		$confirm_info = mysql_fetch_assoc($check_key);
		
		//confirm the email and update the users database
		$update_users = mysql_query("UPDATE `users_fgp` SET `active` = 1 WHERE `id` = '$confirm_info[userid]' LIMIT 1") or die(mysql_error());
		//delete the confirm row
		$delete = mysql_query("DELETE FROM `confirm_fgp` WHERE `id` = '$confirm_info[id]' LIMIT 1") or die(mysql_error());
		
		if($update_users){
						
			$action['result'] = 'success';
			//$action['text'] = '�p�X���[�h�Ĕ��s��ʂւ��i�݂��������B</a>';
		
		}else{

			$action['result'] = 'error';
			$action['text'] = 'The user could not be updated Reason: '.mysql_error();;
		
		}
	
	}else{
	
		$action['result'] = 'error';
		$action['text'] = '�p�X���[�h�ēo�^�pURL�ւ̗L���A�N�Z�X�񐔂�1��ƂȂ��Ă���A�ȑO�ɃA�N�Z�X�����\��������܂��B�ēx�u�p�X���[�h�̍ēo�^�v���葱�������肢���܂��B<br /><br /><a href=../fgp.php>�p�X���[�h�̍ēo�^�͂�����</a>';
		$count = 1;
	}

}

?>
<div id="login2">
    <div class="box_login2">
�V�����p�X���[�h����͂��āu�p�X���[�h�ēo�^�v�{�^���������Ă��������B
				<hr>

<?= 
show_errors($action); ?>

<SCRIPT LANGUAGE="JavaScript">
<!--
function length_check() {
 len = document.password.password.value.length;
 var str = document.password.password.value;
 if (str == "") {
  alert("�p�X���[�h����͂��ĉ�����");
  return (false);
 }
 if (len < 5) {
  alert("�p�X���[�h��5�����ȏ�Őݒ肵�Ă�������");
  return (false);
 }
  if (str.match(/[^0-9A-Za-z]+/) != null) {
  alert("�p�X���[�h�ɔ��p�p���ȊO���g�p����Ă��܂�");
  return (false);
 }

}
</SCRIPT>

<?php if ($count == 0): ?>

<form name="password" method="post" action="confirm_2.php">

<label><span>���o�^���[���A�h���X</span>
<input type="text" size="40" value="<?php echo htmlspecialchars($email); ?>" name=""  disabled="disabled" />
<input type="hidden" name="email" value=<?php echo htmlspecialchars($email); ?>>
</label>
<label><span>�p�X���[�h</span><input type="text" size="40" value="" name="password" />�i���p�p��5�����ȏ�j</label>
<div class="spacer"><input type="submit" value="�p�X���[�h�ēo�^" onClick="return length_check()"></div>

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
