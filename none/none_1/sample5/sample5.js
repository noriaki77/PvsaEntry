/* JavaScript by ARTEMIS [ www.artemis.ac ]  hidemaru<script>*/

var Cset = {
	/*�ݒ�1 �\���g����HTML(������摜�^�O��) �����\���T�u�X�N���v�g(�A�h�I��)���g���ꍇ�͋�� */
	Inn:'<img src="./gear1.gif" border=0><br>���[�h���Ă��܂�....'

,
	/*�ݒ�2 �u���E�UTOP����̕\���ʒu �P��px�� [���l�^] */
	Top:150

,
	/*�ݒ�3 ���[�h���̃y�[�W���e�̕\������H 0:�\�� 1:��\�� [���l�^] */
	Disp:1

,
	/*�ݒ�4 �X�N���[���ɑΉ������ď������\���𓮂����H 0:�������Ȃ� 1:������ [���l�^] */
	Scroll:1

,
	/*�ݒ�5 �I�}�P �킴�Ƃ炵�������\�� 1 = 1/1000�b 0��0�b [���l�^] */
	delay:3000

,	by:function(id){ if(document.getElementById){ return document.getElementById(id); }; if(document.all){ return document.all(id); }}
,	set:function(O){
		if(!self.attachEvent && !self.addEventListener){ return false; }
		var wimg = new Image(); if(O.Disp){ O.Scroll = 0; }; if(O.Inn == ''){ O.Inn = '.';/*NN7�΍�*/ };
		document.write('<div id="Loadouter" style="top:', O.Top, 'px;"><table id="Loadinner""><tr><td id="Loadmsg">', O.Inn, '</td></tr></table></div>');
		if(O.Disp){ document.write('<style type="text/css">#inbody { display:none; }</style>'); }
		var addEv = function(obj, type, func){ if(obj.addEventListener){ obj.addEventListener(type, func, false); }else{ if(obj.attachEvent) return obj.attachEvent('on' + type, func); }}, remEv = function(obj, type, func){ if(obj.removeEventListener){ obj.removeEventListener(type, func, false); }else{ if(obj.detachEvent) obj.detachEvent('on' + type, func); }};
		if(O.Scroll){ addEv(window,'scroll', function(){ var CurrentTop = (document.body.scrollTop || document.documentElement.scrollTop); O.by('Loadouter').style.top = CurrentTop + O.Top + 'px'; }); };
		addEv(window, 'load', function(){ setTimeout( function(){ O.by('Loadouter').style.display = 'none'; if(O.by('inbody')){ O.by('inbody').style.display = 'block' }; remEv(window,'scroll', scroll); }, O.delay); });
	}
};Cset.set(Cset);
