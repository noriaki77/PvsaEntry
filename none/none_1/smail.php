<HTML>
<HEAD>
<!-- 11 -->
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html;CHARSET=x-sjis">
	<!-- <META HTTP-EQUIV="Content-Type" CONTENT="text/html;CHARSET=EUC-JP"> -->
	<TITLE>第13回フォーラム「医療の改善活動」全国大会 in 岩国</TITLE>
	<STYLE TYPE="text/css">
	<!--
	:link	 {
			Color : blue ;
			Text-Decoration : None
		}
	:active	 {
			Color : blue ;
			Text-Decoration : None
		}
	:visited	 {
			Color : blue ;
			Text-Decoration : None
		}
	A:hover	 {
			Color : blue ;
			Text-Decoration : Underline
		}
	-->
	</STYLE>
</HEAD>
<BODY BGCOLOR="#FFFFFF"><FONT SIZE="2">
<CENTER>


<?php
//=====================初期設定======================

$subject = "請求書メールテスト";
$boundary = md5(uniqid(rand())); //バウンダリー文字（パートの境界）
//===================================================

//スーパーグローバル変数対策
if(!isset($PHP_SELF)){ $PHP_SELF = $_SERVER["PHP_SELF"]; }
if(!isset($action)){ $action = $_POST['action']; }
if(!isset($message1)){ $message1 = $_POST['message1']; }
if(!isset($message2)){ $message2 = $_POST['message2']; }
if(!isset($area1)){ $area1 = $_POST['area1']; }
if(!isset($area2)){ $area2 = $_POST['area2']; }
if(!isset($area3)){ $area3 = $_POST['area3']; }
if(!isset($email)){ $email = $_POST['email']; }
if(!isset($hp)){ $hp = $_POST['hp']; }
if(!isset($area)){ $area = $_POST['area']; }
//if(!isset($db1)){ $db1 = $_POST['db1']; }
//if(!isset($db2)){ $db2 = $_POST['db2']; }
if(!isset($tel)){ $tel = $_POST['tel']; }
if(!isset($comment)){ $comment = $_POST['comment']; }
if(!isset($upfile)){ $upfile = $_FILES['upfile']['tmp_name']; }
if(!isset($upfile_name)){ $upfile_name = $_FILES['upfile']['name']; }
if(!isset($upfile_type)){ $upfile_type = $_FILES['upfile']['type']; }
//エスケープ記号対策


//DB接続、取り出し
$link = mysql_connect('db1.mmrs.jp', 'pv1_adm', 'cc1256cc');
if (!$link) {
    die('接続失敗です。'.mysql_error());
}

//print('<p>接続に成功しました。</p>');


$db_selected = mysql_select_db('pv1_adm_mrs', $link);
if (!$db_selected){
    die('データベース選択失敗です。'.mysql_error());
}

//print('<p>tqmh1データベースを選択しました。</p>');

mysql_set_charset('utf8');


$sql_c = "SELECT * FROM ymewzm_waffle0_data1";
$result_c = mysql_query($sql_c, $link) or die("クエリの送信に失敗しました。<br />SQL:".$sql_c);
$rows = mysql_num_rows($result_c);




$sql= "SELECT t1_c8,t1_c10,t1_c11 FROM ymewzm_waffle0_data1  WHERE t1_id = 2";
$result = mysql_query($sql);

$num_rows = mysql_num_rows($result);

//echo "$num_rows Rows\n";

//if ($num_rows <> 1) {
//    print $txt0;
//    print $id;    


		while ($row = mysql_fetch_assoc($result)) {
		$db1 = ($row['t1_c8']);
		$hp = ($row['t1_c10']);
		$area2 = ($row['t1_c11']);
		}
		//mb_convert_variables("SJIS", "euc-jp", $db1);
		//if (function_exists('mb_convert_encoding')) {
		//$db1 = mb_convert_encoding($db1, 'euc-jp', 'utf8');
		$hp = mb_convert_encoding($hp, 'SJIS', 'utf8');
		//}
		//$db1 = mb_convert_encoding($db1, WAFFLE_CSV_OUTPUT_TO_ENCODING, WAFFLE_CSV_OUTPUT_FROM_ENCODING);


		//参加費
        $area1 = 1500;
        //振込金額
        $area3 = $area1 * $area2;


//確認画面を生成
if($action == "post"){
	if($message1 && $message2){
//	if($message1 && $email && $hp && $area){
		//ここから書き込みデータの調整
		$message1 = htmlspecialchars($message1);
		$message1 = nl2br($message1); //HTML改行文字の挿入
		$message1 = str_replace("\r", "", $message1);
		$message1 = str_replace("\n", "", $message1);
		$message2 = htmlspecialchars($message2);
		$message2 = nl2br($message2); //HTML改行文字の挿入
		$message2 = str_replace("\r", "", $message2);
		$message2 = str_replace("\n", "", $message2);
		$email = htmlspecialchars($email);
		$hp = htmlspecialchars($hp);
		$area1 = htmlspecialchars($area1);
		$area2 = htmlspecialchars($area2);
		$area3 = htmlspecialchars($area3);						
		$area = htmlspecialchars($area);		
		$comment = htmlspecialchars($comment);
		$comment = nl2br($comment); //HTML改行文字の挿入
		$comment = str_replace("\r", "", $comment);
		$comment = str_replace("\n", "", $comment);
		//確認ページを生成

		print $db1;
		print $hp;
		print $rows;
		
		//print mb_convert_encoding('整理番号：'.$row['t1_c10']);
		

		
		
		print "▼ 内容確認 ▼<br>\n";
		print "<TABLE BORDER=1 CELLSPACING=0 WIDTH=83%>\n";
		print "<FORM ACTION=$PHP_SELF METHOD=POST ENCTYPE=multipart/form-data>\n";
		print "<INPUT TYPE=HIDDEN NAME=action VALUE=send>\n";
		print "<TR><TD WIDTH=20%><FONT size=2>病院名</FONT></TD><TD WIDTH=80%><FONT size=2>$hp</FONT></TD></TR>\n";
		print "<INPUT TYPE=HIDDEN NAME=hp VALUE=\"$hp\">\n";
		print "<TR><TD WIDTH=20%><FONT size=2>メール本文【1】</FONT></TD><TD WIDTH=80%><FONT size=2>$message1</FONT></TD></TR>\n";
		print "<INPUT TYPE=HIDDEN NAME=message1 VALUE=\"$message1\">\n";
		print "<TR><TD WIDTH=20%><FONT size=2>メール本文【2】</FONT></TD><TD WIDTH=80%><FONT size=2>$message2</FONT></TD></TR>\n";
		print "<INPUT TYPE=HIDDEN NAME=message2 VALUE=\"$message2\">\n";
		print "<TR><TD WIDTH=20%><FONT size=2>参加費</FONT></TD><TD WIDTH=80%><FONT size=2>$area1 円</FONT></TD></TR>\n";
		print "<INPUT TYPE=HIDDEN NAME=area1 VALUE=\"$area1\">\n";
		print "<TR><TD WIDTH=20%><FONT size=2>参加人数</FONT></TD><TD WIDTH=80%><FONT size=2>$area2 人</FONT></TD></TR>\n";
		print "<INPUT TYPE=HIDDEN NAME=area2 VALUE=\"$area2\">\n";
		print "<TR><TD WIDTH=20%><FONT size=2>振込金額</FONT></TD><TD WIDTH=80%><FONT size=2>$area3 円</FONT></TD></TR>\n";
		print "<INPUT TYPE=HIDDEN NAME=area3 VALUE=\"$area3\">\n";
		
		//print "<TR><TD WIDTH=20%><FONT size=2>DB取出メール</FONT></TD><TD WIDTH=80%><FONT size=2>$area</FONT></TD></TR>\n";
		//print "<INPUT TYPE=HIDDEN NAME=db1 VALUE=\".$row['t1_c8']\">\n";
		
		//print "<TR><TD WIDTH=20%><FONT size=2>DB取出コメント</FONT></TD><TD WIDTH=80%><FONT size=2>$area</FONT></TD></TR>\n";
		//print "<INPUT TYPE=HIDDEN NAME=db2 VALUE=\".$row['t1_c10']\">\n";		
				
		if($tel){
			print "<TR><TD WIDTH=20%><FONT size=2>連絡先電話番号</FONT></TD><TD WIDTH=80%><FONT size=2>$tel</FONT></TD></TR>\n";
			print "<INPUT TYPE=HIDDEN NAME=tel VALUE=\"$tel\">\n";
		}
		if($comment){
			print "<TR><TD WIDTH=20%><FONT size=2>備考欄</FONT></TD><TD WIDTH=80%><FONT size=2>$comment</FONT></TD></TR>\n";
			print "<INPUT TYPE=HIDDEN NAME=comment VALUE=\"$comment\">\n";
		}
		print "<TR><TD WIDTH=20%><FONT size=2>事前配布資料添付</FONT></TD><TD WIDTH=80%><INPUT TYPE=file NAME=upfile SIZE=70 VALUE=\"$upfile\"><br><FONT size=2><FONT COLOR=\"RED\"><b>※参照ボタンからファイルを添付してください</b></FONT></FONT></TD></TR>\n";
		print "</TABLE><br>\n";
		print "<INPUT type=button name=close value=修正する onclick=history.back()>\n";
		print "<INPUT TYPE=SUBMIT NAME=Submit VALUE=送信する></FORM>\n";
	} else {
		print "必須項目が入力されていません。<br><br>\n";
		print "<INPUT type=button name=close value=入力画面へ戻る onclick=history.back()>\n";
	}
}elseif($action == "send"){

	$rows = mysql_num_rows($result_c);

	for($a = 1; $a < $rows +1; $a++) {

	$sql= "SELECT t1_c8,t1_c10,t1_c11 FROM ymewzm_waffle0_data1  WHERE t1_id = $a";
	$result = mysql_query($sql);

	$num_rows = mysql_num_rows($result);

	while ($row = mysql_fetch_assoc($result)) {
	$db1 = ($row['t1_c8']);
	$hp = ($row['t1_c10']);
	$area2 = ($row['t1_c11']);
	}

	$hp = mb_convert_encoding($hp, 'SJIS', 'utf8');

	//}
		
	//参加費
	$area01 = 1500;
	$area1 = number_format($area01);
    //振込金額
    $area03 = $area01 * $area2;	
	$area3 = number_format($area03);
	//メッセージ送信
	$to = $db1;
	$msg = "";
	$from = "Birthday Reminder <iwa-med@d4.dion.ne.jp>";
	//$cc = "CC_Mail <noriaki.sunai@gmail.com>";
	$header  = "From: $from\n";
	//$header .= "Cc: $cc\n";
	$header .= "Reply-To: $from\n";
	$header .= "X-Mailer: PHP/".phpversion()."\n";
	$header .= "MIME-version: 1.0\n";
	if(file_exists($upfile)){ //アップファイルがあれば
		$header .= "Content-Type: multipart/mixed;\n";
		$header .= "\tboundary=\"$boundary\"\n";
		$msg .= "This is a multi-part message in MIME format.\n\n";
		$msg .= "--$boundary\n";
		$msg .= "Content-Type: text/plain; charset=ISO-2022-JP\n";
		$msg .= "Content-Transfer-Encoding: 7bit\n\n";
	}else{
		$header .= "Content-Type: text/plain; charset=ISO-2022-JP\n";
		$header .= "Content-Transfer-Encoding: 7bit\n";
	}
    $msg .= "病院名 = $hp\n";
	$msg .= "$message1\n";
	$msg .= "$message2\n";	
	$msg .= "参加費 = $area1 円\n";
	$msg .= "参加人数 = $area2 人\n";
	$msg .= "振込金額 = $area3 円\n";
	$msg .= "行数 = $rows\n";
	//$msg .= "送信先メール = $email\n";

	//$msg .= "連絡担当者名 = $area\n";
	if($tel){ $msg .= "連絡先電話番号 = $tel\n"; }
	if($comment){
		$comment = str_replace("<br />", "\n", $comment);
		$msg .= "備考欄 = $comment\n";
	}
	if(file_exists($upfile)){
		$fp = fopen($upfile, "r") or die("error"); //ファイルの読み込み
		$contents = fread($fp, filesize($upfile));
		fclose($fp);
		$f_encoded = chunk_split(base64_encode($contents)); //エンコードして分割
		$msg .= "\n\n--$boundary\n";
		$msg .= "Content-Type: " . $upfile_type . ";\n";
		$msg .= "\tname=\"$upfile_name\"\n";
		$msg .= "Content-Transfer-Encoding: base64\n";
		$msg .= "Content-Disposition: attachment;\n";
		$msg .= "\tfilename=\"$upfile_name\"\n\n";
		$msg .= "$f_encoded\n";
		$msg .= "--$boundary--";
	}
	if(mail($to, $subject, $msg, $header)){ //ファイル添付に対応
	//if(mb_send_mail($to, $subject, $msg, $header)){
		print "{$hp}は正常に送信されました<br><br>\n";
		
	} else {
		print "送信に失敗しました。もう一度やり直して下さい。<br><br>\n";
		
	}
	//}else{
	//	print "ファイルが添付されていません。<br><br>\n";
	//	print "<INPUT type=button name=close value=内容確認画面へ戻る onclick=history.back()>\n";
	//	$header .= "Content-Type: text/plain; charset=ISO-2022-JP\n";
	//	$header .= "Content-Transfer-Encoding: 7bit\n";
	//}

}

}
?>


</CENTER>

</FONT></BODY>
</HTML>