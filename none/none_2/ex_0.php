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


<form>

</form>

<form method="post" action="index_2.php">
<input type="radio" name="event" value="1" id="1"><label for="1">テストイベント表題</label><BR>
<input type="radio" name="event" value="2" id="2"><label for="2">テストイベント2表題</label><BR>
<BR>
メールアドレス: <input type="text" name="mail"><BR>
<input type="submit" name="submit" value="送信">
</form>






</body>
</html>