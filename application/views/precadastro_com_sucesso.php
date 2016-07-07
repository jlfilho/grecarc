<?php
$atributos = array('class' => 'formlogin gradiente1 radius shadow', 'id' => 'formlogin');

echo form_open(base_url('principal'),$atributos);
	echo br(3);
	echo form_fieldset('Pré-cadastro enviado com sucesso:');
		echo br(1);
		echo "<p>Seu pré-cadastro foi enviado com sucesso. Será analisado o comprovante de vínculo com a instituição, tão logo validado você
 receberá uma confirmação por e-mail, onde constará usuário e senha para acesso a rede do ICET.</p>";
		echo br(2);
		echo form_submit('btnSubmit','Voltar ao Menu');
		echo br(1);
	echo form_fieldset_close(); 
echo form_close();
?>
