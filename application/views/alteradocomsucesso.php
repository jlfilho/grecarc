<?php
$atributos = array('class' => 'formlogin gradiente1 radius shadow', 'id' => 'formlogin');

echo form_open(base_url('principal'),$atributos);
    echo "<span class='validacoes'>".validation_errors()."</span>";
	echo br(3);
	echo form_fieldset('Alteração com sucesso:');
		echo br(1);
		echo "<p>Parabéns sua senha foi redefinida com sucesso!</p>";
		echo br(2);
		echo form_submit('btnSubmit','Voltar ao Menu');
		echo br(1);
	echo form_fieldset_close(); 
echo form_close();
?>
