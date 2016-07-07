<div id="content">
    <?php
    echo heading("Dados do Cliente ".img('assets/imgs/clit.png'),2,"class='divisor'");
    $attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
    echo form_open('clientes/',$attributes);

            echo form_hidden("idCliente",$clientes[0]->idCliente);            
			echo heading($clientes[0]->nomeCliente,3);	
            
            foreach($tipoDocumentos as $tipoDocumento) {
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
	
	echo heading("Alterar Recurso ".img('assets/imgs/Add.png'),2,"class='divisor'");
	
	$attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
    echo form_open('clientes/salvar_alteracao_recurso/',$attributes);
        echo "<span class='validacoes'>".validation_errors()."</span>";
        
            echo form_hidden("idRecurso",$recursos[0]->idRecurso);
            echo form_label("*Tipo de Recurso:","trecurso");
            foreach($tipoRecursos as $tipoRecurso) {
                $array1[$tipoRecurso->idTipoRecurso] = $tipoRecurso->nomeTipoRecurso;
            }
            echo form_dropdown('trecurso',$array1,$recursos[0]->idTipoRecurso,'class=selectmenu style=width:69%');
            
            echo form_label("*Mac Address:","macRecurso");
            $atributos = array(
                            "name" => "macRecurso",
                            "id" => "macRecurso",
                            "value" => $recursos[0]->macRecurso,
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
                            "value" => $recursos[0]->ipRecurso,
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
                            "value" => $recursos[0]->descricaoRecurso,
                            "maxlength" => "50",
                            "size" => "50",
                            "style" => "width:50%",
                         );
            echo form_input($atributos);
            echo br(1);
            
			//echo form_label("É recurso de setor? ","setorRecurso");
			echo form_checkbox('setorRecurso', '1', $recursos[0]->setorRecurso);
			echo "É recurso de setor?";  
			
			echo form_hidden("idCliente",$clientes[0]->idCliente);
			echo br(1);
			//echo form_label("Bloquear","bloqueado");
			echo form_checkbox('bloqueado', '1', $recursos[0]->bloqueado);
            echo "Bloquear este recurso.";
            

			echo br(2);

            echo form_submit("btnSubmit","Alterar");
            echo br(2);
            echo    '<a href="javascript:history.back()">Voltar</a>';
    echo form_close();
    //Fim do formulário
	
?>
</div>