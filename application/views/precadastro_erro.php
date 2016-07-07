<?php
$atributos = array('class' => 'formlogin gradiente1 radius shadow', 'id' => 'formlogin');

echo form_open(base_url('principal'),$atributos);
	echo br(3);
	echo form_fieldset('Erro ao enviar o pré-cadastro:');
		echo br(1);
		echo "<p>Ocorreu um erro ao enviar o pré-cadastro. Tente efetuar o cadastro novamente, caso o erro persista entre em contato com a equipe do CPD. </p>";
		echo br(2);
		echo form_submit('btnSubmit','Voltar ao Menu');
		echo br(1);
	echo form_fieldset_close(); 
echo form_close();
?>
