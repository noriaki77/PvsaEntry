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

<?php
require_once("../session.php");
?>

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
<div class="pan"><a href="index.php">�g�b�v</a> �� ���[�U�Ǘ�</div>
<!--�p���������X�g�����܂�-->

<div class="category">
<h2 class="heading2">���[�U�Ǘ�</h2>
<div class="entry_body">


<?php

session_start();

// �f�[�^�x�[�X�ɐڑ�����
require("../db.php");

$sql = "SELECT username as userID,email,active FROM users"; // SQL��

$result = executeQuery($sql);
$num = mysql_num_fields($result);

// �Ǘ����[�U����
$sql2 = "SELECT email FROM users_admin "; // SQL��
$sql2.= "WHERE username = '" . $LoginId . "'";
$result2 = executeQuery($sql2);
if (mysql_num_rows($result2)){
	$admin_flag = true;
	}else{
	$admin_flag = false;
}

//�œ��ɕ\������s��
$maxline = 20;

//MySQL�̃N���C�A���g�̕����R�[�h��sjis�ɐݒ�
//mysql_query("SET NAMES sjis")
//  or die("can not SET NAMES sjis");

//GET�œn���ꂽ?page�����o��$page�ɃZ�b�g
//$page = $HTTP_GET_VARS["page"];
$page=$_GET['page'];

//�Ő����Z�b�g����Ă��Ȃ��ꍇ�͕Ő���1���Z�b�g
if ($page < 1) {
	$page = 1;
}
//�J�n�s���Z�o
$startline =  ($page - 1) * $maxline;

//�I���s���Z�o
$endline   =  $page * $maxline -1;

//�擾�����s������ŏI�ł��Z�o
//ceil(���l)�͏����_�ȉ���؂�グ��֐�
$maxpage = ceil(mysql_num_rows($result) / $maxline);


//�s�����擾����
$total = mysql_num_rows($result);
$from   =  ($page - 1) * $maxline +1;


//���ݕ\�����Ă���ł��ŏI�ł��O�̕ł̏ꍇ�͑O�̕ł̃����N���쐬
if ($page < $maxpage) {
$to   =  $page * $maxline ;
} else {
$to   =  $total ;
}

print("".$total."���� ".$from."�`".$to."����\��");

//--- �e�[�u���̃��C�A�E�g --- �J�n ----------------------->
print("<TABLE border='1'><TR>");
for($i=0; $i<$num; $i++) {
 print("<TH>".mb_convert_encoding(mysql_field_name($result,$i),"SJIS","EUC-JP")."</TH>");
}
print("</TR>");

//mysql_data_seek�ɂ��test�\���̎w�肵���s�Ɉړ�����
mysql_data_seek($result,$startline);

//$i��$startline����
$i=$startline;

//�ŏI�s�łȂ��@���@$i<=$endline�̏����̊�
//test�\����s�����o��
while($row = mysql_fetch_array($result) and $i<=$endline){

//while($row = mysql_fetch_array($result)) {
  print("<TR>");
  for($j=0; $j<1; $j++) {
    print("<TD><a href=\"admin_user_ctrl.php?userid=".mb_convert_encoding($row[$j],"SJIS","EUC-JP")."\">".mb_convert_encoding($row[$j],"SJIS","EUC-JP")."</a></TD>");
  }
  for($j=1; $j<$num; $j++) {
    print("<TD>".mb_convert_encoding($row[$j],"SJIS","EUC-JP")."</TD>");
  }
  print("</TR>");
  
  //$i��1�����Z
		$i = $i + 1;
}
print("</TABLE>");

//���݂̕�/�ŏI�ł�\��
//print("<caption valign='top' align='right'>Page ".$page."/".$maxpage."</caption>");

//HTML�����o�́@caption ���o��
	print("<ul class='pageNav03'>");

//���ݕ\�����Ă���ł��P�y�[�W�ł͂Ȃ��ŏI�łł͂Ȃ��ꍇ�͑O�łƎ��ł�
//��؂�u�E�v���o��
//if ($page <> 1 and $page <> $maxpage) {
//	print("�E");
//}

//���ݕ\�����Ă���ł��P�y�[�W����̕ł̏ꍇ�͑O�̕ł̃����N���쐬
if ($page > 1) {
		$i = $page - 1;
//HTML�����o�́@.$page�Ɏw�肳�ꂽ�Ő����Z�b�g����GET�œn�������N���쐬
	print("<li><a href='admin_user.php?page=".$i ."'>&laquo; �O</a></li>" );
}

//�o�͉\�ȕŐ������J��Ԃ�
for ($i=1;$i<=$maxpage;$i++) {

//���݂̕ł̎��� [ ]�ň͂�
	if ($i==$page){
		print("<li><span>".$i."</span></li>");
	} else {
//HTML�����o�́@.$page�Ɏw�肳�ꂽ�Ő���GET�œn�������N���쐬
		print("<li><a href='admin_user.php?page=".$i."'>$i</a></li>");
	}
//�ŏI�ňȊO�ł͕ŊԂ���؂�u�E�v���o��
//	if ($i <> $maxpage) {
//		print("�E");
//	}
}

//���ݕ\�����Ă���ł��ŏI�ł��O�̕ł̏ꍇ�͑O�̕ł̃����N���쐬
if ($page < $maxpage) {
			$i = $page + 1;
//HTML�����o�́@.$page�Ɏw�肳�ꂽ�Ő����Z�b�g����GET�œn�������N���쐬
			print( "<li><a href='admin_user.php?page=".$i."'>�� &raquo;</a></li>");
}

//HTML�����o�́@/caption ���o��
	print("</ul>");

mysql_free_result($result);
//--- �I�� --->
?>

</div>
</div>

<!--�X�V��񂱂�����-->
<!--�X�V��񂱂��܂�-->

</div>
<!--���C�������܂�-->

<!--[if !IE]>�T�C�h���j���[��������<![endif]-->
<div id="sub">
<div class="category">
<div class="entry_body">

<p>�悤�����I <?= $LoginId ?> ����</p>
<p><form>
	<input type="button" value="���O�A�E�g" onClick="location.href='../logout.php'">
</form></p>
</div>
</div>

<div class="category">
<h3 class="accordion_head">���j���[���X�g</h3>
<ul>
<li><a href="#4">�J�e�S��001</a></li>
<li><a href="#4">�J�e�S��002</a></li>
<li><a href="#4">�J�e�S��003</a></li>
</ul>
</div>

<?php if ($admin_flag == true): ?>
<div class="category">
<h3 class="accordion_head">�Ǘ��҃��j���[</h3>
<ul>
<li><a href="admin_user.php">���[�U�Ǘ�</a></li>
<li><a href="admin_news.php">�V�����Ǘ�</a></li>
<li><a href="admin_mail.php">���[���ʒm�Ǘ�</a></li>
<li><a href="admin_regi.php">�o�^��t�Ǘ�</a></li>
</ul>
</div>
<?php endif; ?>

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
