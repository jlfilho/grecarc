<div id="content">
    <?php
    echo heading("Cadastrar Clientes ".img('assets/imgs/Add.png'),2,"class='divisor'");
    $attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
    echo form_open('clientes/adicionar',$attributes);
        echo "<span class='validacoes'>".validation_errors()."</span>";
        //echo form_fieldset("Dados Pessoais");
            echo form_label("*Nome:","nome");
            $atributos = array(
                "name" => "nome",
                "id" => "nome",
                "value" => set_value('nome'),
                "maxlength" => "100",
                "size" => "50",
                "style" => "width:68%"
                );
            echo form_input($atributos);
            echo br(1);
            
            echo form_label("*Vínculo:","vinculo");
            foreach($vinculos as $vinculo) {
                $array1[$vinculo->idVinculo] = $vinculo->nomeVinculo;
            }

            echo form_dropdown('vinculo',$array1, $vinculos[3]->idVinculo,'class=selectmenu style=width:69%');
            echo br(1);
            
            echo form_label("*Setor:","setor");
            foreach($setores as $setor) {
                $array2[$setor->idSetor] = $setor->nomeSetor;
            }
            echo form_dropdown('setor',$array2,$setores[2]->idSetor,'class=selectmenu style=width:69%');
                
            echo form_label("*Tipo Documento:","tdocumento");
            foreach($tipoDocumentos as $tipoDocumento) {
                $array3[$tipoDocumento->idTipoDocumento] = $tipoDocumento->nomeTipoDocumento;
            }
            echo form_dropdown('tdocumento',$array3,'CPF','class=selectmenu style=width:69%');
            
            echo form_label("*Número Documento:","numDoc");
            $atributos = array(
                            "name" => "numDoc",
                            "id" => "numDoc",
                            "autocomplete" => "off",
                            "value" => set_value('numDoc'),
                            "maxlength" => "20",
                            "size" => "20",
                            "style" => "width:20%"
                         );
            echo form_input($atributos);
            echo br(1);
            echo form_label("Telefone:","telefone");
            $atributos = array(
                            "name" => "telefone",
                            "autocomplete" => "off",
                            "id" => "telefone",
                            "value" => set_value('telefone'),
                            "maxlength" => "20",
                            "size" => "20",
                            "style" => "width:19%"
                         );
            echo form_input($atributos);
            
            echo form_label("Celular:","celular");
            $atributos = array(
                            "name" => "celular",
                            "autocomplete" => "off",
                            "id" => "celular",
                            "value" => set_value('celular'),
                            "maxlength" => "20",
                            "size" => "20",
                            "style" => "width:19%"
                         );
            echo form_input($atributos);
            
            echo form_label("*E-mail:","email");
            $atributos = array(
                            "name" => "email",
                            "id" => "email",
                            "autocomplete" => "off",
                            "value" => set_value('email'),
                            "maxlength" => "50",
                            "size" => "50",
                            "style" => "width:50%"
                         );
            echo form_input($atributos);
            echo br(1);
            echo form_label("*Rua:","rua");
            $atributos = array(
                            "name" => "rua",
                            "id" => "rua",
                            "value" => set_value('rua'),
                            "maxlength" => "30",
                            "size" => "30",
                            "style" => "width:30%"
                         );
            echo form_input($atributos);
            
            echo form_label("Número:","numero");
            $atributos = array(
                            "name" => "numero",
                            "id" => "numero",
                            "value" => set_value('numero'),
                            "maxlength" => "10",
                            "size" => "10",
                            "style" => "width:8%"
                         );
            echo form_input($atributos);
            echo br(1);
            echo form_label("Complemento:","complemento");
            $atributos = array(
                            "name" => "complemento",
                            "id" => "complemento",
                            "value" => set_value('complemento'),
                            "maxlength" => "30",
                            "size" => "30",
                            "style" => "width:30%"
                         );
            echo form_input($atributos);
            echo br(1);
            echo form_label("*Bairro:","bairro");
            $atributos = array(
                            "name" => "bairro",
                            "id" => "bairro",
                            "value" => set_value('bairro'),
                            "maxlength" => "30",
                            "size" => "30",
                            "style" => "width:30%"
                         ); 
            echo form_input($atributos);
            echo br(1);
            echo form_label("CEP:","cep");
            $atributos = array(
                            "name" => "cep",
                            "id" => "cep",
                            "value" => set_value('cep'),
                            "maxlength" => "20",
                            "size" => "20",
                            "style" => "width:20%"
                         );
            echo form_input($atributos);
            echo br(1);
            echo form_label("*Cidade:","cidade");
            foreach($cidades as $cidade) {
                $array4[$cidade->idCidade] = $cidade->nomeCidade;
            }
            echo form_dropdown('cidade',$array4,$cidades[0]->nomeCidade,'class=selectmenu style=width:69%');
            echo br(2);

            //echo form_input($btn);
            echo form_submit("btnSubmit","Adicionar");
        //echo form_fielset_close();
        
    echo form_close();
    //Fim do formulário cadastro de cliente
    //echo br(1);
	


	$attributes = array('class' => 'formbusca', 'id' => 'formbusca');
	
    echo form_open(base_url().'clientes/buscar',$attributes);
    	//echo form_label("Buscar: ","busca");
		$campo = array(
						'name' => 'busca',
						'id' => 'busca',
                        'class' => 'autocomplete',
						"style" => "width:70%"
				);
		echo form_input($campo);
		echo form_submit('btn_buscar','Buscar');
	
	echo form_close();
    //Fim do formulário busca





	echo br(3);
	
	
    echo heading("Clientes Cadastrados ".img('assets/imgs/clit.png'),2,"class='divisor'");
    
    $array_clientes = array();
    foreach($clientes as $cliente){
        $array_clientes[] = array(
             anchor(
                "clientes/editar/".$cliente->idCliente, img('assets/imgs/gear.png'),
                array('onclick'=>"return confirm('Gostaria de alterar dados deste cliente?');")
             ),
             anchor(
                "clientes/recurso/".$cliente->idCliente, 
                img('assets/imgs/rec.png'), 
                array('onclick'=>"return confirm('Gostaria de cadastrar recurso para este cliente?');")
                ),
            anchor(
                "ldap/editar/".$cliente->idCliente,
                img('assets/imgs/Key.png'),
                array('onclick'=>"return confirm('Gostaria de ativar conta Ldap para este cliente?');")
            ),
             $cliente->nomeCliente,
             $cliente->email        
        );
    }
    $this->table->set_heading('Editar','Recurso','Ldap','Nome','E-mail');
    echo "<div class='wraper_table'>";
    echo $this->table->generate($array_clientes);
    echo "</div>";
?>
</div>
