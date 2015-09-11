<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
    <link href="ex_3.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php

?>

<script language="JavaScript">
<!--
function checkForm(){
if(document.f1.rid_id.value == ""){
alert('受付IDを入力してください');
document.f1.rid_id.focus();
return false;
}
else if(document.f1.mail_id.value == ""){
alert('メールアドレスを入力してください');
document.f1.mail_id.focus();
return false;
}
else if(document.f1.rid_id.value.match(/[^0-9]/)){
alert("受付IDは半角数字を入力してください");
document.f1.rid_id.focus();
return false;
}
return true;
}
//-->
</script>
受付ID、メールアドレスを入力してください<BR><BR>
<table class="sample">
<form  name="f1" method="post" action="index_2.php" onSubmit="return checkForm()">
<tr><th>受付ID:</th><TD><input type="text" VALUE="36" size="35" name="rid_id">　「36」を入力してください</TD></tr>
<tr><th>メールアドレス:</th><TD><input type="text" VALUE="iwakuni.med@gmail.com" size="35" name="mail_id">　「iwakuni.med@gmail.com」を入力してください</TD></tr>
</table>
<BR>
<input type="submit" name="submit" value="次へ">
</form>






</body>
</html>