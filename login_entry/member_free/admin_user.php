<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../css/styles-site.css" type="text/css" />
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


<?php

session_start();

// データベースに接続する
require("../db.php");

$sql = "SELECT username as userID,email,active FROM users"; // SQL文

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

//頁内に表示する行数
$maxline = 30;

//MySQLのクライアントの文字コードをUTF-8に設定
//mysql_query("SET NAMES UTF-8")
//  or die("can not SET NAMES UTF-8");

//GETで渡された?pageを取り出し$pageにセット
//$page = $HTTP_GET_VARS["page"];
$page=$_GET['page'];

//頁数がセットされていない場合は頁数に1をセット
if ($page < 1) {
	$page = 1;
}
//開始行を算出
$startline =  ($page - 1) * $maxline;

//終了行を算出
$endline   =  $page * $maxline -1;

//取得した行数から最終頁を算出
//ceil(数値)は小数点以下を切り上げる関数
$maxpage = ceil(mysql_num_rows($result) / $maxline);


//行数を取得する
$total = mysql_num_rows($result);
$from   =  ($page - 1) * $maxline +1;


//現在表示している頁が最終頁より前の頁の場合は前の頁のリンクを作成
if ($page < $maxpage) {
$to   =  $page * $maxline ;
} else {
$to   =  $total ;
}

print("".$total."件中 ".$from."〜".$to."件を表示");

//--- テーブルのレイアウト --- 開始 ----------------------->
print("<TABLE border='1'><TR>");
for($i=0; $i<$num; $i++) {
 print("<TH>".mysql_field_name($result,$i)."</TH>");
}
print("</TR>");

//mysql_data_seekによりtest表内の指定した行に移動する
mysql_data_seek($result,$startline);

//$iに$startlineを代入
$i=$startline;

//最終行でなく　かつ　$i<=$endlineの条件の間
//test表から行を取り出す
while($row = mysql_fetch_array($result) and $i<=$endline){

//while($row = mysql_fetch_array($result)) {
  print("<TR>");
  for($j=0; $j<1; $j++) {
    print("<TD><a href=\"admin_user_ctrl.php?userid=".$row[$j]."\">".$row[$j]."</a></TD>");
  }
  for($j=1; $j<$num; $j++) {
    print("<TD>".$row[$j]."</TD>");
  }
  print("</TR>");
  
  //$iに1を加算
		$i = $i + 1;
}
print("</TABLE>");

//現在の頁/最終頁を表示
//print("<caption valign='top' align='right'>Page ".$page."/".$maxpage."</caption>");

//HTML文を出力　caption を出力
print("<center><div class='pagination'>");

//現在表示している頁が１ページではなく最終頁ではない場合は前頁と次頁を
//区切る「・」を出力
//if ($page <> 1 and $page <> $maxpage) {
//	print("・");
//}

//現在表示している頁が１ページより後の頁の場合は前の頁のリンクを作成
if ($page > 1) {
		$i = $page - 1;
//HTML文を出力　.$pageに指定された頁数をセットしてGETで渡すリンクを作成
	print("<a href='admin_user.php?page=".$i ."'>&#171; Previous</a>" );
}

//出力可能な頁数数分繰り返す
for ($i=1;$i<=$maxpage;$i++) {

//現在の頁の時は [ ]で囲む
	if ($i==$page){
		print("<span class='current'>".$i."</span>");
	} else {
//HTML文を出力　.$pageに指定された頁数をGETで渡すリンクを作成
		print("<a href='admin_user.php?page=".$i."'>$i</a>");
	}
//最終頁以外では頁間を区切る「・」を出力
//	if ($i <> $maxpage) {
//		print("・");
//	}
}

//現在表示している頁が最終頁より前の頁の場合は前の頁のリンクを作成
if ($page < $maxpage) {
			$i = $page + 1;
//HTML文を出力　.$pageに指定された頁数をセットしてGETで渡すリンクを作成
			print( "<a href='admin_user.php?page=".$i."'>Next &#187;</a>");
}

//HTML文を出力　/caption を出力
print("</div></center>");

mysql_free_result($result);
//--- 終了 --->
?>

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

