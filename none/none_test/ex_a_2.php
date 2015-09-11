<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
    <link href="ex.css" rel="stylesheet" type="text/css">
</head>
<body>

メール送付先一覧<BR><BR>
<table class="sample">
<tr>
<th>受付ID</th>
<th>表題</th>
<th>受付日時</th>
<!--<th>更新日時</th>-->
<th>メールアドレス</th>
<th>区分</th>
<th>団体名</th>
<!--<th>郵便番号</th>-->
<!--<th>住所</th>-->
<!--<th>電話番号</th>-->
<!--<th>担当者名</th>-->
<!--<th>参加人数</th>-->
<!--<th>懇親会参加人数</th>-->
<!--<th>昼食（弁当）</th>-->
</tr>


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


$event_id_1 = 0;
//$event_id_2 = 0;
$event_id_1 = $_POST["q1"];
//$event_id_2 = $_POST["q2"];


// $rid_s = $_POST["rid_id"];
// $mail_s = $_POST["mail_id"];
// $event_id = 1;
// echo $event_id."<BR>";
// echo $rid_s."<BR>";
// echo $mail_s."<BR>";

$sql = "SELECT * FROM nwuxnz_eguide_reserv WHERE eid = '$event_id_1'";
//$sql = "SELECT * FROM nwuxnz_eguide_reserv";
$result = mysql_query($sql);


$rows = mysql_num_rows($result);
if($rows < 1){
$error = 1;

}else{


//mysql_query("TRUNCATE TABLE nwuxnz_seikyu");

while ($row_2 = mysql_fetch_assoc($result)) {

//受付ID
$data1 = $row_2['rvid'];
//表題
switch ($row_2['eid']) {
    case 6:
        $data2 = "団体参加申込";
        break;
    case 7:
        $data2 = "個人参加申込";
        break;
    case 8:
        $data2 = "特別セミナー";
        break;
}
//$data2 = $row_2['eid'];
$data3 = $row_2['rdate'];
$data4 = $row_2['koushin_data'];
$data5 = $row_2['email'];




    $row_d = $row_2['info'];
	
	$line = explode("\n" , $row_d);
	
	foreach($line as $value){

		$line_2 = explode(": " , $value);
		
			//foreach($line_2 as $value_2){
			
			$a[] = $line_2[1];
	}

	//$data6 = $a[1];
	//$data7 = $a[2];
	//$data8 = $a[3];
	//$data9 = $a[4];
	//$data10 = $a[5];
	//$data11 = $a[6];
	//$data12 = $a[7];
	//$data13 = $a[8];

mysql_query("INSERT INTO nwuxnz_seikyu_5 VALUES ('$data1', '$data2', '$data3', '$data4', '$data5', '$a[0]', '$a[1]', '$a[2]', '$a[3]', '$a[4]', '$a[5]', '$a[6]', '$a[7]', '$a[8]')");

$a=array();

}



$sql_2 = "SELECT * FROM nwuxnz_seikyu_5 ";
$result_2 = mysql_query($sql_2);

while ($data_2 = mysql_fetch_row($result_2)) {

//	mysql_query("TRUNCATE TABLE nwuxnz_edit_temp");
//  mysql_query("INSERT INTO nwuxnz_edit_temp (rid, eid, uid, rdate, koushin_data, email, info) VALUES ('$data[0]', '$data[1]', '$data[3]', '$data[4]', '$data[5]', '$data[6]', '$data[7]')");

     echo "<TR>";
    
        echo "<TD>" . $data_2[0];
        echo "</TD>";
        //////////////////////////
        
        echo "<TD>" . $data_2[1];
        echo "</TD>";
        //////////////////////////
      
        echo "<TD>" .formatTimestamp($data_2[2]);
        echo "</TD>";
        //////////////////////////
    
        //echo "<TD>" . $data_2[3];
        //echo "</TD>";
        //////////////////////////
     
        echo "<TD>" . $data_2[4];
        echo "</TD>";
        //////////////////////////
  
        echo "<TD>" . $data_2[5];
        echo "</TD>";
        //////////////////////////
       
        echo "<TD>" . $data_2[6];
        echo "</TD>";
        //////////////////////////
       
        //echo "<TD>" . $data_2[7];
        //echo "</TD>";
        //////////////////////////
       
        //echo "<TD>" . $data_2[8];
        //echo "</TD>";
        //////////////////////////
       
        //echo "<TD>" . $data_2[9];
        //echo "</TD>";
        //////////////////////////
       
        //echo "<TD>" . $data_2[10];
        //echo "</TD>";
        //////////////////////////
       
        //echo "<TD>" . $data_2[11];
        //echo "</TD>";
        //////////////////////////
       
        //echo "<TD>" . $data_2[12];
        //echo "</TD>";
        //////////////////////////
                        
        //echo "<TD>" . $data_2[13];
        //echo "</TD>";
        //////////////////////////
                   
       echo "</TR>";
    }


$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}

//if($rows < 1)の終わり
}





?>

</table>

<?php if ($error == '1') { ?>
<BR>データが見つかりませんでした<BR>
<?php } ?>

<form method="post" action="index_3.php">
<BR>
<?php if ($error != '1') { ?>

<input type="submit" name="submit" value="送付文章作成ページへ進む">
<?php } ?>
<input type="button" value="戻る" onclick="history.back();">
</form>

</body>
</html>