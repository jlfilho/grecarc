<div id="content">
    <?php
    echo heading("Dados do Cliente ".img('assets/imgs/clit.png'),2,"class='divisor'");
    $attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
    echo form_open('Dados do Cliente',$attributes);

            echo form_hidden("idCliente",$clientes[0]->idCliente);            
			echo heading($clientes[0]->nomeCliente,3);	

			echo ("Documento: ".$clientes[0]->nomeTipoDocumento." - nº. ".$clientes[0]->numDoc);
            echo br(1);
            
			echo ("E-mail: ".$clientes[0]->email);			 
    echo form_close();
	
	//Fim do formulário
	
	echo heading("Cadastrar Conta no Ldap ".img('assets/imgs/Key.png'),2,"class='divisor'");
	
	$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
    echo form_open('cadastro/adicionar',$attributes);
        echo "<span class='validacoes'>".validation_errors()."</span>";
        
            echo form_hidden("idCliente",$clientes[0]->idCliente);

            echo form_label("*Usuário:","usuario");

            $atributos = array(
                "name" => "usuario",
                "id" => "usuario",
                "value" => $usuario,
                "maxlength" => "20",
                "size" => "20",
                "style" => "width:20%",
            );
            echo form_input($atributos);
            echo br(1);
            
            echo form_label("*Senha:","senha");
            $atributos = array(
                            "name" => "senha",
                            "id" => "senha",
                            "value" => $senha,
                            "maxlength" => "20",
                            "size" => "20",
                            "style" => "width:20%",
                            "readonly" => true
                         );
            echo form_password($atributos);

            echo br(1);


			echo form_label("*Data Expiração:","dataExpiracao");
            $atributos = array(
                            "name" => "dataExpiracao",
                            "id" => "dataExpiracao",
                            "maxlength" => "20",
                            "size" => "20",
                            "value" => set_value('dataExpiracao'),
                            "style" => "width:20%",
                         );
            echo form_input($atributos);
            echo nbs(4)."Ex.: dd/mm/aaaa";
            echo br(2);

			echo form_checkbox('ativo', '1', false);
			echo "Conta Ativa";

            echo nbs(10);

            echo form_checkbox('ativarPagWeb', '1', false);
            echo "Ativar Página Web (Apenas professor)";
			
			echo br(2);
            //echo form_submit($btn);
            echo form_submit("btnSubmit","Cadastrar");

            echo br(2);

    echo form_close();
    //Fim do formulário
	
?>
</div>