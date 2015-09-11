<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
<body>
<?php



$con = mysql_connect('db1.mmrs.jp', 'pv1_adm', 'cc1256cc');
if (!$con) {
  exit('データベースに接続できませんでした。');
}
$result = mysql_select_db('pv1_adm_mrs', $con);
if (!$result) {
  exit('データベースを選択できませんでした。');
}
$result = mysql_query('SET NAMES utf8', $con);
if (!$result) {
  exit('文字コードを指定できませんでした。');
}




$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}



?>


<form method="post" action="index_2.php">
<p>メール送信する表題を選択してください<br><BR>
<input type="checkbox" name="q1" value="6"> 団体参加申込<BR><BR>
<input type="checkbox" name="q2" value="7" disabled> 個人参加申込<BR><BR>
</p>
<p><input type="submit" value="次へ"></p>
</form>


<!--
<a href="index_2.php">団体参加申込</a>
<BR><BR>
<a href="index_b_1.php">個人参加申込</a>
-->





</body>
</html>