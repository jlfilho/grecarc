<?php
$this->load->helper('date');
date_default_timezone_set('America/Manaus');
$agora = mdate('%Y-%m-%d',strtotime("now"));
if(($cliente[0]->dataExpiracao > $agora) && ($cliente[0]->ativo == 1)){
	$atributos = array('class' => 'formlogin gradiente1 radius shadow', 'id' => 'formlogin');

	echo form_open(base_url().'redefinirsenha/enviar_email',$atributos);
	echo "<span class='validacoes'>".validation_errors()."</span>";
	echo form_fieldset('Confirmar email');
	echo br(2);
	echo form_hidden("usuario",$cliente[0]->usuario);
	echo form_hidden("email",$cliente[0]->email);
	echo "<p>Seu e-mail cadastrado na base de dados é:</p>";
	echo "<b>".$cliente[0]->email."</b>";
	echo "<p>Deseja enviar um e-mail para redefinir sua senha?</p>";
	echo br(2);
	echo form_submit('btnSubmit','Enviar');
	echo br(1);
	echo form_fieldset_close();
	echo form_close();
}else{
	$atributos = array('class' => 'formlogin gradiente1 radius shadow', 'id' => 'formlogin');

	echo form_open(base_url('principal'),$atributos);
	echo "<span class='validacoes'>".validation_errors()."</span>";
	echo br(3);
	echo form_fieldset('Conta Inativa:');

	echo '<p>Este usuário está inativo ou sua data de expiração venceu. Dirija-se ao CPD para resolver sua situação.</p>';
	echo br(2);
	echo form_submit('btnSubmit','Voltar ao Menu');
	echo br(1);
	echo form_fieldset_close();
	echo form_close();
}

?>
