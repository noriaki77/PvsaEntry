<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ホームページ</title>
<meta name="keywords" content="">
<meta name="description" content="">
<link rel="stylesheet" href="../../../css/styles-site.css" type="text/css" />
</head>

<body>

<?php
require_once("../../session.php");
?>

<div id="container"><!--"container"を削除するとデザインが崩れます-->

<!--ヘッダーここから-->
<h1>ホームページ テンプレート #001_blue 見出しタグ&lt;h1&gt;を使用</h1>
<div id="header"><img src="../../../images/rogo.png" width="257" height="100" /></div>
<!--ヘッダーここまで-->

<!--ヘッダーメニューここから-->
<div id="menu">
<ul>
<li class="home"><a href="#1">TOP</a></li>
<li><a href="#2">MAIL</a></li>
<li><a href="#3">LINKS</a></li>
<li><a href="#4">メニューはテキストの変更、数の増減が可能です</a></li>
</ul>
</div>
<!--ヘッダーメニューここまで-->

<!--メインここから-->
<div id="main">

<!--<img src="images/648.gif" width="648" height="300" />-->

<!--パンくずリストここから-->
<div class="pan"><a href="../index.php">トップ</a> ＞ ユーザ管理</div>
<!--パンくずリストここまで-->

<div class="category">
<h2 class="heading2">ユーザ管理</h2>
<div class="entry_body">

<!--form-->
<div id="content">
	<div class="container">
		<!-- mailform -->
		<div class="section">
<?php

session_start();


// 言語環境など
mb_language('uni');
mb_internal_encoding(CHARASET);
mb_regex_encoding(CHARASET);



// データベースに接続する
require("../../db.php");

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

// ファイルのアップロード
if (($_FILES["file"]["type"] == "application/pdf")
&& ($_FILES["file"]["size"] < 20000000)
&& (file_exists("upload/" . $_FILES["file"]["name"]) == false))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
	echo "ファイルのアップロードが完了しました。<br /><br />";
    echo "選択したファイル名: " . $_FILES["file"]["name"] . "<br />";
    echo "ファイル形式: " . $_FILES["file"]["type"] . "<br />";
    echo "ファイルサイズ: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
	  
	  $time = date( "mdHisB" );
	  $userfile_name = $_POST["number"]."_".$time.".pdf";
	  
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "upload/" . $userfile_name);
      echo "変換後のファイル名: " . "upload/" . $userfile_name;
      }
	  
     // データベースへの追加
     $data1 = $_POST["number"] ;
	 $data2 = $_POST["title"] ;
	 $data3 = $_POST["comment"] ;
	 $data4 = $userfile_name ;
	 //$data1 = mb_convert_encoding($_POST["title"],"UTF-8", "auto");
     $sql3 = "INSERT INTO upload VALUES (null,'$data1','$data2','$data3','$data4')"; // SQL文
     $result3 = executeQuery($sql3);
     if (!$result3) {
     die('INSERTクエリーが失敗しました。'.mysql_error());
     }

    }
  }
else
  {
  echo "<font color='red'>";
  if ($_POST["number"] == "" ) {
  echo "<p>受付番号を入力してください。</p>";
	  }
if(preg_match("/\D/",$_POST["number"])){
	print ("<p>受付番号は半角数字で入力して下さい。</p>");
}
  if ($_POST["title"] == "" ) {
	  echo "<p>タイトルを入力してください。</p>";
	  }
  if ($_FILES["file"]["name"] == "" ) {
	  echo "<p>ファイルが選択されていません。</p>";
	  }
  if (($_FILES["file"]["type"] != "application/pdf") && ($_FILES["file"]["name"] != "" )) {
	  echo "<p>ファイルをアップロードできません。アップロード可能なファイル形式は PDF です。</p>";
	  }
  if ($_FILES["file"]["size"] >= 20000000) {
	  echo "<p>ファイルをアップロードできません。アップロード可能なファイルサイズの上限は 20 MB です。</p>";
	  }
  if (file_exists("upload/" . $_FILES["file"]["name"]) == true && ($_FILES["file"]["name"] != "" )) {
	  echo "<p>同じファイル名が存在します。ファイル名を変更してからアップロードしてください。</p>";
	  }
  echo "</font>";
?>  
	<br />
	<center>
    <input type="button" class="submit" id="return" value="戻る" onClick="history.back()"/>
	</center>
<?php	
  }
?>

		</div>
		<!-- /mailform -->
	</div>
</div>
<!--form-->

</div>
</div>

<!--更新情報ここから-->
<!--更新情報ここまで-->

</div>
<!--メインここまで-->

<!--[if !IE]>サイドメニューここから<![endif]-->
<div id="sub">
<div class="category">
<div class="entry_body">

<p>ようこそ！ <?= $LoginId ?> さん</p>
<p><form>
	<input type="button" value="ログアウト" onClick="location.href='../../logout.php'">
</form></p>
</div>
</div>

<div class="category">
<h3 class="accordion_head">メニューリスト</h3>
<ul>
<li><a href="#4">カテゴリ001</a></li>
<li><a href="#4">カテゴリ002</a></li>
<li><a href="#4">カテゴリ003</a></li>
</ul>
</div>

<?php if ($admin_flag == true): ?>
<div class="category">
<h3 class="accordion_head">管理者メニュー</h3>
<ul>
<li><a href="../admin_user.php">ユーザ管理</a></li>
<li><a href="../admin_news.php">新着情報管理</a></li>
<li><a href="../admin_mail.php">メール通知管理</a></li>
<li><a href="../admin_regi.php">登録受付管理</a></li>
</ul>
</div>
<?php endif; ?>

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
