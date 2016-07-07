<?php
$atributos = array('class' => 'formlogin gradiente1 radius shadow', 'id' => 'formlogin');

echo form_open(base_url().'principal',$atributos);
    echo "<span class='validacoes'>".validation_errors()."</span>";
	echo form_fieldset('Email enviado com sucesso:');
		echo br(1);
		echo form_hidden("email",$email);
		echo "<p>Foi enviado um e-mail para <b>".$email."</b> com as instruções para redefinir sua senha.
				Se você não recebe-lo nos próximos 5 minutos, verifique atentamente sua caixa de Spam.
				Alguns servidores de e-mail podem classificar esta mensagem como Spam e bloqueá-la.
				</p>";

		echo br(2);
		echo form_submit('btnSubmit','Voltar ao menu');
		echo br(1);
	echo form_fieldset_close(); 
echo form_close();
?>
