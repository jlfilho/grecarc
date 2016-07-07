<div id="content">
    <?php

	$attributes = array('class' => 'formbusca', 'id' => 'formbusca');
	
    echo form_open(base_url().'cadastro/buscar',$attributes);

        $campo = array(
                'name' => 'busca',
                'id' => 'busca',
                'class' => 'autocompletepre',
                "style" => "width:70%"
           );
        echo form_input($campo);
		echo form_submit('btn_buscar','Buscar');
	
	echo form_close();
    //Fim do formulário busca
   
	echo br(3);
	
	
    echo heading("Lista de Pré-cadastro a Validar".img('assets/imgs/clit.png'),2,"class='divisor'");
    
    $array_clientes = array();
    foreach($clientes as $cliente){
        $array_clientes[] = array(
            $cliente->nomeCliente,
            $cliente->cpf,
            $cliente->email,
            date("d/m/Y H:i:s",strtotime($cliente->dataCadastro)),
            anchor(
                "cadastro/pre_validar/".$cliente->idPreCadastro, img('assets/imgs/Search.png'),
                array('onclick'=>"return confirm('Gostaria de analisar os dados deste cliente?');")
            )
        );
    }
    $this->table->set_heading('Nome','CPF','E-mail','Data Cadastro','Analisar');
    echo "<div class='wraper_table'>";
    echo $this->table->generate($array_clientes);
    echo "</div>";
?>
</div>
