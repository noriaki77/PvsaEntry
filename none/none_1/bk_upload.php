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


$str = "./files/" .$_FILES["upfile"]["name"];
$str = mb_convert_encoding($str, "SJIS", "AUTO");

if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
  if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $str)) {
    chmod($str, 0644);
    echo $_FILES["upfile"]["name"] . "をアップロードしました。<BR><BR>";
    
    
    
    //ディレクトリ 
$dirName_1 = "./files/"; 

//ディレクトの存在チェック 
if (is_dir($dirName_1)) { 

    //ディレクトリハンドル取得 
if ($dir_1 = opendir($dirName_1)) { 

        //ファイル読み込み、表示 
while (($file_1 = readdir($dir_1)) !== false) { 
//echo "$file_1<BR>"; 

//ファイル名を変更する関数 rename()<br>
$fname_from ="./files/$file_1";
$fname_to ="./files/nwuxnz_seikyu.csv";
$fname_from_1 ="$file_1";
$fname_to_1 ="nwuxnz_seikyu.csv";

if (rename($fname_from, $fname_to)) {
echo "データベースへのインポート用にファイル名を $fname_from_1 から $fname_to_1 へ変更しました。<BR><BR>";
} 
else{
//echo "$fname_from から $fname_to への変更が失敗しました：";
}

} 
closedir($dir_1); 
} 
}
    
    
    
    
    
    $Link_URL = "http://xoops.pvsa.mmrs.jp/modules/none_1/index_2.php";
    echo "<a href=\"$Link_URL\">インポートして結果を表示します。</a>";
    
    

  } else {
    echo "ファイルをアップロードできません。";
  }
} else {
  echo "ファイルが選択されていません。";
}






?></p>
</body>
</html>