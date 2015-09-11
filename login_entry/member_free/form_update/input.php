<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-style-type" content="text/css" />
<meta http-equiv="content-script-type" content="text/javascript" />
<title>TransmitMail サンプル</title>
<!--<meta name="keywords" content="" />
<meta name="description" content="" />-->
<meta name="copyright" content="Copyright (c) dounokouno. All rights reserved." />
<!--<link rel="stylesheet" type="text/css" href="css/screen.css" media="screen,print" />-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="jquery.zip2addr.js"></script>
<script src="http://ajaxzip3.googlecode.com/svn/trunk/ajaxzip3/ajaxzip3.js" charset="UTF-8"></script>
<link rel="stylesheet" href="../../../css/styles-site.css" type="text/css" />
</head>
<body class="home">

<?php
require_once("../../session.php");

// データベースに接続する
require("../../db.php");
$sql = "SELECT email FROM users "; // SQL文
$sql.= "WHERE username = '" . $LoginId . "'";
$result = executeQuery($sql);
$row = mysql_fetch_assoc($result);

// 管理ユーザ判定
$sql2 = "SELECT email FROM users_admin "; // SQL文
$sql2.= "WHERE username = '" . $LoginId . "'";
$result2 = executeQuery($sql2);
if (mysql_num_rows($result2)){
	$admin_flag = true;
	}else{
	$admin_flag = false;
}

$d1 = 1;
?>


<div id="container"><!--"container"を削除するとデザインが崩れます-->

<!--ヘッダーここから-->
<h1>ホームページ テンプレート #001_blue 見出しタグ&lt;h1&gt;を使用</h1>
<div id="header"><img src="../../../images/rogo.png" width="257" height="100" /></div>
<!--ヘッダーここまで-->

<!--ヘッダーメニューここから-->
<div id="menu">
<ul>
<li class="home"><a href="#1">TOP</a></li>
<li><a href="#2">MAIL</a></li>
<li><a href="#3">LINKS</a></li>
<li><a href="#4">メニューはテキストの変更、数の増減が可能です</a></li>
</ul>
</div>
<!--ヘッダーメニューここまで-->

<!--メインここから-->
<div id="main">

<!--<img src="images/648.gif" width="648" height="300" />-->

<!--パンくずリストここから-->
<div class="pan"><a href="../index.php">トップ</a></div>
<!--パンくずリストここまで-->

<div class="category">
<h2 class="heading2">タイトル</h2>
<div class="entry_body">

<!--form-->
<div id="content">
	<div class="container">

		<!-- mailform -->
		<div class="section">
			<p>下記項目のご入力をお願いいたします。<br />
入力が終わりましたら「入力内容を確認する」ボタンを押してください。<br />
			<span class="red">*</span>は入力必須項目です。</p>
			{if:$global_error_flag}
			<p><em>入力内容に誤りがあります。</em></p>
			<ul><font color="red">
				{loop:$global_error}
				<li><em>{$global_error[]}</em></li>
				{/loop:$global_error}
			</font></ul>
			{/if:$global_error_flag}
			<form method="post" action="index.php?LoginId={$_GET.LoginId}&email={$_GET.email}">
				<div class="section">
					<center>
					<table width="100%">
						<tr>
							<th width="30%">ユーザID<span class="red">*</span></th>
							<td>
								<input type="text" name="ユーザID" value="{$_GET.LoginId}" class="middle" size="40" />
								<input type="hidden" name="required[]" value="ユーザID" />
								{if:$required.入力必須}
								<div class="error"><em>{$required.入力必須}</em></div>
								{/if:$required.入力必須}
							</td>
						</tr>
						<tr>
							<th>メールアドレス<span class="red">*</span></th>
							<td>
								<input type="text" name="メールアドレス" value="{$_GET.email}" class="middle" size="40" />
								<input type="hidden" name="required[]" value="メールアドレス" />
								{if:$required.入力必須}
								<div class="error"><em>{$required.入力必須}</em></div>
								{/if:$required.入力必須}
							</td>
						</tr>
						<tr>
							<th>お名前（漢字）<span class="red">*</span></th>
							<td>
								姓<input type="text" size="12" name="お名前（姓）" value="<?php echo $d1; ?>" class="middle" />
								<input type="hidden" name="required[]" value="お名前（姓）" />
								{if:$required.入力必須}
								<div class="error"><em>{$required.入力必須}</em></div>
								{/if:$required.入力必須}
								名<input type="text" size="12" name="お名前（名）" value="{$お名前（名）}" class="middle" />（例：山田　太郎）
								<input type="hidden" name="required[]" value="お名前（名）" />
								{if:$required.入力必須}
								<div class="error"><em>{$required.入力必須}</em></div>
								{/if:$required.入力必須}
							</td>
						</tr>
						<tr>
							<th>お名前（全角カナ）<span class="red">*</span></th>
							<td>
								姓<input type="text" size="12" name="お名前（セイ）" value="{$お名前（セイ）}" class="middle" />
								<input type="hidden" name="required[]" value="お名前（セイ）" />
								{if:$required.入力必須}
								<div class="error"><em>{$required.入力必須}</em></div>
								{/if:$required.入力必須}
								<input type="hidden" name="zenkaku_katakana[]" value="お名前（セイ）" />
								{if:$zenkaku_katakana.全角カタカナ}
								{$zenkaku_katakana.全角カタカナ}
								{/if:$zenkaku_katakana.全角カタカナ}
								名<input type="text" size="12" name="お名前（メイ）" value="{$お名前（メイ）}" class="middle" />（例：ヤマダ　タロウ）
								<input type="hidden" name="required[]" value="お名前（メイ）" />
								{if:$required.入力必須}
								<div class="error"><em>{$required.入力必須}</em></div>
								{/if:$required.入力必須}
								<input type="hidden" name="zenkaku_katakana[]" value="お名前（メイ）" />
								{if:$zenkaku_katakana.全角カタカナ}
								{$zenkaku_katakana.全角カタカナ}
								{/if:$zenkaku_katakana.全角カタカナ}
							</td>
						</tr>
						<tr>
							<th>郵便番号（半角数字）<span class="red">*</span></th>
							<td>
								<input type="text" name="郵便番号" size="10" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','都道府県','以降の住所');" value="{$郵便番号}" class="middle" />（例：1001111）
								<input type="hidden" name="required[]" value="郵便番号" />
								{if:$required.入力必須}
								<div class="error"><em>{$required.入力必須}</em></div>
								{/if:$required.入力必須}
								<input type="hidden" name="num[]" value="郵便番号" />
								{if:$num.半角数字}
								{$num.半角数字}
								{/if:$num.半角数字}
<br />
								<div class="t1"><span class="red">※郵便番号を半角数字7桁でご入力ください。都道府県と以降の住所がを自動で入力されます。</span></div>
							</td>
						</tr>
						<tr>
							<th>都道府県<span class="red">*</span></th>
							<td>
								<input type="text" name="都道府県" size="20" value="{$都道府県}" class="middle" />
								<input type="hidden" name="required[]" value="都道府県" />
								{if:$required.入力必須}
								<div class="error"><em>{$required.入力必須}</em></div>
								{/if:$required.入力必須}
							</td>
						</tr>
						<tr>
							<th>以降の住所<span class="red">*</span></th>
							<td>
								<input type="text" name="以降の住所" size="70" value="{$以降の住所}" class="middle" />
								<input type="hidden" name="required[]" value="以降の住所" />
								{if:$required.入力必須}
								<div class="error"><em>{$required.入力必須}</em></div>
								{/if:$required.入力必須}
								<br />
								<div class="t1"><span class="red">※番地・マンション名など入力してください。</span></div>
							</td>
						</tr>
						<tr>
							<th>電話番号（半角数字）<span class="red">*</span></th>
							<td>
								<input type="text" name="電話番号" value="{$電話番号}" class="middle" />（例:0355551234）
								<input type="hidden" name="required[]" value="電話番号" />
								{if:$required.入力必須}
								<div class="error"><em>{$required.入力必須}</em></div>
								{/if:$required.入力必須}
								<input type="hidden" name="num[]" value="電話番号" />
								{if:$num.半角数字}
								{$num.半角数字}
								{/if:$num.半角数字}
							</td>
						</tr>
						<tr>
							<th>選択（ラジオボタン）</th>
							<td>
								<input type="radio" name="選択（ラジオボタン）" value="項目1" id="radio1" {$checked.選択（ラジオボタン）.項目1} {$checked.default} />
								<label for="radio1">項目1</label>
								&nbsp;
								<input type="radio" name="選択（ラジオボタン）" value="項目2" id="radio2" {$checked.選択（ラジオボタン）.項目2} />
								<label for="radio2">項目2</label>
								&nbsp;
								<input type="radio" name="選択（ラジオボタン）" value="項目3" id="radio3" {$checked.選択（ラジオボタン）.項目3} />
								<label for="radio3">項目3</label>
							</td>
						</tr>
						<tr>
							<th>選択（チェックボックス）</th>
							<td>
								<input type="checkbox" name="選択（チェックボックス）[]" value="項目1" id="checkbox1" {$checked.選択（チェックボックス）.項目1} {$checked.default} />
								<label for="checkbox1">項目1</label>
								&nbsp;
								<input type="checkbox" name="選択（チェックボックス）[]" value="項目2" id="checkbox2" {$checked.選択（チェックボックス）.項目2} />
								<label for="checkbox2">項目2</label>
								&nbsp;
								<input type="checkbox" name="選択（チェックボックス）[]" value="項目3" id="checkbox3" {$checked.選択（チェックボックス）.項目3} />
								<label for="checkbox3">項目3</label>
							</td>
						</tr>
						<tr>
							<th>選択（セレクトメニュー）</th>
							<td>
								<select name="選択（セレクトメニュー）">
									<option value="項目1" {$selected.選択（セレクトメニュー）.項目1}>項目1</option>
									<option value="項目2" {$selected.選択（セレクトメニュー）.項目2}>項目2</option>
									<option value="項目3" {$selected.選択（セレクトメニュー）.項目3}>項目3</option>
								</select>
							</td>
						</tr>
					</table>
					
					<table width="100%">
						<tr>
							<th width="30%">参加者１（お名前）</th>
							<td>
								姓　<input type="text" size="12" name="参加者１：お名前（姓）" value="{$参加者１：お名前（姓）}" class="middle" />
								名　<input type="text" size="12" name="参加者１：お名前（名）" value="{$参加者１：お名前（名）}" class="middle" />（例：山田　太郎）</div>
<br />
								セイ<input type="text" size="12" name="参加者１：お名前（セイ）" value="{$参加者１：お名前（セイ）}" class="middle" />
								メイ<input type="text" size="12" name="参加者１：お名前（メイ）" value="{$参加者１：お名前（メイ）}" class="middle" />（例：ヤマダ　タロウ）</div>
							</td>
						</tr>
						<tr>
							<th width="30%">参加者２（お名前）</th>
							<td>
								姓　<input type="text" size="12" name="参加者２：お名前（姓）" value="{$参加者２：お名前（姓）}" class="middle" />
								名　<input type="text" size="12" name="参加者２：お名前（名）" value="{$参加者２：お名前（名）}" class="middle" /></div>
<br />
								セイ<input type="text" size="12" name="参加者２：お名前（セイ）" value="{$参加者２：お名前（セイ）}" class="middle" />
								メイ<input type="text" size="12" name="参加者２：お名前（メイ）" value="{$参加者２：お名前（メイ）}" class="middle" /></div>
							</td>
						</tr>
						<tr>
							<th width="30%">参加者３（お名前）</th>
							<td>
								姓　<input type="text" size="12" name="参加者３：お名前（姓）" value="{$参加者３：お名前（姓）}" class="middle" />
								名　<input type="text" size="12" name="参加者３：お名前（名）" value="{$参加者３：お名前（名）}" class="middle" /></div>
<br />
								セイ<input type="text" size="12" name="参加者３：お名前（セイ）" value="{$参加者３：お名前（セイ）}" class="middle" />
								メイ<input type="text" size="12" name="参加者３：お名前（メイ）" value="{$参加者３：お名前（メイ）}" class="middle" /></div>
							</td>
						</tr>
					</table>					
					
					
					</center>
				</div>
<script>
$('#zip').zip2addr('#addr')
</script>
				<center>
				<div><input type="submit" value="入力内容を確認する" /></div>
				</center>
			</form>
			<br />
		</div>
		<!-- /mailform -->
	</div>
</div>
<!--form-->

</div>
</div>
</div>
<!--メインここまで-->

<!--[if !IE]>サイドメニューここから<![endif]-->
<div id="sub">
<div class="category">
<div class="entry_body">
	
<p>ようこそ！ <?= $LoginId ?> さん</p>
<p><form>
	<input type="button" value="ログアウト" onClick="location.href='../../logout.php'">
</form></p>
</div>
</div>

<div class="category">
<h3 class="accordion_head">メニューリスト</h3>
<ul>
<li><a href="index.php?LoginId={$_GET.LoginId}&email={$_GET.email}">登録フォーム</a></li>
<li><a href="#4">カテゴリ002</a></li>
<li><a href="#4">カテゴリ003</a></li>
</ul>
</div>

<?php if ($admin_flag == true): ?>
<div class="category">
<h3 class="accordion_head">管理者メニュー</h3>
<ul>
<li><a href="../admin_user.php">ユーザ管理</a></li>
<li><a href="../admin_news.php">新着情報管理</a></li>
<li><a href="../admin_mail.php">メール通知管理</a></li>
<li><a href="../admin_regi.php">登録受付管理</a></li>
</ul>
</div>
<?php endif; ?>

</div>
<!--[if !IE]>サイドメニューここまで<![endif]-->

<div style="clear:both;"></div><!--デザインが崩れるので削除しない事-->

<!--フッターここから-->
<div id="footer">
<p>Copyright(C) ホームページ名 All Rights Reserved.</p>
</div>
<!--フッターここまで-->

</div><!--"container"-->

</body>
</html>
