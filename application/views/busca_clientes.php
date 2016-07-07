<div id="content">
    <?php

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
