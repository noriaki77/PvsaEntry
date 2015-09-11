<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>sample</title>
</head>
<body>
<p><?php






$dir = './files/';
deleteFile($dir);

function deleteFile($dir)
{
        if (!$handle=opendir($dir)) die("ディレクトリの読み込みに失敗しました");
        while($filename=readdir($handle))
        {
                if(!preg_match("/^\./", $filename))
                {
                        if (!unlink("$dir/$filename")) die("ファイルの削除に失敗しました");
                }
        }
}


$str = "./files/";

foreach ($_FILES["upfile"]["error"] as $key => $error) {

    if ($error == UPLOAD_ERR_OK) {
    
    if (is_uploaded_file($_FILES["upfile"]["tmp_name"][$key])) {
    
        $tmp_name = $_FILES["upfile"]["tmp_name"][$key];
        $name = $_FILES["upfile"]["name"][$key];
        $name = mb_convert_encoding($name, "SJIS", "AUTO");
        chmod($name, 0644);
        move_uploaded_file($tmp_name, "$str/$name");
        echo $_FILES["upfile"]["name"][$key] . "をアップロードしました。<BR><BR>";
        } 
    else {
    	echo "ファイルをアップロードできません。";
         }
	}
}

$Link_URL = "http://xoops.pvsa.mmrs.jp/modules/none_1/index_2.php";
echo "CSVデータファイルをデータベースにインポートします。<br /><br />";
echo "<a href=\"$Link_URL\">ここをクリック</a>して次へ進んでください。";

?></p>

</form>
</body>
</html>