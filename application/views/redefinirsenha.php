<?php
$atributos = array('class' => 'formlogin gradiente1 radius shadow', 'id' => 'formlogin');

echo form_open(base_url().'redefinirsenha/redefinir',$atributos);
    echo "<span class='validacoes'>".validation_errors()."</span>";
	echo br(3);
	echo form_fieldset('Redefinir senha ldap');
		echo br(2);
		echo form_label('Informe seu nome de usuário:', 'usuario');
		echo form_input('usuario');
		echo br(2);
		echo form_submit('btnSubmit','Continuar');
		echo br(2);
	echo form_fieldset_close(); 
echo form_close();
?>
