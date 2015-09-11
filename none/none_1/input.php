<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
    <link href="ex.css" rel="stylesheet" type="text/css">
    <script src="yahho-calendar.js" language="JavaScript"></script>
    <script type="text/javascript">
	//YahhoCal.loadYUI(); //Googleのサーバから読み込む場合
	YahhoCal.loadYUI("/yui/yui_2.9.0/yui/build/"); //自分のサーバから読み込む場合。パスは環境に合わせて変更してください
	</script>
	<script type="text/javascript">
<!--
	function Plus(form){
    form.ans.value = form.s1.value + form.area1.value + form.s2.value + form.area2.value + form.area3.value;
    return false;
	}
	// -->
</script>
</head>
<body>
情報入力ページ<BR><BR>
<table class="sample">
<tr><th>項目</th><th>内容</th></tr>


<?php


?>



<form name="seikyu" method="post" action="index_4.php">
<TR><TD>会員参加費<br>[ 条件1 : 日付選択 ]</TD><TD>受付日時が <input type="text" id="inputId" name="san1_1" onclick="YahhoCal.render(this.id);" /> 23:59:59 までは</TD></TR>
<TR><TD>会員参加費<br>[ 条件2 : 金額入力 ]</TD><TD><input type="text" name="san1_2" > 円　　「半角数字」</TD></TR>
<TR><TD>会員参加費<br>[ 条件3 : 金額入力 ]</TD><TD>それ以降は <input type="text" name="san1_3" > 円　　「半角数字」</TD></TR>
<TR><TD>非会員参加費<br>[ 金額入力 ]</TD><TD><input type="text" name="san2" > 円　　「半角数字」</TD></TR>
<TR><TD>特別セミナー参加費<br>[ 金額入力 ]</TD><TD><input type="text" name="san3" > 円　　「半角数字」</TD></TR>
<TR><TD>懇親会参加費<br>[ 金額入力 ]</TD><TD><input type="text" name="san4" > 円　　「半角数字」</TD></TR>
<TR><TD>昼食（弁当）代<br>[ 金額入力 ]</TD><TD><input type="text" name="san5" > 円　　「半角数字」</TD></TR>
<TR><TD>請求書文章 [ 1 ]</TD><TD><textarea name="area1" rows="10" cols="70">
この度は「第○回フォーラム　○○大会」にお申し込み頂きまして
誠にありがとうございます。
下記の通りご登録を受付いたしましたのでご案内申し上げます。

なお事務局での参加登録費入金確認をもって、登録完了となります。
下記お振込み先に参加登録費をお振込み下さい。

</textarea></TD></TR>
<TR><TD>請求書文章 [ 2 ]</TD><TD><textarea name="area2" rows="12" cols="70">
下記の口座へお振り込みください。

【ゆうちょ銀行】 
記号番号： 12345678
加入者名： フォーラム事務局

【銀行等から】 
銀行・支店名： ○○銀行　○○支店 
口座番号： 普通　12345678
加入者名： フォーラム事務局

</textarea></TD></TR>
<TR><TD>請求書文章 [ 3 ]</TD><TD><textarea name="area3" rows="10" cols="70">
----------------------------------------------------------
フォーラム担当事務局 
○○○○病院
事務局担当者／○○○○
Tel：01-234-5678　Fax：01-234-5678
E-mail:test@forum.ne.jp
</textarea></TD></TR>
<TR><TD>請求書プレビュー<br><br><input type="button" value="表示更新" onClick="Plus(this.form)"></TD><TD><textarea name="ans" rows="70" cols="70"></textarea></TD></TR>
<input type="hidden" name="line1" value="==========================================================
">
<input type="hidden" name="s1" value="○○○○（団体名）
○○○○（担当者名）様

">
<input type="hidden" name="s2" value="==========================================================
メールアドレス: 
区分: 
団体名:  
郵便番号:  
住所:  
電話番号:  
担当者名:  
----------------------------------------------------------
表題: 団体参加申込
参加人数: 
参加費: 
[ 計 ]: 
----------------------------------------------------------
表題: 個人参加申込
参加人数:  
参加費: 
[ 計 ]: 
----------------------------------------------------------
イベント名: 特別セミナー
参加人数: 
参加費: 
[ 計 ]: 
----------------------------------------------------------
懇親会参加人数: 
懇親会参加費: 
[ 計 ]: 
----------------------------------------------------------
昼食（弁当）数: 
昼食（弁当）代: 
[ 計 ]: 
==========================================================
[ 合計 ]: 
==========================================================

">
</table>

<BR><BR>
<input type="hidden" name="rid_id" value="<?php print $rid_s; ?>">
<input type="submit" name="submit" value="送付先リスト画面へ進む">
</form>

</body>
</html>