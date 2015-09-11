<?php
	#データベース取得
	require("../db.php");

	#データ取得
	$User = mb_convert_kana($_POST["user"], "a", "UTF-8");
	$Pass = mb_convert_kana($_POST["pass"], "a", "UTF-8");
	$Name = $_POST["name"];

	#戻る
	$ref = $_SERVER['HTTP_REFERER'];

	#ログインIDの重複チェック
	$sql = "SELECT * FROM spls_user WHERE user = '".$User."'";
	$result = executeQuery($sql);
	$rows = mysql_num_rows($result);
  if($rows != NULL){
		$tmp .= "<tr>\n";
		$tmp .= "<td>User ： '".$User."' は使用されています。</td>\n";
		$tmp .= "<tr>\n";
		$msg .= "<a href=\"".$ref."\">back to sign up</a>";
	}else{

	#ユーザー名の重複チェック
	$sql = "SELECT * FROM spls_user WHERE name = '".$Name."'";
	$result = executeQuery($sql);
	$rows = mysql_num_rows($result);
  if($rows != NULL){
		$tmp .= "<tr>\n";
		$tmp .= "<td>Name ： '".$Name."' は使用されています。</td>\n";
		$tmp .= "<tr>\n";
		$msg .= "<a href=\"".$ref."\">back to sign up</a>";
	}else{

	if( mb_ereg("[^0-9a-zA-Z]", $User) || (strlen($User) < 3)){
		$tmp .= "<tr>\n";
		$tmp .= "<td>Userは半角英数字で3文字以上です。</td>\n";
		$tmp .= "<tr>\n";
		$msg .= "<a href=\"".$ref."\">back to sign up</a>";
	}else{

		if( mb_ereg("[^0-9a-zA-Z]", $Pass) || (strlen($Pass) < 3)){
			$tmp .= "<tr>\n";
			$tmp .= "<td>Passは半角英数字で3文字以上です。</td>\n";
			$tmp .= "</tr>\n";
			$msg .= "<a href=\"".$ref."\">back to sign up</a>";
		}else{

			$sql = "INSERT INTO spls_user VALUES ( ".time().", '".$User."', '".$Pass."', '".$Name."' )";
			$result = executeQuery($sql);
				$tmp .= "<tr>\n";
				$tmp .= "<td align=\"right\">UserID</td><td>".$User."</td>\n";
				$tmp .= "</tr>";
				$tmp .= "<tr>\n";
				$tmp .= "<td align=\"right\">Pass</td><td>".$Pass."</td>\n";
				$tmp .= "</tr>";
				$tmp .= "<tr>\n";
				$tmp .= "<td align=\"right\">Name</td><td>".$Name."</td>\n";
				$tmp .= "</tr>";
				$msg .= "<a href=\"../\">back to top</a>";
			}
		}
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="jp" lang="jp">
<head>
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>LOGIN SYSTEM => SIGN UP</title>
	<link rel="stylesheet" href="../style.css" />
</head>
<body>
<div style="margin:0px;padding:0px 0px 10px 0px;font-size:10px;">
	<?= $msg ?>
</div>

<table border="0" cellpadding="5" cellspacing="0" style="padding-left:20px;">
<?= $tmp ?>
</table>

</body>
</html>