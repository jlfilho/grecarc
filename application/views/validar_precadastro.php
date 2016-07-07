<div id="content">
    <?php

      echo heading("Validação de Pré-Cadastro".img('assets/imgs/Search.png'),2,"class='divisor'");
      $attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
      echo form_open_multipart('cadastro/validar',$attributes);
      echo "<span class='validacoes'>".validation_errors()."</span>";

      echo form_hidden("idPreCadastro",$cliente[0]->idPreCadastro);

      echo form_fieldset("Dados Pessoais:");
      echo form_label("*Nome:","nome");
      $atributos = array(
          "name" => "nome",
          "id" => "nome",
          "value" => $cliente[0]->nomeCliente,
          "maxlength" => "100",
          "size" => "50",
          "readonly" => "true",
          "style" => "width:68%"
      );
      echo form_input($atributos);
      echo br(1);

      echo form_label("*CPF:","cpf");
      $atributos = array(
          "name" => "cpf",
          "id" => "cpf",
          "value" => $cliente[0]->cpf,
          "maxlength" => "11",
          "size" => "11",
          "readonly" => "true",
          "style" => "width:20%"
      );
      echo form_input($atributos);
      echo br(1);

      echo form_label("*E-mail:","email");
      $atributos = array(
          "name" => "email",
          "id" => "email",
          "value" => $cliente[0]->email,
          "readonly" => "true",
          "maxlength" => "50",
          "size" => "50",
          "style" => "width:50%"
      );
      echo form_input($atributos);
      echo br(1);


      echo form_label("*Vínculo:","vinculo");
      foreach($vinculos as $vinculo) {
          $array1[$vinculo->idVinculo] = $vinculo->nomeVinculo;
      }

      echo form_dropdown('vinculo',$array1, $cliente[0]->idVinculo,'class=selectmenu style=width:69%');
      echo br(1);

      echo form_label("*Setor/Curso:","setor");
      foreach($setores as $setor) {
          $array2[$setor->idSetor] = $setor->nomeSetor;
      }
      echo form_dropdown('setor',$array2,$cliente[0]->idSetor,'class=selectmenu style=width:69%');


      echo form_label("Telefone:","telefone");
      $atributos = array(
          "name" => "telefone",
          "id" => "telefone",
          "value" => $cliente[0]->telefone,
          "maxlength" => "20",
          "size" => "20",
          "style" => "width:19%"
      );
      echo form_input($atributos);

      echo form_label("*Celular:","celular");
      $atributos = array(
          "name" => "celular",
          "id" => "celular",
          "value" => $cliente[0]->celular,
          "maxlength" => "19",
          "size" => "19",
          "style" => "width:19%"
      );
      echo form_input($atributos);

      echo form_label("*Rua:","rua");
      $atributos = array(
          "name" => "rua",
          "id" => "rua",
          "value" => $cliente[0]->rua,
          "maxlength" => "30",
          "size" => "30",
          "style" => "width:30%"
      );
      echo form_input($atributos);
      echo br(1);
      echo form_label("*Número:","numero");
      $atributos = array(
          "name" => "numero",
          "id" => "numero",
          "value" => $cliente[0]->numero,
          "maxlength" => "12",
          "size" => "12",
          "style" => "width:19%"
      );
      echo form_input($atributos);
      //echo br(1);
      echo form_label("Complemento:","complemento");
      $atributos = array(
          "name" => "complemento",
          "id" => "complemento",
          "value" => $cliente[0]->complemento,
          "maxlength" => "19",
          "size" => "19",
          "style" => "width:19%"
      );
      echo form_input($atributos);
      echo br(1);
      echo form_label("*Bairro:","bairro");
      $atributos = array(
          "name" => "bairro",
          "id" => "bairro",
          "value" => $cliente[0]->bairro,
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
          "value" => $cliente[0]->cep,
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
      echo form_dropdown('cidade',$array4,$cliente[0]->idCidade,'class=selectmenu style=width:69%');
      echo br(2);
      echo form_label("Baixar Comprovante","comprovante");
      echo br(2);
      echo anchor('assets/comp/'.$cliente[0]->comprovante,img('assets/imgs/go-down.svg'),'target=_blank');
      echo form_hidden("comprovante",$cliente[0]->comprovante);
      echo br(3);

      echo form_fieldset_close();
      echo form_submit("btnSubmit","Validar");
      echo form_close();
      //Fim do formulário cadastro de cliente

    echo br(2);

    echo heading("Texto de recusa".img('assets/imgs/Email.png'),2,"class='divisor'");
    $attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
    echo form_open_multipart('cadastro/invalidar',$attributes);
    echo "<span class='validacoes'>".validation_errors()."</span>";
    echo form_fieldset("Digite o texto com o motivo da recusa e clique em enviar:");
    echo form_hidden("idPreCadastro",$cliente[0]->idPreCadastro);
    echo form_hidden("email",$cliente[0]->email);
    echo form_hidden("comprovante",$cliente[0]->comprovante);

    echo form_label("Observação","observacao");
    $msn = "Recebemos uma solicitação de cadastro para o sistema GRECARC, infelizmente seu cadastro não pode ser validado por:
<ul>
<li>Dados pessoais incompletos </li>
<li>Comprovante de vínculo inválido</li>
</ul>
Seu pré-cadastro foi excluído da base de dados, favor fazer nova solicitação informando todos os dados corretamente e anexar um comprovante de vínculo com a Instituição.";
    $atributos = array(
        "name" => "observacao",
        "id" => "observacao",
        "value" => $msn
    );
    echo form_textarea($atributos);
    echo form_fieldset_close();
    echo br(2);
    echo form_submit("btnSubmit","Enviar ao Cliente");
    echo form_close();


?>

</div>
