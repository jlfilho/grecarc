<div id="content">
    <?php
    echo heading("Alterar Dados do Cliente ".img('assets/imgs/gear.png'),2,"class='divisor'");
    $attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
    echo form_open('clientes/salvar_alteracao',$attributes);
        echo "<span class='validacoes'>".validation_errors()."</span>";
        //echo form_fieldset("Dados Pessoais");
            echo form_hidden("idCliente",$clientes[0]->idCliente);
            echo form_label("Nome*:","nome");
            $atributos = array(
                "name" => "nome",
                "id" => "nome",
                "value" => $clientes[0]->nomeCliente,
                "maxlength" => "100",
                "size" => "50",
                "style" => "width:68%"
                );
            echo form_input($atributos);
            echo br(1);
            
            echo form_label("Vínculo*:","vinculo");
            foreach($vinculos as $vinculo) {
                $array1[$vinculo->idVinculo] = $vinculo->nomeVinculo;
            }
            echo form_dropdown('vinculo',$array1,$clientes[0]->idVinculo,'class=selectmenu style=width:69%');
            
            
            echo form_label("Setor*:","setor");
            foreach($setores as $setor) {
                $array2[$setor->idSetor] = $setor->nomeSetor;
            }
            echo form_dropdown('setor',$array2,$clientes[0]->idSetor,'class=selectmenu style=width:69%');
                
            echo form_label("Tipo Documento*:","tdocumento");
            foreach($tipoDocumento as $tipoDocumento) {
                $array3[$tipoDocumento->idTipoDocumento] = $tipoDocumento->nomeTipoDocumento;
            }
            echo form_dropdown('tdocumento',$array3,$clientes[0]->idTipoDocumento,'class=selectmenu style=width:69%');
            
            echo form_label("Número Documento*:","numDoc");
            $atributos = array(
                            "name" => "numDoc",
                            "id" => "numDoc",
                            "value" => $clientes[0]->numDoc,
                            "maxlength" => "20",
                            "size" => "20",
                            "style" => "width:20%"
                         );
            echo form_input($atributos);
            echo br(1);
            echo form_label("Telefone:","telefone");
            $atributos = array(
                            "name" => "telefone",
                            "id" => "telefone",
                            "value" => $clientes[0]->telefone,
                            "maxlength" => "20",
                            "size" => "20",
                            "style" => "width:19%"
                         );
            echo form_input($atributos);
            
            echo form_label("Celular:","celular");
            $atributos = array(
                            "name" => "celular",
                            "id" => "celular",
                            "value" => $clientes[0]->celular,
                            "maxlength" => "20",
                            "size" => "20",
                            "style" => "width:19%"
                         );
            echo form_input($atributos);
            
            echo form_label("E-mail*:","email");
            $atributos = array(
                            "name" => "email",
                            "id" => "email",
                            "value" => $clientes[0]->email,
                            "maxlength" => "50",
                            "size" => "50",
                            "style" => "width:50%"
                         );
            echo form_input($atributos);
            echo br(1);
            echo form_label("Rua*:","rua");
            $atributos = array(
                            "name" => "rua",
                            "id" => "rua",
                            "value" => $clientes[0]->rua,
                            "maxlength" => "30",
                            "size" => "30",
                            "style" => "width:30%"
                         );
            echo form_input($atributos);
            
            echo form_label("Número:","numero");
            $atributos = array(
                            "name" => "numero",
                            "id" => "numero",
                            "value" => $clientes[0]->numero,
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
                            "value" => $clientes[0]->complemento,
                            "maxlength" => "30",
                            "size" => "30",
                            "style" => "width:30%"
                         );
            echo form_input($atributos);
            echo br(1);
            echo form_label("Bairro*:","bairro");
            $atributos = array(
                            "name" => "bairro",
                            "id" => "bairro",
                            "value" => $clientes[0]->bairro,
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
                            "value" => $clientes[0]->cep,
                            "maxlength" => "20",
                            "size" => "20",
                            "style" => "width:20%"
                         );
            echo form_input($atributos);
            echo br(1);
            echo form_label("Cidade*:","cidade");
            foreach($cidades as $cidade) {
                $array4[$cidade->idCidade] = $cidade->nomeCidade;
            }
            echo form_dropdown('cidade',$array4,$clientes[0]->idCidade,'class=selectmenu style=width:69%');

			

            echo form_submit("btnSubmit","Alterar");
            echo br(2);
            echo    '<a href="javascript:history.back()">Voltar</a>';
        
    echo form_close();
	echo br(1);
?>
</div>