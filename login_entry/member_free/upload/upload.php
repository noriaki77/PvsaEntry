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
<h2 class="heading2">ファイルアップ</h2>
<div class="entry_body">


<?php

session_start();

if ($_SESSION["up_id"] == "0"){
     unset($_SESSION["userid"]);
     unset($_SESSION["number"]);
	 unset($_SESSION["title"]);
}

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
?>

<!--form-->
<div id="content">
	<div class="container">

		<!-- mailform -->
		<div class="section">
			<p>下記項目のご入力をお願いいたします。<br />
入力が終わりましたら「アップロード」ボタンを押してください。アップロードが開始されます。<br />
			<span class="red">*</span>は入力必須項目です。</p>

			<form action="upload_file.php" method="post" enctype="multipart/form-data">
				<div class="section">
					<center>
					<table style="width:80%;">
						<tr>
							<th width="35%">会員ID<span class="red">*</span></th>
							<td>
								<input type="text" name="userid" value="<?php echo $_SESSION["userid"]; ?>" size="15" />
							<!--<input type="hidden" name="userid" value="<?php echo $LoginId; ?>">
								<input type="text" value="<?php echo $LoginId; ?>" onFocus="this.blur()" style="background:#EDEDED">-->
							</td>
						</tr>
						<tr>
							<th width="35%">受付番号（半角数字）<span class="red">*</span></th>
							<td>
								<input type="text" name="number" value="<?php echo $_SESSION["number"]; ?>" size="15" />
							</td>
						</tr>
						<tr>
							<th width="35%">タイトル<span class="red">*</span></th>
							<td>
								<input type="text" name="title" value="<?php echo $_SESSION["title"]; ?>" size="50" />
							</td>
						</tr>
						<!--<tr>
							<th width="35%">コメント</th>
							<td>
								<input type="text" name="comment" value="" size="50" />
							</td>
						</tr>-->
						<tr>
							<th width="35%">ファイル選択<span class="red">*</span></th>
							<td>
								<input type="file" name="file" id="file" /> 
							</td>
						</tr>
					</table>
					</center>
				</div>
				
				<center>
				<div><input type="submit" name="submit" value="アップロード" /></div>
				</center>
				
			</form>
			<br />
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