<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>�z�[���y�[�W</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../../css/styles-site.css" type="text/css" />
</head>

<body>

<?php
require_once("../../session.php");
?>

<div id="container"><!--"container"���폜����ƃf�U�C��������܂�-->

<!--�w�b�_�[��������-->
<h1>�z�[���y�[�W �e���v���[�g #001_blue ���o���^�O&lt;h1&gt;���g�p</h1>
<div id="header"><img src="../../../images/rogo.png" width="257" height="100" /></div>
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
<div class="pan"><a href="../index.php">�g�b�v</a> �� ���[�U�Ǘ�</div>
<!--�p���������X�g�����܂�-->

<div class="category">
<h2 class="heading2">���[�U�Ǘ�</h2>
<div class="entry_body">


<?php

session_start();


// ������Ȃ�
mb_language('uni');
mb_internal_encoding(CHARASET);
mb_regex_encoding(CHARASET);



// �f�[�^�x�[�X�ɐڑ�����
require("../../db.php");

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

// �t�@�C���̃A�b�v���[�h
if ((($_FILES["file"]["type"] == "application/pdf"))
&& ($_FILES["file"]["size"] < 20000000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $_FILES["file"]["name"]);
      echo "Stored in: " . "upload/" . $_FILES["file"]["name"];
      }
	  
     // �f�[�^�x�[�X�ւ̒ǉ�
     $data1 = $_POST["title"] ;
	 //$data1 = mb_convert_encoding($_POST["title"],"UTF-8", "auto");
     $sql3 = "INSERT INTO upload VALUES (NULL,'$data1',NULL)"; // SQL��
     $result3 = executeQuery($sql3);
     if (!$result3) {
     die('INSERT�N�G���[�����s���܂����B'.mysql_error());
     }

    }
  }
else
  {
  if (($_FILES["file"]["type"] != "application/pdf") && ($_FILES["file"]["name"] != "" )) {
	  echo "�t�@�C�����A�b�v���[�h�ł��܂���B�A�b�v���[�h�\�ȃt�@�C���`���� PDF �ł��B";
	  }
  if ($_FILES["file"]["size"] >= 20000000) {
	  echo "�t�@�C�����A�b�v���[�h�ł��܂���B�A�b�v���[�h�\�ȃt�@�C���T�C�Y�̏���� 20 MB �ł��B";
	  }
  if ($_FILES["file"]["name"] == "" ) {
	  echo "�t�@�C�����I������Ă��܂���B";
	  }
  }

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
<li><a href="../admin_user.php">���[�U�Ǘ�</a></li>
<li><a href="../admin_news.php">�V�����Ǘ�</a></li>
<li><a href="../admin_mail.php">���[���ʒm�Ǘ�</a></li>
<li><a href="../admin_regi.php">�o�^��t�Ǘ�</a></li>
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
