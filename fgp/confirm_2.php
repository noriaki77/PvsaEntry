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
<div id="header"><img src="../images/rogo.png" width="257" height="100" /></div>
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
<div id="login2">
    <div class="box_login2">
<?php

$email = $_POST['email'];
$password = $_POST['password'];
$password = md5($password);	

$link = mysql_connect('db1.mmrs.jp', 'pv1_adm', 'cc1256cc');
if (!$link) {
    die('�ڑ����s�ł��B'.mysql_error());
}

//print('<p>�ڑ��ɐ������܂����B</p>');

$db_selected = mysql_select_db('pv1_adm_mrs', $link);
if (!$db_selected){
    die('�f�[�^�x�[�X�I�����s�ł��B'.mysql_error());
}

$sql=<<<eof
UPDATE `users`
SET `password`="{$password}"
WHERE `email`="{$email}"
eof;

$result=mysql_query($sql) or die($sql.mysql_error());

$close_flag = mysql_close($link);

if ($close_flag){
print('<FONT COLOR="#2a7836">�p�X���[�h�̍ēo�^�������������܂����B</FONT><hr><br />���񃍃O�C������V�����p�X���[�h�������p���������܂��B<P></P>');
}

?>

</div>
</div>
<br /><center><A Href="../login.php" class="button orange">���O�C��</A></center><br /><br />
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
