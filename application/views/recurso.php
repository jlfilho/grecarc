<div id="content">
    <?php
    echo heading("Dados do Cliente ".img('assets/imgs/clit.png'),2,"class='divisor'");
    $attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
    echo form_open('clientes/',$attributes);

            echo form_hidden("idCliente",$clientes[0]->idCliente);            
			echo heading($clientes[0]->nomeCliente,3);	
            
            foreach($tipoDocumento as $tipoDocumento) {
                $array3[$tipoDocumento->idTipoDocumento] = $tipoDocumento->nomeTipoDocumento;
                if($clientes[0]->idTipoDocumento == $tipoDocumento->idTipoDocumento){
                    $tipoDoc = $tipoDocumento->nomeTipoDocumento;
                }
                    
            }
            		
			echo ("Documento: ".$tipoDoc." - nº. ".$clientes[0]->numDoc);			 
            echo br(1);
            
			echo ("E-mail: ".$clientes[0]->email);			 
    echo form_close();
	
	//Fim do formulário
	
	echo heading("Cadastrar Recurso ".img('assets/imgs/Add.png'),2,"class='divisor'");
	
	$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
    echo form_open('clientes/adicionar_recurso/'.$clientes[0]->idCliente,$attributes);
        echo "<span class='validacoes'>".validation_errors()."</span>";
        //echo form_fieldset("Dados Pessoais");
                                       
            echo form_label("Tipo de Recurso*:","trecurso");
            foreach($tipoRecursos as $tipoRecurso) {
                $array1[$tipoRecurso->idTipoRecurso] = $tipoRecurso->nomeTipoRecurso;
            }
            echo form_dropdown('trecurso',$array1,$tipoRecursos[4]->idTipoRecurso,'class=selectmenu style=width:69%');
            
            echo form_label("Mac Address*:","macRecurso");
            $atributos = array(
                            "name" => "macRecurso",
                            "id" => "macRecurso",
                            "value" => set_value('macRecurso'),
                            "maxlength" => "20",
                            "size" => "20",
                            "style" => "width:20%",
                         );
            echo form_input($atributos);
            echo nbs(4)."Ex.: 00:00:00:00:00:00";
            echo br(1);
			
			echo form_label("IP Lógico:","ipRecurso");
            $atributos = array(
                            "name" => "ipRecurso",
                            "id" => "ipRecurso",
                            "value" => set_value('ipRecurso'),
                            "maxlength" => "20",
                            "size" => "20",
                            "style" => "width:20%",
                         );
            echo form_input($atributos);
            echo br(1);
			
			echo form_label("Observação:","descricaoRecurso");
            $atributos = array(
                            "name" => "descricaoRecurso",
                            "id" => "descricaoRecurso",
                            "value" => set_value('descricaoRecurso'),
                            "maxlength" => "50",
                            "size" => "50",
                            "style" => "width:50%",
                         );
            echo form_input($atributos);
            echo br(1);
            
			//echo form_label("É recurso de setor? ","setorRecurso");
			echo form_checkbox('setorRecurso', '1', FALSE);
			echo "É recurso de setor?";  
			
			echo br(1);
			//echo form_label("Bloquear","bloqueado");
			echo form_checkbox('bloqueado', '1', FALSE);
            echo "Bloquear este recurso.";
            
			$btn = array(
    			'name' => "btnSubmit",
    			'value' => "Alterar",
    			'type' => "image",
    			'src' => "assets/imgs/Load.png"    			
    		);
			echo br(2);
            //echo form_submit($btn);
            echo form_submit("btnSubmit","Adicionar");

            echo br(2);
            echo    anchor(base_url('clientes/buscar'),'Voltar');
    echo form_close();
	
	
    //Fim do formulário
    echo heading("Recursos Cadastrados ".img('assets/imgs/rec.png'),2,"class='divisor'");
    
    $array_recursos = array();
    foreach($recursos as $recurso){
    	foreach($tipoRecursos as $tipoRecurso) {
                $array3[$tipoRecurso->idTipoRecurso] = $tipoRecurso->nomeTipoRecurso;
                if($recurso->idTipoRecurso == $tipoRecurso->idTipoRecurso){
                    $tipoRec = $tipoRecurso->nomeTipoRecurso;
                }
                    
            }
        $array_recursos[] = array(
            anchor(
                "clientes/excluir_recurso/".$recurso->idRecurso."/".$clientes[0]->idCliente, 
                img('assets/imgs/xis.png'), 
                array('onclick'=>"return confirm('Confirma a exclusão deste recurso?');")
                ),   
             anchor(
                "clientes/editar_recurso/".$recurso->idRecurso."/".$clientes[0]->idCliente, img('assets/imgs/gear.png'),
                array('onclick'=>"return confirm('Confirma a alteração deste recurso?');")
             ),
             $tipoRec,
             $recurso->macRecurso,
             $recurso->ipRecurso,
             $recurso->descricaoRecurso        
        );
    }
    $this->table->set_heading('Excluir','Editar','Tipo do Recurso','MAC Address','IP','Observação');
    echo "<div class='wraper_table'>";
    echo $this->table->generate($array_recursos);
    echo "</div>";
	
?>
</div>