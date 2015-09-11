<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>医療のＴＱＭ推進協議会</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<?php
session_start();

  // エラーメッセージ
  $errorMessage = "";
  // 画面に表示するため特殊文字をエスケープする
  $viewUserId = htmlspecialchars($_POST["userid"], ENT_QUOTES);

  // ログインボタンが押された場合      
  if (isset($_POST["login"])) {

    // 認証成功
    if ($_POST["userid"] == "test" && $_POST["password"] == "test") {
      // セッションIDを新規に発行する
      session_regenerate_id(TRUE);
      $_SESSION["USERID"] = $_POST["userid"];
      header("Location: ");
      exit;
    }
    else {
      $errorMessage = "会員IDあるいはパスワードに誤りがあります。";
    }
  }

?>

<body>
<div id="container">
  <div id="container-header">
    <div id="container-name"><img src="images/logo.png" alt="" title="" border="0"></div>
  </div> <!-- container-header -->
  <div id="container-eyecatcher">
    <div id="container-navigation">
      <ul id="navigation">
        <li><a href="index.html"><img src="images/home.png" alt="" title="" border="0"></a></li>
        <li><a href="sitemap.html"><img src="images/sitemap.png" alt="" title="" border="0"></a></li>
		<li><a href="index_english.html"><img src="images/english.png" alt="" title="" border="0"></a></li>
      </ul>
    </div> <!-- container-navigation -->
    <img src="images/eyecatcher.jpg" alt="" />
  </div> <!-- container-eyecatcher -->
  <div id="container-content">
<div id="border">
<div id="menu">
<ul>
<li><a class="sample_spritemenu0" href="index.html"></a></li>

<li><a class="sample_spritemenu1" href="introduction.html"></a></li>

<li><a class="sample_spritemenu2" href="article.html"></a></li>

<li><a class="sample_spritemenu5" href="structure.html"></a></li>





<li><a class="sample_spritemenu6" href="excellence.html"></a></li>

<li><a class="sample_spritemenu7" href="purchase.html"></a></li>



<li><a class="sample_spritemenu9" href="http://www.ndpjapan.org" target="_blank"></a></li>

<br>

<li><img src="images/member_network.png" alt="" title="" border="0"></li>

<li><a class="sample_spritemenu3" href="guide.html"></a></li>

<li><a class="sample_spritemenu8" href="member.html"></a></li>


<!-- <li><a class="sample_spritemenu4" href="#"></a></li> -->

<br>

<li><img src="images/member.png" alt="" title="" border="0"></li>

<li><a class="sample_spritemenu10" href="login.php"></a></li>
</ul> 
</div> <!-- menu END -->

<br>

<a href="http://kyodokodo.jp" target="_blank"><img src="images/kyodo.png" alt="" title="" border="0"></a>
</div> <!-- border END -->

    <div id="content">
	<img src="images/title_8.png" alt="" title="" border="0">


<div id="login1">
    <div class="box_login">
		<p class="box_title">ユーザー名、パスワードを入力して「ログイン」ボタンを押してください。</p>

		<div style="margin:15px 0px 5px 0px;color:#ff0000;"><?php echo $errorMessage ?></div>

  <form id="loginForm" name="loginForm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
        <label><span>ユーザー名</span><INPUT size="25" type="text" name="userid" style="width: 150px;"></label>
        <label><span>パスワード</span><input type="password" size="25" name="password" style="width: 150px;"></label>
        <div class="spacer"><input type="submit" name="login" value="" style="background:url('images/btn_login.png');width:140px;height:40px;border:0px solid;cursor:pointer;margin:15px 0px 5px 0px;" /></div>

</form>	

</div> <!-- CONTENT END -->

</div> <!-- container-content -->



</div> <!-- END container -->



<!--フッターを幅いっぱいにする為のボックス -->
<div id="footerbg">
<!--フッター -->
<div id="footer">
	<div id="footer-address">
一般社団法人 医療のＴＱＭ推進協議会 事務局<br>
〒584-0032 大阪府冨田林市常盤町3-17 リベルテタナカ301号<br>
TEL:0721-20-4535&nbsp;&nbsp;FAX:0721-20-4536<br>
E-mail:secretariat@tqmh.net<br>
	</div>
<div id="footer-copyright">
Copyright &copy; 2012 TQM Health Promotion Council.All right reserved.</div>
</div>

<!--フッター終わり -->
</div>
<!--フッターを幅いっぱいにする為のボックス終わり -->



</body>
</html>
