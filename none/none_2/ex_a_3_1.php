<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
    <link href="ex_1.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php

$rid_s = $_POST["rid_id_2"];
// echo $rid_s;
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

$sql = "SELECT * FROM nwuxnz_edit_temp_2 WHERE id = '$rid_s'";
$result = mysql_query($sql);
//$result = mysql_query('SELECT * FROM nwuxnz_edit_temp_2 WHERE rid = "$rid_s"');

while ($row = mysql_fetch_assoc($result)) {
//    print($row['id']);
$id=$row['id'];    
$star1=$row['star1'];
$star2=$row['star2'];
$star3=$row['star3'];
$star4=$row['star4'];
$star5=$row['star5'];
$star6=$row['star6'];
$star7=$row['star7'];
$star8=$row['star8'];
$star9=$row['star9'];
$star10=$row['star10'];
$star11=$row['star11'];
$star12=$row['star12'];
$star13=$row['star13'];

}


    
    
$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}


?>

<table class="sample">
<tr><th>項目</th><th>申込内容</th></tr>
<form method="post" action="index_4.php">
<TR><TD>区分: </TD><TD><input type="text" name="t1" value="<?php print $star1; ?>"></TD></TR>
<TR><TD>団体名: </TD><TD><input type="text" name="t2" value="<?php print $star2; ?>"></TD></TR>
<TR><TD>郵便番号: </TD><TD><input type="text" name="t3" value="<?php print $star3; ?>"></TD></TR>
<TR><TD>住所: </TD><TD><input type="text" name="t4" value="<?php print $star4; ?>"></TD></TR>
<TR><TD>電話番号: </TD><TD><input type="text" name="t5" value="<?php print $star5; ?>"></TD></TR>
<TR><TD>担当者名: </TD><TD><input type="text" name="t6" value="<?php print $star6; ?>"></TD></TR>
<TR><TD>参加人数: </TD><TD><input type="text" name="t7" value="<?php print $star7; ?>"></TD></TR>
<TR><TD>懇親会参加人数: </TD><TD><input type="text" name="t8" value="<?php print $star8; ?>"></TD></TR>
<TR><TD>昼食（弁当）: </TD><TD><input type="text" name="t9" value="<?php print $star9; ?>"></TD></TR>
<TR><TD>参加者名 [ 1 ]: </TD><TD><input type="text" name="t10" value="<?php print $star10; ?>"></TD></TR>
<TR><TD>参加者名 [ 2 ]: </TD><TD><input type="text" name="t11" value="<?php print $star11; ?>"></TD></TR>
<TR><TD>参加者名 [ 3 ]: </TD><TD><input type="text" name="t12" value="<?php print $star12; ?>"></TD></TR>
<TR><TD>参加者名 [ 4 ]: </TD><TD><input type="text" name="t13" value="<?php print $star13; ?>"></TD></TR>
</table>
<input type="hidden" name="rid_id" value="<?=$id?>"><BR>
<input type="submit" name="submit" value="次へ">
</form>


</body>
</html>