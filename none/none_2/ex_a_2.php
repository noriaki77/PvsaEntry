<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
    <link href="ex.css" rel="stylesheet" type="text/css">
</head>
<body>





現在の申込情報<BR><BR>
<table class="sample">
<tr>
<th>受付ID</th>
<th>受付日時</th>
<th>更新日時</th>
<th>メール</th>
<th>申込内容</th>
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


$rid_s = $_POST["rid_id"];
$mail_s = $_POST["mail_id"];
$event_id = 6;
// echo $event_id."<BR>";
// echo $rid_s."<BR>";
// echo $mail_s."<BR>";

$sql = "SELECT * FROM nwuxnz_eguide_reserv WHERE eid ='$event_id' and rvid = '$rid_s' and email = '$mail_s'";
$result = mysql_query($sql);


$rows = mysql_num_rows($result);
if($rows < 1){
$error = 1;

}else{





while ($data = mysql_fetch_row($result)) {

//	mysql_query("TRUNCATE TABLE nwuxnz_edit_temp");

    mysql_query("UPDATE nwuxnz_edit_temp SET rid='$data[0]', eid='$data[1]', uid='$data[3]', rdate='$data[4]', koushin_data='$data[5]', email='$data[6]', info='$data[7]' WHERE rid = '$rid_s'");



     echo "<TR>";
    
        //列１を出力//////////////
        $u[] = $data[0];
        echo "<TD>" . $data[0];
        echo "</TD>";
        //////////////////////////
      
        //列２を出力//////////////
        echo "<TD>" .formatTimestamp($data[4]);
        echo "</TD>";
        //////////////////////////
                 
        //列２を出力//////////////
        echo "<TD>" . $data[5];
        echo "</TD>";
        //////////////////////////
                 
        //列２を出力//////////////
        echo "<TD>" . $data[6];
        echo "</TD>";
        //////////////////////////
        
        //列２を出力//////////////
        $kai = str_replace("\n", "<br / >", $data[7]);
        echo "<TD>" . $kai;
        echo "</TD>";
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
<BR>
<form method="post" action="index_3.php">
<input type="button" value="戻る" onclick="history.back();">
<input type="hidden" name="rid_id" value="<?php print $rid_s; ?>">
<?php if ($error != '1') { ?>
<input type="submit" name="submit" value="次へ">
<?php } ?>
</form>

</body>
</html>