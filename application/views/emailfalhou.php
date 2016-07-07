<?php
$atributos = array('class' => 'formlogin gradiente1 radius shadow', 'id' => 'formlogin');

echo form_open(base_url().'principal',$atributos);
    echo "<span class='validacoes'>".validation_errors()."</span>";
	echo form_fieldset('Falha ao enviar email:');
		echo br(1);
		echo "<p>Não foi possível enviar um e-mail de redefinição de senha, procure o CPD para redefinir sua senha manualmente.</p>";
		echo br(2);
		echo form_submit('btnSubmit','Voltar ao menu');
		echo br(1);
	echo form_fieldset_close(); 
echo form_close();
?>
