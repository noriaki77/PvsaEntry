<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>

<HEAD>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=x-sjis">
	<META NAME="GENERATOR" Content="Visual Page 2.0J for Windows">
	<TITLE></TITLE>
	<link href="ex_1.css" rel="stylesheet" type="text/css">
    <link href="ex_2.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>


メール文章確認<BR><BR>
<table class="sample">
<tr>
<th>項目</th>
<th>内容</th>
</tr>

<?php

//$data = $_POST["data"];


//=====================初期設定======================
$to = "sunai@telemedia.jp";
$subject = "事前配布資料の送付がありました";
$boundary = md5(uniqid(rand())); //バウンダリー文字（パートの境界）
//===================================================



if ($_POST["data"]) { //もしPOSTに [data] があれば
$data = $_POST["data"]; //POSTのデータを変数$dataに格納
if( get_magic_quotes_gpc() ) { $data = stripslashes("$data"); } //クォートをエスケープする
$data = htmlspecialchars ($data); //HTMLタグ禁止
//$data = mb_strimwidth ($data, 0, 200, "",euc); //長いデータを200バイトでカット
$data = str_replace("\r\n", "\r", $data); //Windowsの改行コードを置き換え
$data = str_replace("\r", "\n", $data); //Machintoshの改行コードを置き換え
$data = str_replace("\n", "<br>", $data); //\nを<br>に置き換え
//print $data;
}

//確認画面を生成
if($action == "post"){
	if($data){
		//ここから書き込みデータの調整
		$data = htmlspecialchars($data);		

	//} else {
	//	print "必須項目が入力されていません。<br><br>\n";
	//	print "<INPUT type=button name=close value=入力画面へ戻る onclick=history.back()>\n";
	}

}
?>


<FORM>
	<TR>
		<TD>文章記入欄</TD>
		<TD><?=$data?></TD>
	</TR>
	<TR>
		<TD>添付ファイル</TD>
		<TD><INPUT TYPE=file NAME=upfile SIZE=40 VALUE=\"$upfile\"></TD>
	</TR>
</TABLE>
</form>
<BR>


<form method="post" action="index_3.php">
<input type="hidden" name="data" value="<?php print $data; ?>">
<input type="submit" name="ret" value="修正する">
</form>

</BODY>
</HTML>