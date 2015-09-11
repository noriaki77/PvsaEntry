<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../css/styles-site.css" type="text/css" />
<link rel="stylesheet" href="../../css/css3_button.css" type="text/css" />
</head>

<body>

<?php
require_once("../session.php");

// データベースに接続する
require("../db.php");
/* 
$sql = "SELECT email FROM users "; // SQL文
$sql.= "WHERE username = '" . $LoginId . "'";
$result = executeQuery($sql);
$row = mysql_fetch_assoc($result);

// 管理ユーザ判定
$sql2 = "SELECT email FROM users_admin "; // SQL文
$sql2.= "WHERE username = '" . $LoginId . "'";
$result2 = executeQuery($sql2);
if (mysql_num_rows($result2)){
	$admin_flag = true;
	}else{
	$admin_flag = false;
}
*/
// SQL文
$sql3 = "SELECT date1,price1,price2,price3,price4,date2,price5,price6,price7,price8 FROM price ";
$sql3.= "WHERE id = '1'";
$result3 = executeQuery($sql3);
$row3 = mysql_fetch_array($result3, MYSQL_NUM);

$day1 = strtotime($row3[0]);
$thedate1 = date("Y年m月d日",$day1);
$price1 = number_format($row3[1]);
$price2 = number_format($row3[2]);
$price3 = number_format($row3[3]);
$price4 = number_format($row3[4]);
$day2 = strtotime($row3[5]);
$thedate2 = date("Y年m月d日",$day2);
$price5 = number_format($row3[6]);
$price6 = number_format($row3[7]);
$price7 = number_format($row3[8]);
$price8 = number_format($row3[9]);

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
<h2 class="heading2">登録案内</h2>
<div class="entry_body">
参加費
<table border="1" cellpadding="1" cellspacing="1">
		<tr>
			<th rowspan="2" style="text-align: center">&nbsp;</th>
			<th colspan="2" style="text-align: center">参加費</th>
			<th colspan="2" style="text-align: center">懇親会費</th>
		</tr>
		<tr>
			<td style="text-align: center">早期割引</td>
			<td style="text-align: center">通常</td>
			<td style="text-align: center">早期割引</td>
			<td style="text-align: center">通常</td>
		</tr>
		<tr>
			<th style="text-align: left">会員</th>
			<td style="text-align: right"><?= $price1 ?>&nbsp;円</td>
			<td style="text-align: right"><?= $price2 ?>&nbsp;円</td>
			<td style="text-align: right"><?= $price3 ?>&nbsp;円</td>
			<td style="text-align: right"><?= $price4 ?>&nbsp;円</td>
		</tr>
		<tr>
			<th style="text-align: left">非会員</th>
			<td style="text-align: right"><?= $price5 ?>&nbsp;円</td>
			<td style="text-align: right"><?= $price6 ?>&nbsp;円</td>
			<td style="text-align: right"><?= $price7 ?>&nbsp;円</td>
			<td style="text-align: right"><?= $price8 ?>&nbsp;円</td>
		</tr>
		<tr>
			<th style="text-align: left">早期割引期限</th>
			<td colspan="2" style="text-align: center"><?= $thedate1 ?></td>
			<td colspan="2" style="text-align: center"><?= $thedate2 ?></td>
		</tr>
</table>

<br />	



<div id="login1">
    <div class="box_login">
        会員IDまたは名称（キーワード）を入力して「検索」ボタンを押してください。
		<hr>
<p><font color="#cc0000">
</font></p>
<FORM method="POST" enctype="multipart/form-data" action="form_summary1.php">
        <label><span>会員ID</span><INPUT size="15" type="text" name="id"></label>
        <label><span>法人名&nbsp;&frasl;&nbsp;病院・施設名</span><input type="keyword" size="30" name="keyword"></label>
        <div class="spacer"><input type="submit" value="検索"></div>

</form>	
<?php
/*
if($_POST){
$id = $_POST['id'];
$keyword = $_POST['keyword'];
//$list = array();
if ($keyword == "") {
$sql = "SELECT username,data FROM users_ref "; // SQL文
$sql.= "WHERE username = '" . $id . "' ORDER BY username";
} else {
$sql = "SELECT username,data FROM users_ref "; // SQL文
$sql.= "WHERE username = '" . $id . "' or data LIKE '%" . $keyword . "%' ORDER BY username";
}
$result = executeQuery($sql);
$num = mysql_num_fields($result);

print("<FORM method='POST' enctype='multipart/form-data' action='form/index.php' name='frm'>");
print("<div class='spacer'><SELECT size='5' name='list'>");
//print("<div align='right'><A HREF='excel.php' TARGET='_blank' class='button blue'>Excel形式保存</A></div>");
//print("<div class='snsb'>".$total."件中 ".$from."〜".$to."件を表示</div>");

while($row = mysql_fetch_array($result)){
  print("<OPTION value=".$row[0].">[".$row[0]."]&nbsp;".$row[1]."</OPTION>");
}  
//print("<OPTION value=".$list1.">".$list1."</OPTION>");
//print("<OPTION value=".$list2.">".$list2."</OPTION>");
//print("<OPTION value=".$list2.">".$list2."</OPTION>");
print("</SELECT><br />表示例：[会員ID]&nbsp;名称</div>");
print("<input type='hidden' name='page' value='page1' />");
print("</FORM>");
}
else{
print("<FORM method='POST' enctype='multipart/form-data' action='form/index.php' name='frm'>");
print("<input type='hidden' name='page' value='page1' />");
print("</FORM>");

}
*/
?>
	</div>
</div>

<FORM method="POST" enctype="multipart/form-data" action="form/index.php" name="frm">
<p><center><a href="JavaScript:SetAction()" onclick="document.frm.submit()" class="button blue">参加登録申込</A></center></p>



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
<li><a href="form_update.php">&nbsp;登録修正</a></li>
<li><a href="admin_regi.php">&nbsp;登録管理</a></li>
<li><a href="admin_price.php">&nbsp;参加費設定</a></li>
<li><a href="admin_ref.php">&nbsp;登録ユーザ管理</a></li>
<li><a href="text_update.php">&nbsp;要約修正</a></li>
<li><a href="text_ref_summary.php">&nbsp;要約参照</a></li>
<li><a href="upload/upload.php">&nbsp;ファイルアップ</a></li>
<li><a href="admin_upload.php">&nbsp;ファイルアップ管理</a></li>
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

