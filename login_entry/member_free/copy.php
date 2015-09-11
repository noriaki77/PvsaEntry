<?php
require_once("../session.php");
?>
<!-- ///// ここから編集してOKです ///// -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="jp" lang="jp">
<head>
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>LOGIN SYSTEM => MEMBER</title>
	<link rel="stylesheet" href="../style.css" />
</head>
<body>

ログインしている人の名前は　&lt;?= $UserName ?&gt;　で表示できます<br />
あなたの名前：<?= $UserName ?><br />
<br />
ログインしている人のログインIDは　&lt;?= $LoginId ?&gt;　で表示できます<br />
あなたのID：<?= $LoginId ?><br />
<br />
ログアウトボタン<br />
<textarea readonly onclick="javascript:this.select();this.focus();" style="width:300px;">
<form>
	<input type="button" value="log out" onClick="location.href='../logout.php'">
</form>
</textarea>

</body>
</html>