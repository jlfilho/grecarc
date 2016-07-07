<?php
$atributos = array('class' => 'formlogin gradiente1 radius shadow', 'id' => 'formlogin');

echo form_open(base_url().'principal',$atributos);
    echo "<span class='validacoes'>".validation_errors()."</span>";
	echo br(2);
	echo form_fieldset('Solicitação Expirada:');
		echo br(1);
		echo "<p>Desculpe este link expirou ou já foi utilizado, faça uma nova solicitação.
			  </p>";

		echo br(2);
		echo form_submit('btnSubmit','Voltar para o menu');
		echo br(1);
	echo form_fieldset_close(); 
echo form_close();
?>
