/* JavaScript by ARTEMIS [ www.artemis.ac ]  hidemaru(<script>) */
/* �O���[�o���ϐ��̓x�[�X�Ɠ���Cset�I�u�W�F�N�g�����B�V���� ID waitingbar ���g�p�B*/
Cset.addon = {
	/*�ݒ�B1 Blink�����镶�� HTML�� */
	inner:'�ǂݍ���ł��܂�'

,
	/*�ݒ�B2 Blink���O���� �\����Blink�����Ȃ����� HTML�� */
	front:'���΂炭���҂���������<br><br>'

,
	/*�ݒ�B3 Blink���㑤�� �\����Blink�����Ȃ����� HTML�� */
	rear:''

,
	/*�ݒ�B4 �X�s�[�h 1/1000�b 1000=1�b */
	delay:400


,	set:function(O){
		/* ���̊֐��Ń��b�Z�[�W���𑀍� */
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
