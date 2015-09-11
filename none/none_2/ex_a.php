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


<a href="index_1.php">申込情報変更（ここをクリックしてください）</a>
<BR><BR>







</body>
</html>