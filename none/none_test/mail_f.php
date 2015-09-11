<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>

<HEAD>
	<META HTTP-EQUIV="Content-Type" CONTENT="text/html; CHARSET=x-sjis">
	<META NAME="GENERATOR" Content="Visual Page 2.0J for Windows">
	<TITLE></TITLE>
    <link href="ex_1.css" rel="stylesheet" type="text/css">


</HEAD>
<BODY>

<?php

$data = $_POST["data"];

//echo $data;


/*
 * BR タグを改行コードに変換する
 */
function br2nl($string)
{
    // 大文字・小文字を区別しない
    return preg_replace('/<br[[:space:]]*\/?[[:space:]]*>/i', "\n", $string);
}

//$str = "abc<br>def<br />ghi<BR   /   >jkl";
//var_dump(br2nl($str));
$data = br2nl($data);



?>

<FORM ACTION="index_4.php" METHOD="POST" ENCTYPE="application/x-www-form-urlencoded" TARGET="_self">
<P><INPUT TYPE="HIDDEN" NAME="action" SIZE="-1" VALUE="post"></P>

メール文章作成<BR>
<P>
<TABLE  class="sample">
<tr>
<th>項目</th>
<th>内容</th>
</tr>
	<TR>
		<TD>文章記入欄</TD>
		<TD><TEXTAREA NAME="data" ROWS="40" COLS="65"><?php print $data; ?></TEXTAREA></TD>
	</TR>
	<TR>
		<TD>添付ファイル</TD>
		<TD><FONT COLOR="red">※次の確認画面で選択してください</FONT></TD>
	</TR>
</TABLE>
</P>
<P>

<INPUT TYPE="SUBMIT" NAME="Submit" VALUE="確認画面へ">

</FORM>

</BODY>

</HTML>