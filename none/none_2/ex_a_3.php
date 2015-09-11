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


$rid_s = $_POST["rid_id"];
// echo $rid_s."<BR>";


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


while ($row = mysql_fetch_assoc($result)) {

    $row_3 = $row['info'];
// 	echo $row_3."<BR>";
	
	$line = explode("\n" , $row_3);
	
//	echo "<BR>";
	

foreach($line as $key => $value){

	$line_2 = explode(": " , $value);
	foreach($line_2 as $key => $value_2){
	$a[] = $value_2;
// 	echo $value_2."<BR>";
	}

// echo $value."<BR>";
}


}


$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}


?>


<form method="post" action="index_4.php">
<TR><TD><?=$a[0]?>: </TD><TD><input type="text" name="t1" value="<?php print $a[1]; ?>"></TD></TR>
<TR><TD><?=$a[2]?>: </TD><TD><input type="text" name="t2" value="<?php print $a[3]; ?>"></TD></TR>
<TR><TD><?=$a[4]?>: </TD><TD><input type="text" name="t3" value="<?php print $a[5]; ?>"></TD></TR>
<TR><TD><?=$a[6]?>: </TD><TD><input type="text" name="t4" value="<?php print $a[7]; ?>"></TD></TR>
<TR><TD><?=$a[8]?>: </TD><TD><input type="text" name="t5" value="<?php print $a[9]; ?>"></TD></TR>
<TR><TD><?=$a[10]?>: </TD><TD><input type="text" name="t6" value="<?php print $a[11]; ?>"></TD></TR>
<TR><TD><?=$a[12]?>: </TD><TD><input type="text" name="t7" value="<?php print $a[13]; ?>"></TD></TR>
<TR><TD><?=$a[14]?>: </TD><TD><input type="text" name="t8" value="<?php print $a[15]; ?>"></TD></TR>
<TR><TD><?=$a[16]?>: </TD><TD><input type="text" name="t9" value="<?php print $a[17]; ?>"></TD></TR>
<TR><TD><?=$a[18]?>: </TD><TD><input type="text" name="t10" value="<?php print $a[19]; ?>"></TD></TR>
<TR><TD><?=$a[20]?>: </TD><TD><input type="text" name="t11" value="<?php print $a[21]; ?>"></TD></TR>
<TR><TD><?=$a[22]?>: </TD><TD><input type="text" name="t12" value="<?php print $a[23]; ?>"></TD></TR>
<TR><TD><?=$a[24]?>: </TD><TD><input type="text" name="t13" value="<?php print $a[25]; ?>"></TD></TR>
</table>
<input type="hidden" name="rid_id" value="<?php print $rid_s; ?>"><BR>
<input type="submit" name="submit" value="次へ">
</form>

</table>




</body>
</html>