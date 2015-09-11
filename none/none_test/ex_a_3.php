<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
    <link href="ex_1.css" rel="stylesheet" type="text/css">
</head>
<body>

<table class="sample">
<tr><th>項目</th><th>申込内容</th></tr>

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

$sql = "SELECT * FROM nwuxnz_edit_temp WHERE rid = '$rid_s'";
$result = mysql_query($sql);


$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}


?>


<form method="post" action="index_4.php">
<TR><TD>その１: </TD><TD><textarea name="KANSOU" cols=30 rows=3>AAA</textarea></TD></TR>
<TR><TD>その２: </TD><TD><textarea name="KANSOU" cols=30 rows=3>AAA</textarea></TD></TR>
<TR><TD>その３: </TD><TD><textarea name="KANSOU" cols=30 rows=3>AAA</textarea></TD></TR>
<TR><TD>その４: </TD><TD><textarea name="KANSOU" cols=30 rows=3>AAA</textarea></TD></TR>
<TR><TD>その５: </TD><TD><textarea name="KANSOU" cols=30 rows=3>AAA</textarea></TD></TR>
</table>
<input type="hidden" name="rid_id" value="<?php print $rid_s; ?>"><BR><BR>
<input type="submit" name="submit" value="送信">
</form>

</table>




</body>
</html>