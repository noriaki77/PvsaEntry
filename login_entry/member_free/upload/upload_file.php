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

<!--form-->
<div id="content">
<div class="container">
		<!-- mailform -->
		<div class="section">
<?php

session_start();
$_SESSION["userid"] = $_POST["userid"]; 
$_SESSION["number"] = $_POST["number"]; 
$_SESSION["title"] = $_POST["title"]; 
$_SESSION["up_id"] = "1";
//<input type="file">にvalueは設定できません。
//$file_SESSION = $_FILES['file']['name']; 
//$_SESSION["file"] = $file_SESSION; 

// 言語環境など
mb_language('uni');
mb_internal_encoding(CHARASET);
mb_regex_encoding(CHARASET);

// データベースに接続する
require("../../db.php");
/*
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
*/
// ファイルのアップロード
//投稿ボタンが押されたら
if (isset($_POST["submit"])){

    //エラーメッセージを格納する配列を作成
    $error_message = array();
	
   //各データがセットされていたら各変数にPOSTのデータを格納
  if ($_POST["userid"] == "" ) {
     $error_message[] = "<p>会員IDを入力してください。</p>";
     }
  if ($_POST["number"] == "" ) {
     $error_message[] = "<p>受付番号を入力してください。</p>";
     }
  if (preg_match("/\D/",$_POST["number"])){
	 $error_message[] = "<p>受付番号は半角数字で入力して下さい。</p>";
	  }
  if ($_POST["title"] == "" ) {
	  $error_message[] = "<p>タイトルを入力してください。</p>";
	  }
//  if ($_POST["comment"] == "" ) {
//	  $error_message[] = "<p>コメントを入力してください。</p>";
//	  }
  if ($_FILES["file"]["name"] == "" ) {
	  $error_message[] = "<p>ファイルが選択されていません。</p>";
	  }
//  if (($_FILES["file"]["type"] != "application/pdf") && ($_FILES["file"]["name"] != "" )) {
//	  $error_message[] = "<p>ファイルをアップロードできません。アップロード可能なファイル形式は PDF です。</p>";
//	  }
  if ($_FILES["file"]["size"] >= 20000000) {
	  $error_message[] = "<p>ファイルをアップロードできません。アップロード可能なファイルサイズの上限は 20 MB です。</p>";
	  }
  if (file_exists("upload/" . $_FILES["file"]["name"]) == true && ($_FILES["file"]["name"] != "" )) {
	  $error_message[] = "<p>同じファイル名が存在します。ファイル名を変更してからアップロードしてください。</p>";
	  }

  
   //エラーがない時
    if (!count($error_message)){
	
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {

	$time = date( "mdHis" );
	$mt = mt_rand(1, 99999);
	$file_nm = $_FILES['file']['name'];
	$extension = pathinfo($file_nm, PATHINFO_EXTENSION);
	$userfile_name = $time."_".$mt.".".$extension;
	
    move_uploaded_file($_FILES["file"]["tmp_name"],
    "upload/" . $userfile_name);
	echo "ファイルのアップロードが完了しました。<br /><br />";
    echo "--- アップロード結果 ---<br />";
    echo "選択したファイル名: " . $_FILES["file"]["name"] . "<br />";
    echo "ファイル形式: " . $_FILES["file"]["type"] . "<br />";
    echo "ファイルサイズ: " . ($_FILES["file"]["size"] / 1048576) . " Mb<br />";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
    echo "変換後のファイル名: " . $userfile_name;
	
     unset($_SESSION["userid"]);
     unset($_SESSION["number"]);
	 unset($_SESSION["title"]);
	 $_SESSION["up_id"] = "0";
	 
     // データベースへの追加
     $data0 = $_POST["userid"] ;
     $data1 = $_POST["number"] ;
	 $data2 = $_POST["title"] ;
	 //$data3 = $_POST["comment"] ;
	 $data3 = "" ;
	 $data4 = $userfile_name ;
     $sql3 = "INSERT INTO upload VALUES (null,'$data0','$data1','$data2','$data3','$data4')"; // SQL文
     $result3 = executeQuery($sql3);
     if (!$result3) {
     die('INSERTクエリーが失敗しました。'.mysql_error());
     }
     }
     }
    //エラーがある時
    if (count($error_message)){
    foreach ($error_message as $message){
    echo "<font color='red'>";
    print ($message);
    echo "</font>";
    }
?>  
    <br />
    <center>
    <input type="button" class="submit" id="return" value="戻る" onClick="history.back()"/>
    </center>
<?php
}
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
<li><a href="../form_summary.php">&nbsp;登録受付</a></li>
<li><a href="../admin_regi.php">&nbsp;登録受付管理</a></li>
<li><a href="../upload/upload.php">&nbsp;ファイルアップ</a></li>
<li><a href="../admin_upload.php">&nbsp;ファイルアップ管理</a></li>
<li><a href="../admin_price.php">&nbsp;参加費設定</a></li>
<li><a href="../admin_user.php">&nbsp;ユーザ管理</a></li>
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
