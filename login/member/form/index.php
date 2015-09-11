<?php
/*
 * System name : TransmitMail
 * Description : メール送信システム本体
 * Author : TAGAWA Takao (dounokouno@gmail.com)
 * License : MIT License
 * Since : 2010-11-19
 * Modified : 2012-03-21
*/
session_start();
require_once("../../session2.php");
	if( $_SESSION["login_id"] == "" ){
			$login_url = "http://{$_SERVER["HTTP_HOST"]}/login.php";
			header("Location: {$login_url}");
			exit;
	}else{
		$UserName = $_SESSION["name"];
		$LoginId = $_SESSION["login_id"];
	}
// --------------------------------------------------------------
// ライブラリ読み込み
// --------------------------------------------------------------
require_once('./conf/config.php');
require_once('./lib/common.php');
require_once('./lib/tinyTemplate.php');
$tmpl = new tinyTemplate();


// --------------------------------------------------------------
// 言語環境など
// --------------------------------------------------------------
mb_language('uni');
mb_internal_encoding(CHARASET);
mb_regex_encoding(CHARASET);
ini_set('error_log', DIR_LOGS . '/error.log');


// --------------------------------------------------------------
// 変数
// --------------------------------------------------------------
// 統括エラー
$global_error = array();
$global_error_flag = false;

// アクセス拒否フラグ
$deny_flag = false;

// 表示ページ名
$page = '';

$LoginId == $_SESSION["login_id"];
$email == 1;

// --------------------------------------------------------------
// 管理ユーザ判定
// --------------------------------------------------------------
// データベースに接続する
require("../../db.php");
$sql = "SELECT email FROM users_admin "; // SQL文
$sql.= "WHERE username = '" . $LoginId . "'";
$result = executeQuery($sql);
if (mysql_num_rows($result)){
	$admin_flag = true;
	}else{
	$admin_flag = false;
}

// --------------------------------------------------------------
// GET値、POST値、SERVER値取得
// --------------------------------------------------------------
// $_GET、$_POST
$_GET = delete_nullbyte($_GET);
$_POST = delete_nullbyte($_POST);
$_GET = safe_strip_slashes($_GET);
$_POST = safe_strip_slashes($_POST);

// $_SERVER
$_SERVER = delete_nullbyte($_SERVER);
$_SERVER = safe_strip_slashes($_SERVER);
if (isset($_SERVER['REMOTE_HOST']) || empty($_SERVER['REMOTE_HOST'])) {
	$_SERVER['REMOTE_HOST'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
}

// アクセス拒否判定
if (defined('DENY_HOST') && strlen(DENY_HOST) > 0) {
	$pattern = '/' . DENY_HOST . '/';
	if (preg_match($pattern, $_SERVER['REMOTE_ADDR'])
		|| preg_match($pattern, $_SERVER['REMOTE_HOST'])
	) {
		$deny_flag = true;
	}
}

// --------------------------------------------------------------
// 入力内容取得
// --------------------------------------------------------------
// デフォルトのchecked、selectedをテンプレートにセット
$tmpl->set('checked.default', ATTR_CHECKED);
$tmpl->set('selected.default', ATTR_SELECTED);
if (count($_POST) > 0) {
	$tmpl->set('checked.default', '');
	$tmpl->set('selected.default', '');
}

// ラジオボタン、チェックボックス、セレクトメニューの選択状態
foreach ($_POST as $k1 => $v1) {
	if (is_array($v1)) {
		foreach ($v1 as $v2) {
			$tmpl->set("checked.$k1.$v2", ATTR_CHECKED);
			$tmpl->set("selected.$k1.$v2", ATTR_SELECTED);
		}
	} else {
		$tmpl->set("checked.$k1.$v1", ATTR_CHECKED);
		$tmpl->set("selected.$k1.$v1", ATTR_SELECTED);
	}
}

// 入力必須チェック
if (isset($_POST['required'])) {
	foreach ($_POST['required'] as $v) {
		$tmpl->set("required.$v", false);
		if (empty($_POST[$v])) {
			$tmpl->set("required.$v", h($v . ERROR_REQUIRED));
			$global_error[] = h($v . ERROR_REQUIRED);
			$global_error_flag = true;
		}
	}
}

// 半角文字チェック
if (isset($_POST['hankaku'])) {
	foreach ($_POST['hankaku'] as $v) {
		$tmpl->set("hankaku.$v", false);
		if (!empty($_POST[$v])) {
			$_POST[$v] = mb_convert_kana($_POST[$v], 'a');
			if (!check_hankaku($_POST[$v])) {
				$tmpl->set("hankaku.$v", h($v . ERROR_HANKAKU));
				$global_error[] = h($v . ERROR_HANKAKU);
				$global_error_flag = true;
			}
		}
	}
}

// 半角英数字チェック
if (isset($_POST['hankaku_eisu'])) {
	foreach ($_POST['hankaku_eisu'] as $v) {
		$tmpl->set("hankaku_eisu.$v", false);
		if (!empty($_POST[$v])) {
			$_POST[$v] = mb_convert_kana($_POST[$v], 'a');
			if (!check_hankaku_eisu($_POST[$v])) {
				$tmpl->set("hankaku_eisu.$v", h($v . ERROR_HANKAKU_EISU));
				$global_error[] = h($v . ERROR_HANKAKU_EISU);
				$global_error_flag = true;
			}
		}
	}
}

// 半角英字チェック
if (isset($_POST['hankaku_eiji'])) {
	foreach ($_POST['hankaku_eiji'] as $v) {
		$tmpl->set("hankaku_eiji.$v", false);
		if (!empty($_POST[$v])) {
			$_POST[$v] = mb_convert_kana($_POST[$v], 'r');
			if (!check_hankaku_eiji($_POST[$v])) {
				$tmpl->set("hankaku_eiji.$v", h($v . ERROR_HANKAKU_EIJI));
				$global_error[] = h($v . ERROR_HANKAKU_EIJI);
				$global_error_flag = true;
			}
		}
	}
}

// 数値チェック
if (isset($_POST['num'])) {
	foreach ($_POST['num'] as $v) {
		$tmpl->set("num.$v", false);
		if (!empty($_POST[$v])) {
			$_POST[$v] = mb_convert_kana($_POST[$v], 'n');
			if (!check_num($_POST[$v])) {
				$tmpl->set("num.$v", h($v . ERROR_NUM));
				$global_error[] = h($v . ERROR_NUM);
				$global_error_flag = true;
			}
		}
	}
}
	
// 数値とハイフンチェック
if (isset($_POST['num_hyphen'])) {
	foreach ($_POST['num_hyphen'] as $v) {
		$tmpl->set("num_hyphen.$v", false);
		if (!empty($_POST[$v])) {
			$_POST[$v] = mb_convert_kana($_POST[$v], 'a');
			if (!check_num_hyphen($_POST[$v])) {
				$tmpl->set("num_hyphen.$v", h($v . ERROR_NUM_HYPHEN));
				$global_error[] = h($v . ERROR_NUM_HYPHEN);
				$global_error_flag = true;
			}
		}
	}
}
	
// ひらがなチェック
if (isset($_POST['hiragana'])) {
	foreach ($_POST['hiragana'] as $v) {
		$tmpl->set("hiragana.$v", false);
		if (!empty($_POST[$v])) {
			$_POST[$v] = mb_convert_kana($_POST[$v], 'cH');
			$_POST[$v] = delete_blank($_POST[$v]);
			if (!check_hiragana($_POST[$v])) {
				$tmpl->set("hiragana.$v", h($v . ERROR_HIRAGANA));
				$global_error[] = h($v . ERROR_HIRAGANA);
				$global_error_flag = true;
			}
		}
	}
}
	
// 全角カタカナチェック
if (isset($_POST['zenkaku_katakana'])) {
	foreach ($_POST['zenkaku_katakana'] as $v) {
		$tmpl->set("zenkaku_katakana.$v", false);
		if (!empty($_POST[$v])) {
			$_POST[$v] = mb_convert_kana($_POST[$v], 'CK');
			$_POST[$v] = delete_blank($_POST[$v]);
			if (!check_zenkaku_katakana($_POST[$v])) {
				$tmpl->set("zenkaku_katakana.$v", ($v . ERROR_ZENKAKU_KATAKANA));
				$global_error[] = ($v . ERROR_ZENKAKU_KATAKANA);
				$global_error_flag = true;
			}
		}
	}
}

// 半角カタカナチェック
if (isset($_POST['hankaku_katakana'])) {
	foreach ($_POST['hankaku_katakana'] as $v) {
		$tmpl->set("hankaku_katakana.$v", false);
		if (!empty($_POST[$v])) {
			$_POST[$v] = mb_convert_kana($_POST[$v], 'kh');
			$_POST[$v] = delete_blank($_POST[$v]);
			if (!check_hankaku_katakana($_POST[$v])) {
				$tmpl->set("hankaku_katakana.$v", h($v . ERROR_HANKAKU_KATAKANA));
				$global_error[] = h($v . ERROR_HANKAKU_KATAKANA);
				$global_error_flag = true;
			}
		}
	}
}

// 全角文字チェック
if (isset($_POST['zenkaku'])) {
	foreach ($_POST['zenkaku'] as $v) {
		$tmpl->set("zenkaku.$v", false);
		if (!empty($_POST[$v])) {
			if (!check_zenkaku($_POST[$v])) {
				$tmpl->set("zenkaku.$v", h($v . ERROR_ZENKAKU));
				$global_error[] = h($v . ERROR_ZENKAKU);
				$global_error_flag = true;
			}
		}
	}
}

// 全て全角文字チェック
if (isset($_POST['zenkaku_all'])) {
	foreach ($_POST['zenkaku_all'] as $v) {
		$tmpl->set("zenkaku_all.$v", false);
		if (!empty($_POST[$v])) {
			if (!check_zenkaku_all($_POST[$v])) {
				$tmpl->set("zenkaku_all.$v", h($v . ERROR_ZENKAKU_ALL));
				$global_error[] = h($v . ERROR_ZENKAKU_ALL);
				$global_error_flag = true;
			}
		}
	}
}

// メールアドレスチェック
if (isset($_POST['email'])) {
	foreach ($_POST['email'] as $v) {
		$tmpl->set("email.$v", false);
		if (!empty($_POST[$v])) {
			$_POST[$v] = mb_convert_kana($_POST[$v], 'a');
			$_POST[$v] = delete_crlf($_POST[$v]);
			if (!check_mail_address($_POST[$v])) {
				$tmpl->set("email.$v", h($v . ERROR_EMAIL));
				$global_error[] = h($v . ERROR_EMAIL);
				$global_error_flag = true;
			}
		}
	}
}

// 自動返信メールの宛先（$_POST[AUTO_REPLY_EMAIL]）のメールアドレスチェック
if (isset($_POST[AUTO_REPLY_EMAIL]) && !empty($_POST[AUTO_REPLY_EMAIL])) {
	$_POST[AUTO_REPLY_EMAIL] = mb_convert_kana($_POST[AUTO_REPLY_EMAIL], 'a');
	$_POST[AUTO_REPLY_EMAIL] = delete_crlf($_POST[AUTO_REPLY_EMAIL]);
	if (!check_mail_address($_POST[AUTO_REPLY_EMAIL])) {
		$tmpl->set("email." . AUTO_REPLY_EMAIL, h(AUTO_REPLY_EMAIL . ERROR_EMAIL));
		$global_error[] = h(AUTO_REPLY_EMAIL . ERROR_EMAIL);
		$global_error_flag = true;
	}
}

// 一致チェック
if (isset($_POST['match'])) {
	foreach ($_POST['match'] as $v) {
		$array = preg_split('/\s|,/', $v);
		$tmpl->set("match.$array[0]", false);
		if (!empty($_POST[$array[0]])
			&& !empty($_POST[$array[1]])
			&& $_POST[$array[0]] != $_POST[$array[1]]
			) {
				$tmpl->set("match.$array[0]", h($array[0] . ERROR_MATCH));
				$global_error[] = h($array[0] . ERROR_MATCH);
				$global_error_flag = true;
		}
	}
}

// 文字数チェック
if (isset($_POST['len'])) {
	foreach ($_POST['len'] as $v) {
		$array = preg_split('/\s|,/', $v);
		$delim = explode('-', $array[1]);
		$tmpl->set("len.$array[0]", false);
		if (!empty($_POST[$array[0]]) && !check_len($_POST[$array[0]], $delim)) {
			if (empty($delim[0])) {
				$error_len = str_replace('{文字数}', "$delim[1]文字以内", ERROR_LEN);
			} elseif (empty($delim[1])) {
				$error_len = str_replace('{文字数}', "$delim[0]文字以上", ERROR_LEN);
			} else {
				$error_len = str_replace('{文字数}', "$delim[0]〜$delim[1]文字", ERROR_LEN);
			}
			$tmpl->set("len.$array[0]", h($array[0] . $error_len));
			$global_error[] = h($array[0] . $error_len);
			$global_error_flag = true;
		}
	}
}

// セッションチェック
$session_flag = false;
session_start();
if (isset($_SESSION['transmit_mail_input']) && $_SESSION['transmit_mail_input']) {
	$session_flag = true;
}


// --------------------------------------------------------------
// 表示画面判別
// --------------------------------------------------------------
if ($deny_flag) {
	// アクセス拒否
	$page === 'deny';
	
} elseif (isset($_GET['mode']) && ($_GET['mode'] === 'check')) {
	// チェックモード
	$page = 'checkmode';

} elseif (!$session_flag) {
	// セッションが無い場合 入力画面
	$page = '';

} elseif (count($_POST) > 0) {
	if ($global_error_flag) {
		// エラーがある場合 入力エラー画面
		$page = '';
	
	} elseif (isset($_POST['page']) && ($_POST['page'] === 'input') && !$global_error_flag) {
		// 再入力画面
		$page = '';
			
	} elseif (isset($_POST['page']) && ($_POST['page'] === 'finish') && !$global_error_flag) {
		// 完了画面
		$page = 'finish';
		
	} elseif (!$global_error_flag) {
		// エラーが無い場合 確認画面
		$page = 'confirm';
		
	} else {
		// 入力画面
		$page = '';
		
	}
}


// --------------------------------------------------------------
// セッションの書き込み、破棄
// --------------------------------------------------------------
if (empty($page)) {
	// 入力画面 or 入力エラー画面 の場合 セッションの書き込み
	$_SESSION['transmit_mail_input'] = true;

} elseif ($page === 'finish') {
	// 完了画面の場合 セッションを破棄
	//$_SESSION = array();
	//if (isset($_COOKIE[session_name()])) {
	//	setcookie(session_name(), '', time()-42000, DIR_MAILFORM, $_SERVER['HTTP_HOST']);
	//}
	//session_destroy();
	
}

// --------------------------------------------------------------
// 入力情報をテンプレートにセット
// --------------------------------------------------------------

if (empty($page)) {
	// 入力画面 or 入力エラー画面
	foreach ($_POST as $k => $v) {
		$tmpl->set($k, h($v));
	}
	$tmpl->set('_GET', h($_GET));
	$tmpl->set('_SERVER', h($_SERVER));
	$tmpl->set('admin_flag', $admin_flag);
	
} elseif ($page === 'confirm' || $page === 'finish') {
	// 確認画面 or 完了画面
	$params = array();
	$hiddens = array();
	foreach ($_POST as $k => $v) {
		$pattern = '/' . EXCLUSION_ITEM . '/';
		if (!preg_match($pattern, $k)) {
			if (is_array($v)) {
				$s = implode(', ', $v);
			} else {
				$s = $v;
			}
			$h = convert_input_hidden($k, $v);
			$tmpl->set("$k.key", h($k));
			$tmpl->set("$k.value", h($s));
			$tmpl->set("$k.value.nl2br", nl2br(h($s)));
			$tmpl->set("$k.hidden", $h);
			$params[] = array('key'=>h($k), 'value'=>h($s), 'value.nl2br'=>nl2br(h($s)), 'hidden'=>$h);
			$hiddens[] = $h;
			$db_value[] = h($s);
		}
	}
	$tmpl->set('params', $params);
	$tmpl->set('hiddens', implode('', $hiddens));
	$tmpl->set('_GET', h($_GET));
	$tmpl->set('_SERVER', h($_SERVER));
	$tmpl->set('admin_flag', $admin_flag);
}

// --------------------------------------------------------------
// 金額計算
// --------------------------------------------------------------
// SQL文
$sql3 = "SELECT date1,price1,price2,price3,price4,date2,price5,price6,price7,price8 FROM price ";
$sql3.= "WHERE id = '1'";
$result3 = executeQuery($sql3);
$row3 = mysql_fetch_array($result3, MYSQL_NUM);

$day1 = strtotime($row3[0]);
$thedate1 = date("Y年m月d日",$day1);
$price1 = number_format($row3[1]);
$price2 = number_format($row3[2]);
$price3 = number_format($row3[3]);
$price4 = number_format($row3[4]);
$day2 = strtotime($row3[5]);
$thedate2 = date("Y年m月d日",$day2);
$price5 = number_format($row3[6]);
$price6 = number_format($row3[7]);
$price7 = number_format($row3[8]);
$price8 = number_format($row3[9]);

$today = strtotime( "now" );

$daydiff1 = ($today - $day1)/(3600*24);

if ($daydiff1 <= 1) {
	if ($db_value[0] == "会員") {
	$value1 = $price1;
	} else {
	$value1 = $price5;
	}
} else {
	if ($db_value[0] == "会員") {
	$value1 = $price2;
	} else {
	$value1 = $price6;
	}
}

$value2 = 0;
if ($db_value[11]) {
$value2++;
}
if ($db_value[15]) {
$value2++;
}
if ($db_value[19]) {
$value2++;
}

$value3 = 0;
$value1_1 = str_replace(',','',$value1);// カンマ削除
$value3 = $value1_1 * $value2;

$value3 = number_format($value3);// カンマ追加

// --------------------------------------------------------------
// 画面表示
// --------------------------------------------------------------
if ($page === 'deny') {
	// -------------------------------------------------------
	// アクセス拒否画面
	// -------------------------------------------------------
	// エラーメッセージ
	$global_error_flag = true;
	$global_error[] = ERROR_DENY;
	
	// エラー情報をテンプレートにセット
	$tmpl->set('global_error_flag', $global_error_flag);
	$tmpl->set('global_error', $global_error);
	$tmpl->set('admin_flag', $admin_flag);
	
	// HTML書き出し
	echo $tmpl->fetch(TMPL_ERROR);
	exit();
	
	
} elseif ($page === 'checkmode') {
	// -------------------------------------------------------
	// チェックモード
	// -------------------------------------------------------
	output_checkmode();
	
} elseif ($page === 'finish') {
	// -------------------------------------------------------
	// データベースへの追加
	// -------------------------------------------------------

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
		
		$data0 = $db_value[0] ;
		$data1 = $db_value[1] ;
		$data2 = $db_value[2] ;
		$data3 = $db_value[3] ;
		$data4 = $db_value[4] ;
		$data5 = $db_value[5] ;
		$data6 = $db_value[6] ;
		$data7 = $db_value[7] ;
		$data8 = $db_value[8] ;
		$data9 = $db_value[9] ;
		$data10 = $db_value[10] ;
		$data11 = $db_value[11] ;
		$data12 = $db_value[12] ;
		$data13 = $db_value[13] ;
		$data14 = $db_value[14] ;
		$data15 = $db_value[15] ;
		$data16 = $db_value[16] ;
		$data17 = $db_value[17] ;
		$data18 = $db_value[18] ;
		$data19 = $db_value[19] ;
		$data20 = $db_value[20] ;
		$data21 = $db_value[21] ;
		$data22 = $db_value[22] ;
		$data23 = $value1_1 ;
		$data24 = $value2 ;

		//add to the database
		$result_sql = mysql_query("INSERT INTO data VALUES (NULL,NULL,'$data0','$data1','$data2','$data3','$data4','$data5','$data6','$data7','$data8','$data9','$data10','$data11','$data12','$data13','$data14','$data15','$data16','$data17','$data18','$data19','$data20','$data21','$data22','$data23','$data24',1,1,1,1,1)");
		$no = mysql_insert_id();
		if (!$result_sql) {
		die('INSERTクエリーが失敗しました。'.mysql_error());
		}
		
	// -------------------------------------------------------
	// メール送信
	// -------------------------------------------------------
	// 宛先
	$to_email = TO_EMAIL;
	
	// 件名
	$to_subject = TO_SUBJECT;
	
	// メール本文
	$tmpl->set('no', $no);
	$tmpl->set('value1', $value1);
	$tmpl->set('value2', $value2);
	$tmpl->set('value3', $value3);
	$body = $tmpl->fetch(MAIL_BODY);
	$body = hd($body);
	
	// メール送信元
	if (isset($_POST[AUTO_REPLY_EMAIL]) && !empty($_POST[AUTO_REPLY_EMAIL])) {
		$from_email = $_POST[AUTO_REPLY_EMAIL];
	} else {
		$from_email = $to_email;
	}
	
	// メール送信
	$result = send_mail($to_email, $to_subject, $body, $from_email);
	
	// 送信できなかった場合
	if (!$result) {
		// エラーメッセージ
		$global_error_flag = true;
		$global_error[] = ERROR_FAILURE_SEND_MAIL;
		// ログ出力
		$suffix = 'sendmail';
		$data = ERROR_FAILURE_SEND_MAIL .
			"\n\n" .
			"--\n\n" .
			"【宛先】\n" .
			"$to_email\n\n" .
			"【件名】\n" .
			"$to_subject\n\n" .
			"【本文】\n" .
			"$body";
		put_error_log($data, $suffix);
	}
	
	// -------------------------------------------------------
	// 自動返信メール
	// -------------------------------------------------------
	if (AUTO_REPLY) {
		// 宛先
		$to_email = $from_email;
		
		// 件名
		$to_subject = AUTO_REPLY_SUBJECT;
		if (empty($to_subject)) {
			$to_subject = TO_SUBJECT;
		}
		
		// メール本文
		$tmpl->set('no', $no);
		$body = $tmpl->fetch(MAIL_AUTO_REPLY_BODY);
		$body = hd($body);
		
		// メール送信元
		$from_email = AUTO_REPLY_FROM_EMAIL;
		if (empty($from_email)) {
			$from_email = TO_EMAIL;
		}
		
		// メール送信
		$result = send_mail($to_email, $to_subject, $body, $from_email, AUTO_REPLY_NAME);
	
		// 送信できなかった場合
		if (!$result) {
			// エラーメッセージ
			$global_error_flag = true;
			$global_error[] = ERROR_FAILURE_SEND_AUTO_REPLY;
			// ログ出力
			$suffix = 'autoreply';
			$data = ERROR_FAILURE_SEND_AUTO_REPLY .
				"\n\n" .
				"--\n\n" .
				"【宛先】\n" .
				"$to_email\n\n" .
				"【件名】\n" .
				"$to_subject\n\n" .
				"【本文】\n" .
				"$body";
			put_error_log($data, $suffix);
		}
	}
	
	// -------------------------------------------------------
	// 完了画面
	// -------------------------------------------------------
	
	// エラー判別
	if ($global_error_flag) {
		// エラーの場合
		$tmpl->set('global_error_flag', $global_error_flag);
		$tmpl->set('global_error', $global_error);
		$tmpl->set('admin_flag', $admin_flag);
		
		echo $tmpl->fetch(TMPL_ERROR);
		exit();
		
	} else {
		// 送信できた場合
		$tmpl->set('admin_flag', $admin_flag);
		
		echo $tmpl->fetch(TMPL_FINISH);
		exit();
		
	}
	
} elseif ($page === 'confirm') {
	// -------------------------------------------------------
	// 確認画面
	// -------------------------------------------------------

	$tmpl->set('admin_flag', $admin_flag);
	$tmpl->set('value1', $value1);
	$tmpl->set('value2', $value2);
	$tmpl->set('value3', $value3);
	// テンプレート書き出し
	echo $tmpl->fetch(TMPL_CONFIRM);
	exit();
	
} else {
	// -------------------------------------------------------
	// 入力画面 or 入力エラー画面
	// -------------------------------------------------------
	
	// エラー情報をテンプレートにセット
	$tmpl->set('global_error_flag', $global_error_flag);
	$tmpl->set('global_error', $global_error);
	$tmpl->set('email', $email);
	$tmpl->set('admin_flag', $admin_flag);
	// HTML書き出し
	echo $tmpl->fetch(TMPL_INPUT);
	exit();
	
}

?>
