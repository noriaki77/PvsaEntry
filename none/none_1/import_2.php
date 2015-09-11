<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
    <link href="ex_1.css" rel="stylesheet" type="text/css">
</head>
<body>
送付先リスト<BR><BR>
<table class="sample">
<tr>
<th width="15">ID</th>
<th width="300">団体名</th>
</tr>


<?php

$strdime = " 23:59:59";
$san1_1 = $_POST["san1_1"].$strdime;
$time1 = strtotime($san1_1);

$san1_2 = $_POST["san1_2"];
$san1_3 = $_POST["san1_3"];
$san2 = $_POST["san2"];
$san3 = $_POST["san3"];
$san4 = $_POST["san4"];
$san5 = $_POST["san5"];
$area1 = $_POST["area1"];
$area2 = $_POST["area2"];
$area3 = $_POST["area3"];


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




$sql = "SELECT * FROM nwuxnz_seikyu ";
$result = mysql_query($sql);


$rows = mysql_num_rows($result);
if($rows < 1){
$error = 1;

}else{

mysql_query("TRUNCATE TABLE nwuxnz_seikyu_1");

while ($row_2 = mysql_fetch_array($result)) {

switch ($row_2['se5']) {
    case "特別セミナー":
        $row_2[14] = $san3;
        break;
    case "団体参加申込" || "個人参加申込":

	switch ($row_2['se6']) {
    case "非会員":
        $row_2[14] = $san2;
        break;
    case "会員":
    	$time2 = strtotime($row_2['se2']);
    	if ($time2 <= $time1) {
    	$row_2[14] = $san1_2;
  		}
  		else {
    	$row_2[14] = $san1_3;
  		}
        break;
	}
}

//$row_2[14] = strtotime($san1_1);
//$row_2[14] = $san1_1;

mysql_query("INSERT INTO nwuxnz_seikyu_1 VALUES ('$row_2[0]', '$row_2[1]', '$row_2[2]', '$row_2[3]', '$row_2[4]', '$row_2[5]', '$row_2[6]', '$row_2[7]', '$row_2[8]', '$row_2[9]', '$row_2[10]', '$row_2[11]', '$row_2[12]', '$row_2[13]', '$row_2[14]')");

}

}


$sql_2 = "SELECT se1_4, se1_5, se1_6, se1_7, se1_8, se1_9, se1_10, se1_11, SUM(se1_12), SUM(se1_13), SUM(se1_14), se1_15 FROM nwuxnz_seikyu_1 group by se1_4, se1_5, se1_6, se1_7, se1_8, se1_9, se1_10, se1_11";
$result_3 = mysql_query($sql_2);
//$result_2 = mysql_query($sql_2);


$sql_5 = "SELECT se1_4, se1_6, se1_7, se1_8, se1_9, se1_10, se1_11 FROM nwuxnz_seikyu_1 group by se1_4, se1_6, se1_7, se1_8, se1_9, se1_10, se1_11";

//echo $sql_5;

$result_5 = mysql_query($sql_5);


mysql_query("TRUNCATE TABLE nwuxnz_seikyu_2");
while ($row_3 = mysql_fetch_array($result_3)) {
mysql_query("INSERT INTO nwuxnz_seikyu_2 VALUES (NULL, '$row_3[0]', '$row_3[1]', '$row_3[2]', '$row_3[3]', '$row_3[4]', '$row_3[5]', '$row_3[6]', '$row_3[7]', '$row_3[8]', '$row_3[9]', '$row_3[10]', '$row_3[11]')");
}


mysql_query("TRUNCATE TABLE nwuxnz_seikyu_4");
while ($row_5 = mysql_fetch_array($result_5)) {
mysql_query("INSERT INTO nwuxnz_seikyu_4 VALUES (NULL, '$row_5[0]', '$row_5[1]', '$row_5[2]', '$row_5[3]', '$row_5[4]', '$row_5[5]', '$row_5[6]')");
}

mysql_query("TRUNCATE TABLE nwuxnz_seikyu_3");

$sql_6 = "SELECT * FROM nwuxnz_seikyu_4";
$result_6 = mysql_query($sql_6);


while ($data_6 = mysql_fetch_array($result_6)) {

	$sql_4 = "SELECT se2_3, se2_10, se2_11, se2_12, se2_13 FROM nwuxnz_seikyu_2 WHERE se2_2 = '$data_6[1]'and se2_4 = '$data_6[2]'and se2_5 = '$data_6[3]'and se2_6 = '$data_6[4]'and se2_7 = '$data_6[5]'and se2_8 = '$data_6[6]'and se2_9 = '$data_6[7]'";

	//echo $sql_4;

	$result_4 = mysql_query($sql_4);

	while ($data_4 = mysql_fetch_array($result_4)) {
    
	//echo $data_4[0];    
    
	switch ($data_4[0]) {
    case "団体参加申込":
        $dan1 = $data_4[1];
        $dan2 = $data_4[4];
        $kon_a = $data_4[2];
        $tyu_a = $data_4[3];
        break;
    case "個人参加申込":
        $koj1 = $data_4[1];
        $koj2 = $data_4[4];
        $kon_b = $data_4[2];
        $tyu_b = $data_4[3];
        break;
    case "特別セミナー":
        $san1 = $data_4[1];
        $san2 = $data_4[4];
        $kon_c = $data_4[2];
        $tyu_c = $data_4[3];
        break;
	}

$kon1 = $kon_a + $kon_b + $kon_c;
$tyu1 = $tyu_a + $tyu_b + $tyu_c;

$dan3 = $dan1 * $dan2;
$koj3 = $koj1 * $koj2;
$sem3 = $sem1 * $sem2;
$kon3 = $kon1 * $san4;
$tyu3 = $tyu1 * $san5;

$goukei = $dan3 + $koj3 + $sem3 + $kon3 + $tyu3;

	}


$val = $data_6[3]
."\n"
.$data_6[7]
." 様"
."\n"
."\n"
.$area1
."=========================================================="."\n"
."メールアドレス: ".$data_6[1]."\n"
."区分: ".$data_6[2]."\n"
."団体名: ".$data_6[3]."\n"
."郵便番号: ".$data_6[4]."\n"
."住所: ".$data_6[5]."\n"
."電話番号: ".$data_6[6]."\n"
."担当者名: ".$data_6[7]."\n"
."----------------------------------------------------------"."\n"
."表題: 団体参加申込"."\n"
."参加人数: ".$dan1."\n"
."参加費: ".number_format($dan2)."\n"
."[ 計 ]: ".number_format($dan3)."\n"
."----------------------------------------------------------"."\n"
."表題: 個人参加申込"."\n"
."参加人数: ".$koj1."\n"
."参加費: ".number_format($koj2)."\n"
."[ 計 ]: ".number_format($koj3)."\n"
."----------------------------------------------------------"."\n"
."イベント名: 特別セミナー"."\n"
."参加人数: ".$sem1."\n"
."参加費: ".number_format($sem2)."\n"
."[ 計 ]: ".number_format($sem3)."\n"
."----------------------------------------------------------"."\n"
."懇親会参加人数: ".$kon1."\n"
."懇親会参加費: ".number_format($san4)."\n"
."[ 計 ]: ".number_format($kon3)."\n"
."----------------------------------------------------------"."\n"
."昼食（弁当）数: ".$tyu1."\n"
."昼食（弁当）代: ".number_format($san5)."\n"
."[ 計 ]: ".number_format($tyu3)."\n"
."=========================================================="."\n"
."[ 合計 ]: ".number_format($goukei)."\n"
."=========================================================="."\n"
."\n"
.$area2
.$area3
."\n";

mysql_query("INSERT INTO nwuxnz_seikyu_3 VALUES (NULL,'$data_6[3]','$val')");


    }                              


$sql_7 = "SELECT * FROM nwuxnz_seikyu_3";
$result_7 = mysql_query($sql_7);

while ($data_7 = mysql_fetch_row($result_7)) {

     echo "<TR>";

        echo "<TD>" . $data_7[0];
        echo "</TD>";
        //////////////////////////
                  
        echo "<TD>" . $data_7[1];
        echo "</TD>";
        //////////////////////////

        echo "</TR>";
    }






$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}

?>


</table>


<?php if ($error == '1') { ?>
<BR>データが見つかりませんでした<BR>
<?php } ?>
<form method="post" action="index_5.php"><BR>
<?php if ($error != '1') { ?>
<?php } ?>
<input type="hidden" name="id" value="1">
<input type="submit" name="submit" value="プレビュー画面へ進む">
<input type="button" value="戻る" onclick="history.back();">
</form>

</body>
</html>