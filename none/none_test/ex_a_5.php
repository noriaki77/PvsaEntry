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


// echo $_POST['rid_id']."<BR>";
// echo $_POST['str1']."<BR>";

$rid_id = $_POST['rid_id'];
$str1 = $_POST['str1'];



$sql = "UPDATE nwuxnz_eguide_reserv SET info = '$str1' WHERE rvid = '$rid_id'";
$result = mysql_query($sql);





$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}


?>

更新しました


</body>
</html>