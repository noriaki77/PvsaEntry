<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>�z�[���y�[�W</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../css/styles-site.css" type="text/css" />
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
<div class="pan"><a href="index.php">�g�b�v</a> �� <a href="anq_result.php">�Ǘ��҃��j���[</a> �� �Ǘ��҃y�[�W01</div>
<!--�p���������X�g�����܂�-->

<div class="category">
<h2>�^�C�g��</h2>
<div class="entry_body">
	
<?php
session_start();

// ���O�C���ς݂��ǂ����̕ϐ��`�F�b�N���s��
if (!isset($_SESSION["login_id"])) {

// �ϐ��ɒl���Z�b�g����Ă��Ȃ��ꍇ�͕s���ȏ����Ɣ��f���A���O�C����ʂփ��_�C���N�g������
$no_login_url = "http://{$_SERVER["HTTP_HOST"]}/login/member/login.php";
header("Location: {$no_login_url}");
exit;
} else {
print "�Ǘ��҃y�[�W01";
}
?>

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
<li><a href="anq_result_01.php">�J�e�S��001</a></li>
<li><a href="#5">�J�e�S��002</a></li>
<li><a href="#5">�J�e�S��003</a></li>
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
