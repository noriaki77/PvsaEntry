<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
    <link href="ex_1.css" rel="stylesheet" type="text/css">
    <link href="ex_2.css" rel="stylesheet" type="text/css">
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


$t1 = $_POST["t1"];
$t2 = $_POST["t2"];
$t3 = $_POST["t3"];
$t4 = $_POST["t4"];
$t5 = $_POST["t5"];
$t6 = $_POST["t6"];
$t7 = $_POST["t7"];
$t8 = $_POST["t8"];
$t9 = $_POST["t9"];
$t10 = $_POST["t10"];
$t11 = $_POST["t11"];
$t12 = $_POST["t12"];
$t13 = $_POST["t13"];


$rid_s = $_POST["rid_id"];
$rid_s2 = $_POST["rid_id"];
//echo $rid_s."<BR>";
//echo $t1."<BR>";
//echo $t2."<BR>";
//echo $t3."<BR>";
//echo $t4."<BR>";
//echo $t5."<BR>";
//echo $t6."<BR>";
//echo $t7."<BR>";
//echo $t8."<BR>";
//echo $t9."<BR>";
//echo $t10."<BR>";
//echo $t11."<BR>";
//echo $t12."<BR>";
//echo $t13."<BR>";


// mysql_query("TRUNCATE TABLE nwuxnz_edit_temp_2");

//mysql_query("INSERT INTO nwuxnz_edit_temp_2 () VALUES (, '', , '$t3', '$t4', '$t5', '$t6', '$t7', '$t8', '$t9', '$t10', '$t11', '$t12', '$t13')");

    mysql_query("UPDATE nwuxnz_edit_temp_2 SET id='$rid_s', star1='$t1', star2='$t2', star3='$t3', star4='$t4', star5='$t5', star6='$t6', star7='$t7', star8='$t8', star9='$t9', star10='$t10', star11='$t11', star12='$t12', star13='$t13' WHERE id = '$rid_s'");


//echo $_POST['t1']."<BR>";
//echo $_POST['t2']."<BR>";
//echo $_POST['t3']."<BR>";
//echo $_POST['t4']."<BR>";
//echo $_POST['t5']."<BR>";
//echo $_POST['t6']."<BR>";
//echo $_POST['t7']."<BR>";
//echo $_POST['t8']."<BR>";
//echo $_POST['t9']."<BR>";
//echo $_POST['t10']."<BR>";
//echo $_POST['t11']."<BR>";
//echo $_POST['t12']."<BR>";
//echo $_POST['t13']."<BR>";


$edit = "区分: ".$_POST['t1']."\n"."団体名: ".$_POST['t2']."\n"."郵便番号: ".$_POST['t3']."\n"."住所: ".$_POST['t4']."\n"."電話番号: ".$_POST['t5']."\n"."担当者名: ".$_POST['t6']."\n"."参加人数: ".$_POST['t7']."\n"."懇親会参加人数: ".$_POST['t8']."\n"."昼食（弁当）: ".$_POST['t9']."\n"."参加者名 [ 1 ]: ".$_POST['t10']."\n"."参加者名 [ 2 ]: ".$_POST['t11']."\n"."参加者名 [ 3 ]: ".$_POST['t12']."\n"."参加者名 [ 4 ]: ".$_POST['t13'];
//echo $edit."<BR>";



$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}

?>



<table class="sample">
<tr><th>項目</th><th>申込内容</th></tr>
<TR><TD>区分: </TD><TD><?php print  $t1; ?></TD></TR>
<TR><TD>団体名: </TD><TD><?php print  $t2; ?></TD></TR>
<TR><TD>郵便番号: </TD><TD><?php print  $t3; ?></TD></TR>
<TR><TD>住所: </TD><TD><?php print  $t4; ?></TD></TR>
<TR><TD>電話番号: </TD><TD><?php print  $t5; ?></TD></TR>
<TR><TD>担当者名: </TD><TD><?php print  $t6; ?></TD></TR>
<TR><TD>参加人数: </TD><TD><?php print  $t7; ?></TD></TR>
<TR><TD>懇親会参加人数: </TD><TD><?php print  $t8; ?></TD></TR>
<TR><TD>昼食（弁当）: </TD><TD><?php print  $t9; ?></TD></TR>
<TR><TD>参加者名 [ 1 ]: </TD><TD><?php print  $t10; ?></TD></TR>
<TR><TD>参加者名 [ 2 ]: </TD><TD><?php print  $t11; ?></TD></TR>
<TR><TD>参加者名 [ 3 ]: </TD><TD><?php print  $t12; ?></TD></TR>
<TR><TD>参加者名 [ 4 ]: </TD><TD><?php print  $t13; ?></TD></TR>
</table>


<table class="sample_2">
<TR>
<form method="post" action="index_5.php">
<input type="hidden" name="rid_id" value="<?php print $rid_s; ?>"><BR>
<input type="hidden" name="str1" value="<?php print $edit; ?>">
<TD><input type="submit" name="submit" value="更新する"></TD>
</form>
<form method="post" action="index_3_1.php">
<input type="hidden" name="rid_id_2" value="<?php print $rid_s2; ?>">
<TD><input type="submit" name="ret" value="戻る"></TD>
</form>
</TR>
</table>




</body>
</html>