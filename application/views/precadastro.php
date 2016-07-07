<div id="content">
    <?php

  if($vinculos == NULL){
    echo heading("Pré-Cadastro de Usuários ".img('assets/imgs/clit.png'),2,"class='divisor'");
    $attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
    echo form_open('precadastro/dadosPessoais',$attributes);
        echo "<span class='validacoes'>".validation_errors()."</span>";

            echo form_label("*Nome Completo:","nome");
            $atributos = array(
                "name" => "nome",
                "id" => "nome",
                "value" => set_value('nome'),
                "maxlength" => "100",
                "size" => "50",
                "style" => "width:50%"
                );
            echo form_input($atributos);
            echo br(1);

            echo form_label("*CPF:","cpf");

            $atributos = array(
                            "name" => "cpf",
                            "id" => "cpf",
                            "value" => set_value('cpf'),
                            "maxlength" => "11",
                            "size" => "11",
                            "autocomplete" => "off",
                            "style" => "width:20%"
                         );
            echo form_input($atributos);
            echo br(1);

            echo form_label("*e-mail:","email");
            $atributos = array(
                            "name" => "email",
                            "id" => "email",
                            "value" => set_value('email'),
                            "autocomplete" => "off",
                            "maxlength" => "50",
                            "size" => "50",
                            "style" => "width:50%"
                         );
            echo form_input($atributos);
            echo br(1);

            echo form_label("*Confirmar e-mail:","confemail");
            $atributos = array(
              "name" => "confemail",
              "id" => "confemail",
              "value" => set_value('confemail'),
              "maxlength" => "50",
              "autocomplete" => "off",
              "size" => "50",
              "style" => "width:50%"
            );
            echo form_input($atributos);
            echo br(2);

            echo form_submit("btnSubmit","Continuar");
        
    echo form_close();
    //Fim do formulário cadastro de cliente

  }else {
      echo heading("Pré-Cadastro de Usuários ".img('assets/imgs/clit.png'),2,"class='divisor'");
      $attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
      echo form_open_multipart('precadastro/adicionar',$attributes);
      echo "<span class='validacoes'>".validation_errors()."</span>";

      echo form_fieldset("Dados Pessoais");
      echo form_label("*Nome:","nome");
      $atributos = array(
          "name" => "nome",
          "id" => "nome",
          "value" => $nome,
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
          "value" => $cpf,
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
          "value" => $email,
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

      echo form_dropdown('vinculo',$array1, $vinculos[3]->idVinculo,'class=selectmenu style=width:69%');
      echo br(1);

      echo form_label("*Setor/Curso:","setor");
      foreach($setores as $setor) {
          $array2[$setor->idSetor] = $setor->nomeSetor;
      }
      echo form_dropdown('setor',$array2,$setores[2]->idSetor,'class=selectmenu style=width:69%');


      echo form_label("Telefone:","telefone");
      $atributos = array(
          "name" => "telefone",
          "id" => "telefone",
          "value" => set_value('telefone'),
          "maxlength" => "20",
          "size" => "20",
          "style" => "width:19%"
      );
      echo form_input($atributos);

      echo form_label("*Celular:","celular");
      $atributos = array(
          "name" => "celular",
          "id" => "celular",
          "value" => set_value('celular'),
          "maxlength" => "19",
          "size" => "19",
          "style" => "width:19%"
      );
      echo form_input($atributos);

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
      echo br(1);
      echo form_label("*Número:","numero");
      $atributos = array(
          "name" => "numero",
          "id" => "numero",
          "value" => set_value('numero'),
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
          "value" => set_value('complemento'),
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
      echo "<b>Anexe abaixo um documento que comprove seu vínculo com a instituição:</b> (pdf, png ou jpg - máx 2Mb)";
      echo br(1);
      echo nbs(5)."<b>Aluno:</b> comprovante de matrícula atual.";
      echo br(1);
      echo nbs(5)."<b>Servidor:</b> Crachá, contra-cheque ou carta de apresentação.";
      echo br(1);
      echo form_label("*Comprovante de Vínculo:","comprovante");
      echo br(2);
      $atributos = array(
          "name" => "userfile",
          "id" => "userfile"
      );
      echo form_upload($atributos);

      echo br(3);

      echo form_submit("btnSubmit","Enviar");
      form_fieldset_close();
      echo form_close();
      //Fim do formulário cadastro de cliente


  }

?>

</div>

<script type="text/javascript" charset="UTF-8">
    $(document).ready(function() {

    $("#confemail").bind('cut copy paste', function(e) {
        e.preventDefault();
    });

    });
</script>
