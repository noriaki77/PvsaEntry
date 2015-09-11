<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
    <link href="ex.css" rel="stylesheet" type="text/css">
</head>
<body>


<table class="sample">
<tr>
<th>受付ID</th>
<th>表題</th>
<th>受付日時</th>
<!--<th>更新日時</th>-->
<!--<th>メールアドレス</th>-->
<th>区分</th>
<th>団体名</th>
<!--<th>郵便番号</th>-->
<!--<th>住所</th>-->
<!--<th>電話番号</th>-->
<!--<th>担当者名</th>-->
<th>参加人数</th>
<th>懇親会参加人数</th>
<th>昼食（弁当）</th>
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


mysql_query("DELETE FROM nwuxnz_seikyu");


//ディレクトリ 
$dirName_1 = "./files/"; 
//ディレクトの存在チェック 
if (is_dir($dirName_1)) { 
    //ディレクトリハンドル取得 
if ($dir_1 = opendir($dirName_1)) { 

	 //ファイル読み込み、表示 
	while (($file_1 = readdir($dir_1)) !== false) { 
	echo "$file_1\n";
	//ファイル名を変更する関数 rename()<br>
	$fname_from ="./files/$file_1";
	$fname_to ="./files/nwuxnz_seikyu.csv";
	//$fname_from_1 ="$file_1";
	//$fname_to_1 ="nwuxnz_seikyu.csv";
	
	rename($fname_from, $fname_to);
//if (rename($fname_from, $fname_to)) {
//echo "データベースへのインポート用にファイル名を $fname_from から $fname_to へ変更しました。<BR><BR>";
//} 
//else{
//echo "$fname_from から $fname_to への変更が失敗しました：";
//}

//fgetcsvの場合 
//fgetcsv(handle,length,delimiter,enclosure,escape) 
$fileName = "./files/nwuxnz_seikyu.csv"; 
$file = fopen($fileName,"r"); 

while(!feof($file)){ 

    $str = fgetcsv($file); 

    //print "$str[0]"; 
    //print "$str[1]";
    //print "$str[3]<BR>"; 
    
    
    $sql_3 = "SELECT eid FROM nwuxnz_eguide_reserv WHERE rvid = ".$str[3];
    $result_3 = mysql_query($sql_3);
    $result_3_1 = mysql_fetch_array($result_3);
    //print "$sql_3<BR>"; 
    //print "$result_3_1[0]<BR>"; 
    
    $sql_4 = "SELECT title FROM nwuxnz_eguide WHERE eid = ".$result_3_1[0];
    $result_4 = mysql_query($sql_4); 
    $result_4_1 = mysql_fetch_array($result_4);
    $str[4] = $result_4_1[0];
    //print "$sql_4<BR>"; 
    //print "$str[4]<BR>";    
        
    mysql_query("INSERT INTO nwuxnz_seikyu VALUES ('$str[3]', '$str[0]', '$str[1]', '$str[2]', '$str[4]', '$str[5]', '$str[6]', '$str[7]', '$str[8]', '$str[9]', '$str[10]', '$str[11]', '$str[12]', '$str[13]')");

	

} 

fclose($file); 

//ファイル読み込み、表示 
//while (($file_1 = readdir($dir_1)) !== false) { の終わり
}

closedir($dir_1); 

} 

}

mysql_query("DELETE FROM nwuxnz_seikyu WHERE se2 = '受付日時'");


$sql_2 = "SELECT * FROM nwuxnz_seikyu ";
$result_2 = mysql_query($sql_2);

while ($data_2 = mysql_fetch_row($result_2)) {

     echo "<TR>";
    
        echo "<TD>" . $data_2[0];
        echo "</TD>";
        //////////////////////////
        
        echo "<TD>" . $data_2[4];
        echo "</TD>";
        //////////////////////////
      
        echo "<TD>" . ($data_2[1]);
        echo "</TD>";
        //////////////////////////
    
        //echo "<TD>" . $data_2[2];
        //echo "</TD>";
        //////////////////////////
     
        //echo "<TD>" . $data_2[3];
        //echo "</TD>";
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
       
        echo "<TD>" . $data_2[11];
        echo "</TD>";
        //////////////////////////
       
        echo "<TD>" . $data_2[12];
        echo "</TD>";
        //////////////////////////
                        
        echo "<TD>" . $data_2[13];
        echo "</TD>";
        //////////////////////////
                   
       echo "</TR>";
    }

$con = mysql_close($con);
if (!$con) {
  exit('データベースとの接続を閉じられませんでした。');
}

    //$Link_URL = "http://xoops.pvsa.mmrs.jp/modules/none_1/index_3.php";
    //echo "<BR><BR><a href=\"$Link_URL\">請求書発行ページへ</a>";

?>

</table>

<BR><BR>
<a href="index_3.php">次へ</a>


</body>
</html>