<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../css/styles-site.css" type="text/css" />


<SCRIPT language=JavaScript>
function diag() {
res = confirm('本当に削除しますか？');
if(res == true) {
return true;
}
return false;
}
</SCRIPT>


</head>

<body>

<?php
require_once("../session.php");
?>

<div id="container"><!--"container"を削除するとデザインが崩れます-->

<!--ヘッダーここから-->
<!--
<h1>ホームページ テンプレート #001_blue 見出しタグ&lt;h1&gt;を使用</h1>
-->
<div id="header">
<!--
<img src="../../images/rogo.png" width="257" height="100" />
-->
</div>
<!--ヘッダーここまで-->

<!--ヘッダーメニューここから-->

<!--パンくずリストここから-->
<div class="pan"><a href="index.php">トップ</a></div>
<!--パンくずリストここまで-->

<!--ヘッダーメニューここまで-->

<!--メインここから-->
<div id="main">

<!--<img src="images/648.gif" width="648" height="300" />-->

<div class="category">
<h2 class="heading2">ユーザ管理</h2>
<div class="entry_body">

<FORM action=admin_user_ctrl_dele.php method=post>

<?php

session_start();

require("../db.php");

$g_userid=$_GET['userid'];

$sql = "SELECT username as userID,email,active FROM users "; // SQL文
$sql.= "WHERE username = '" . $g_userid . "'";

// データベースに接続する
$result = executeQuery($sql);
$num = mysql_num_fields($result);

// 管理ユーザ判定
$sql2 = "SELECT email FROM users_admin "; // SQL文
$sql2.= "WHERE username = '" . $LoginId . "'";
$result2 = executeQuery($sql2);
if (mysql_num_rows($result2)){
	$admin_flag = true;
	}else{
	$admin_flag = false;
}

print("このユーザを削除しますか？");

//--- テーブルのレイアウト --- 開始 ----------------------->
print("<TABLE border='1'><TR>");
for($i=0; $i<$num; $i++) {
 print("<TH>".mysql_field_name($result,$i)."</TH>");
}
print("</TR>");
while($row = mysql_fetch_array($result)) {
  print("<TR>");
  for($j=0; $j<$num; $j++) {
    print("<TD>".$row[$j]."</TD>");
  }
  print("</TR>");
}
print("</TABLE>");
mysql_free_result($result);
//--- 終了 --->
?>

<input type="hidden" value="<?php echo $g_userid;?>" name="inpnum">
<input type="button" value="戻る" onClick="history.back()">
<INPUT type="submit" value="削除" onClick='return diag()'>
</FORM>

</div>
</div>

<!--更新情報ここから-->
<!--更新情報ここまで-->


</div>
<!--メインここまで-->

<!--[if !IE]>サイドメニューここから<![endif]-->
<div id="sub">
<!--
<div class="category">
<div class="entry_body">

<p>ようこそ！ <?= $LoginId ?> さん<br />
<a href="user_regi.php">[登録情報の変更]</a></p>
<p><form>
	<input type="button" value="ログアウト" onClick="location.href='../logout.php'">
</form></p>

</div>
</div>
-->
<div class="category">
<h3 class="accordion_head">コンテンツ</h3>
<ul>
<li><a href="form_summary.php">&nbsp;登録受付</a></li>
<li><a href="admin_regi.php">&nbsp;登録受付管理</a></li>
<li><a href="upload/upload.php">&nbsp;ファイルアップ</a></li>
<li><a href="admin_upload.php">&nbsp;ファイルアップ管理</a></li>
<li><a href="admin_price.php">&nbsp;参加費設定</a></li>
<li><a href="admin_user.php">&nbsp;ユーザ管理</a></li>
</ul>
</div>

</div>
<!--[if !IE]>サイドメニューここまで<![endif]-->

<div style="clear:both;"></div><!--デザインが崩れるので削除しない事-->

<!--フッターここから-->
<div id="footer">
<p>Copyright(C) ホームページ名 All Rights Reserved.</p>
</div>
<!--フッターここまで-->

</div><!--"container"-->

</body>
</html>

