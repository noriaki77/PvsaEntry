<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
    <link href="ex_4.css" rel="stylesheet" type="text/css">
</head>
<body>



<?php


$id = $_POST["id"];

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


$sql_2="SELECT SQL_CALC_FOUND_ROWS * FROM nwuxnz_seikyu_3";
$res=mysql_query($sql_2);
$res2=mysql_query("SELECT FOUND_ROWS()");
$row2=mysql_fetch_row($res2);
//echo $row2[0];



$sql = "SELECT * FROM nwuxnz_seikyu_3 WHERE id = '$id'";
$result = mysql_query($sql);

$data = mysql_fetch_row($result);

$info_text = nl2br($data[2]);


$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}


$id = $id + "1";
$id_2 = $id - "2";
$id_3 = $id - "1";

?>

請求書プレビュー画面<BR><BR>
<table class="sample">
<TR>
<form method="post" action="index_5.php">
<input type="hidden" name="id" value="<?php print $id_2; ?>">
<TD><input type="submit" name="submit" value="前ページ"></TD>
</form>
<TD><? echo $id_3; ?> / <? echo $row2[0]; ?> ページ</TD>
<form method="post" action="index_5.php">
<input type="hidden" name="id" value="<?php print $id; ?>">
<TD><input type="submit" name="submit" value="次ページ"></TD>
</form>
</TR>
</table>
<BR><BR>

<?php

echo $info_text;


?>


</body>
</html>