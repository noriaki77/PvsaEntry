<?php
/**
 * CHARSET:	UTF-8, CR/LF
 * PROJECT:	Whimsical Design
 * 
 * 技術研究室　PHPでExcel出力 PHPExcel
 * 
 * 2012.03.22	Whimsical Design(info@whims-d.com)
 * 
 * (c)2011~ Whimsical Design, All Rights Reserved.
 */

//	PHPExcel 1.7.6を展開
require('./PHPExcel1.7.6/PHPExcel.php');

/*
//	サンプルデータを定義
$data = array(
	1 => array(
		'A' => '0123456789',
		'B' => 'ABCDEFG'
	),
	2 => array(
		'A' => 'B+C=D, SUM(B:D)=E',
		'B' => '50',
		'C' => '100',
		'D' => '=B2+C2',
		'E' => '=SUM(B2:D2)'
	),
	3 => array(
		'A' => 'あいうえお',
		'B' => 'アイウエオ',
		'C' => 'ｱｲｳｴｵ'
	),
	4 => array(
		'B' => '高橋',
		'C' => '髙橋'
	),
	5 => array(
		'B' => '斉藤',
		'C' => '斎藤',
		'D' => '齊藤',
		'E' => '齋藤',
		'F' => '齋籐'
	),
	6 => array(
		'A' => '㈱',
		'B' => '〒',
		'C' => '①',
		'D' => '～'
	)
);
 */

$arr = array("受付番号","受付日時","会員区分","会員ID","メールアドレス","お名前（姓）","お名前（名）","フリガナ（セイ）","フリガナ（メイ）","郵便番号","都道府県","以降の住所","電話番号","参加者１（姓）","参加者１（名）","参加者１（セイ）","参加者１（メイ）","参加者２（姓）","参加者２（名）","参加者２（セイ）","参加者２（メイ）","参加者３（姓）","参加者３（名）","参加者３（セイ）","参加者３（メイ）");


//	PHPExcelオブジェクトの作成
$xls = new PHPExcel();

//	シート初期化
$xls->setActiveSheetIndex(0);

$sheet = $xls->getActiveSheet();
$sheet->getDefaultStyle()->getFont()->setName("ＭＳ ゴシック");
$sheet->getDefaultStyle()->getFont()->setSize(12);


require("../db.php");
$sql = "SELECT * FROM data";
$res_result = executeQuery($sql);
//$res_result = mysql_query( "SELECT id,time,data0,data1,data2 FROM data", $link );
while( $row= mysql_fetch_array( $res_result, MYSQL_NUM )){
$data[]=$row;
//$sheet->setCellValueByColumnAndRow(1, $row, 12345);
};
//print_r($data);

//データのセット
$row = 1;
$col = 0;
    foreach ($arr as $value) {
        $sheet->setCellValueByColumnAndRow($col++, $row, $value);
    }

//データのセット
$row = 2;
foreach ($data as $member) {
    $col = 0;
    foreach ($member as $value) {
        $sheet->setCellValueByColumnAndRow($col++, $row, $value);
    }
    $row++;
}


//if($data) {
//	foreach($data as $row => $cols) {
//		foreach($cols as $col => $value) {
//			$sheet->setCellValue($col.$row, $value);
//		}
//	}
//}

//	ヘッダ出力
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="サンプル'.date("YmdHis").'.xls"');
header('Cache-Control: max-age=0');

//	Excel出力
$xls_writer = PHPExcel_IOFactory::createWriter($xls, 'Excel5');
$xls_writer->save('php://output');
exit(0);

?>