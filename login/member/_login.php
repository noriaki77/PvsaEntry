<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>�z�[���y�[�W</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../css/styles-site.css" type="text/css" />
<link rel="stylesheet" href="../../login/style.css" />
<link rel="stylesheet" href="../../css/styles-site_login.css" type="text/css" />
</head>

<body>
<div id="container"><!--"container"���폜����ƃf�U�C��������܂�-->

<!--�w�b�_�[��������-->
<h1>�z�[���y�[�W �e���v���[�g #001_blue ���o���^�O&lt;h1&gt;���g�p</h1>
<div id="header"><img src="../../images/rogo.png" width="257" height="100" /></div>
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
<div class="pan"><a href="index.php">�g�b�v</a> �� �Ǘ��҃��O�C��</div>
<!--�p���������X�g�����܂�-->

<div class="category">
<h2>�Ǘ��҃��O�C��</h2>
<div class="entry_body">
<?php
session_start();

// �G���[���b�Z�[�W���i�[����ϐ���������
$error_message = "";

// ���O�C���{�^���������ꂽ���𔻒�
// ���߂ẴA�N�Z�X�ł͔F�؂͍s�킸�G���[���b�Z�[�W�͕\�����Ȃ��悤��
if (isset($_POST["login"])) {

// user_name���uphp�v��password���uadmin�v���ƃ��O�C���o����悤�ɂȂ��Ă���
if ($_POST["user_name"] == "php" && $_POST["password"] == "admin") {

// ���O�C�������������؂��Z�b�V�����ɕۑ�
$_SESSION["user_name"] = $_POST["user_name"];

// �Ǘ��Ґ�p��ʂփ��_�C���N�g
$login_url = "http://{$_SERVER["HTTP_HOST"]}/login/member/anq_result.php";
header("Location: {$login_url}");
exit;
}
$error_message = "���[�U���������̓p�X���[�h������Ă��܂��B";
}
?>


<?php
if ($error_message) {
print '<font color="red">'.$error_message.'</font>';
}
?>
<form action="login.php" method="POST">
�Ǘ��҂h�c�F<input type="text" name="user_name" value="" /><br />
�p�X���[�h�F<input type="password" name="password" value"" /><br />
<input type="submit" name="login" value="���O�C��" />
</form>

</div>
</div>

</div>
<!--���C�������܂�-->

<!--[if !IE]>�T�C�h���j���[��������<![endif]-->
<div id="sub">
<div class="category">
<h3><div class="h3kazari">���[�U���</div></h3>
<div class="entry_body">
<?php
require_once("../session.php");
?>
<p>�悤�����I <?= $LoginId ?> ����</p>
<p><form>
	<input type="button" value="���O�A�E�g" onClick="location.href='../logout.php'">
</form></p>
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

<div class="category">
<h3><div class="h3kazari">�Ǘ��҃��j���[</div></h3>
<ul>
<li><a href="login.php">�Ǘ��҃��O�C��</a></li>
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
