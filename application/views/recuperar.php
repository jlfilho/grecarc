<?php
$atributos = array('class' => 'formlogin gradiente1 radius shadow', 'id' => 'formlogin');

echo form_open(base_url('redefinirsenha/salvar_alteracao/'),$atributos);
    echo "<span class='validacoes'>".validation_errors()."</span>";

	echo form_fieldset('Redefinir senha ldap');
		echo br(2);

		echo form_hidden("usuario",$usuario);
		echo form_hidden("link",$link);

		echo form_label("*Nova Senha:","senha1");
		$atributos = array(
			"name" => "senha1",
			"id" => "senha1",
			"value" => set_value('senha1'),
			"maxlength" => "20",
			"size" => "20",
			"style" => "width:50%",
		);
		echo br(1);
		echo form_password($atributos);
		echo br(1);

		echo form_label("*Confirmação de Senha:","confsenha");
		$atributos = array(
			"name" => "confsenha",
			"id" => "confsenha",
			"maxlength" => "20",
			"value" => set_value('confsenha'),
			"size" => "20",
			"style" => "width:50%",
		);
		echo br(1);
		echo form_password($atributos);

		echo br(2);
		echo form_submit('btnSubmit','Alterar');
		echo br(2);
	echo form_fieldset_close(); 
echo form_close();
?>
