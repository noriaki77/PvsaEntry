<?php
	function executeQuery($sql){
	#----- ↓変更して下さい↓ ------#
	$url = "db1.mmrs.jp";  #MySqlサーバー名
	$user = "pv1_adm";  #Myqlユーザー名
	$pass = "cc1256cc";  #Mysqlパスワード
	$db = "pv1_adm_mrs";  #データベース名
	#------ ↑変更ここまで↑ -------#

	# MySQLへ接続する
	$link = mysql_connect($url,$user,$pass) or die("MySQLへの接続に失敗しました。");

	# データベースを選択する
	$sdb = mysql_select_db($db,$link) or die("データベースの選択に失敗しました。");

	#キャラクタセット
	mysql_query("set names utf8");

	# クエリを送信する
	$result = mysql_query($sql, $link) or die("クエリの送信に失敗しました。<br />SQL:".$sql);

	# MySQLへの接続を閉じる
	mysql_close($link) or die("MySQL切断に失敗しました。");

	#戻り値
	return($result);
	}
?>