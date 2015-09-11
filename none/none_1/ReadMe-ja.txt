メインメニューに簡単に項目を増やすためだけにつくられたモジュールのテンプレートです。
コアに手をいれていないので、XOOPS2.0.xなら動作すると思います。
※このページの英語訳求む(笑

■インストール
　1. 
　　まず、モジュール名(フォルダ名)・メニュー名を決めてください。
　　　例
　　　　モジュール名 : aboutThisCompany 
　　　　メニュー名 : 企業情報
　2.
　　noneフォルダを1で決めたフォルダ名で複製してください。
　　以降はこの複製したフォルダを変更していきます。
　3.
　　xoops_modules.phpを変更します。
　
　　$modversion['dirname'] = "none";
　　　をモジュール名に変更します。
　　例：　$modversion['dirname'] = "aboutThisCompany";
　
　　$modversion['name'] = 'NONE モジュール';
　　　をメニュー名に変更します。
　　例：　$modversion['name'] = '企業情報';
　4.
　　さらに、乗せたいコンテンツをpage.phpに書き込んでください。
　　htmlでもphpでもOKです。<body>〜</body>の中だけを書く感じで書いてください。
　　。
　 
　5. 
　　xoops/modules/にフォルダごとアップロードしてください。
　6.
　　管理コントロールパネルに行き、システム管理 >> モジュール管理の下のほうにあるnoneモジュールをインストールしてください。
　
　※文字コードはPHPが動作する文字コード(日本語ならEUCで書いて下さい)
　
この方法でモジュール名がかぶらなければ、いくつでもインストールできます。
沢山のメニューをつくる場合はlogo.gifを分かりやすい物に変更することをお薦めします。


■連絡先
　http://xoops-modules.sourceforge.jp/
　http://sourceforge.jp/projects/xoops-modules/　
　


