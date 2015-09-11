/* JavaScript by ARTEMIS [ www.artemis.ac ]  hidemaru(<script>) */
/* グローバル変数はベースと同じCsetオブジェクトだけ。新たに ID waitingbar を使用。*/
Cset.addon = {
	/*設定B1 Blinkさせる文字 HTML可 */
	inner:'読み込んでいます'

,
	/*設定B2 Blinkより前側に 表示しBlinkさせない文字 HTML可 */
	front:'しばらくお待ちください<br><br>'

,
	/*設定B3 Blinkより後側に 表示しBlinkさせない文字 HTML可 */
	rear:''

,
	/*設定B4 スピード 1/1000秒 1000=1秒 */
	delay:400


,	set:function(O){
		/* この関数でメッセージ内を操作 */
		if( Cset.by('Loadouter') && Cset.by('Loadmsg') ){
			Cset.by('Loadmsg').innerHTML = O.front + '<div id="waitingbar" style="font-size:15px;height:25px">' + O.inner + '</div>' + O.rear;
			O.repeat = 0; tmp = 0;
			var DoRepeat = function(){
				O.repeat++;
				if(Cset.by('waitingbar')){ if(Cset.by('waitingbar').innerHTML == ''){ Cset.by('waitingbar').innerHTML = O.inner; }else{ Cset.by('waitingbar').innerHTML = ''; } }
				if(Cset.by('Loadouter').style.display != 'none'){ setTimeout(DoRepeat, O.delay); }
			};DoRepeat();
		}
	}
};Cset.addon.set(Cset.addon);
