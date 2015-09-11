/* JavaScript by ARTEMIS [ www.artemis.ac ]  hidemaru<script>*/

var Cset = {
	/*設定1 表示枠内のHTML(文字や画像タグ等) 文字表示サブスクリプト(アドオン)を使う場合は空に */
	Inn:'<img src="./gear1.gif" border=0><br>ロードしています....'

,
	/*設定2 ブラウザTOPからの表示位置 単位pxで [数値型] */
	Top:150

,
	/*設定3 ロード中のページ内容の表示する？ 0:表示 1:非表示 [数値型] */
	Disp:1

,
	/*設定4 スクロールに対応させて処理中表示を動かす？ 0:動かさない 1:動かす [数値型] */
	Scroll:1

,
	/*設定5 オマケ わざとらしく少し表示 1 = 1/1000秒 0で0秒 [数値型] */
	delay:3000

,	by:function(id){ if(document.getElementById){ return document.getElementById(id); }; if(document.all){ return document.all(id); }}
,	set:function(O){
		if(!self.attachEvent && !self.addEventListener){ return false; }
		var wimg = new Image(); if(O.Disp){ O.Scroll = 0; }; if(O.Inn == ''){ O.Inn = '.';/*NN7対策*/ };
		document.write('<div id="Loadouter" style="top:', O.Top, 'px;"><table id="Loadinner""><tr><td id="Loadmsg">', O.Inn, '</td></tr></table></div>');
		if(O.Disp){ document.write('<style type="text/css">#inbody { display:none; }</style>'); }
		var addEv = function(obj, type, func){ if(obj.addEventListener){ obj.addEventListener(type, func, false); }else{ if(obj.attachEvent) return obj.attachEvent('on' + type, func); }}, remEv = function(obj, type, func){ if(obj.removeEventListener){ obj.removeEventListener(type, func, false); }else{ if(obj.detachEvent) obj.detachEvent('on' + type, func); }};
		if(O.Scroll){ addEv(window,'scroll', function(){ var CurrentTop = (document.body.scrollTop || document.documentElement.scrollTop); O.by('Loadouter').style.top = CurrentTop + O.Top + 'px'; }); };
		addEv(window, 'load', function(){ setTimeout( function(){ O.by('Loadouter').style.display = 'none'; if(O.by('inbody')){ O.by('inbody').style.display = 'block' }; remEv(window,'scroll', scroll); }, O.delay); });
	}
};Cset.set(Cset);
