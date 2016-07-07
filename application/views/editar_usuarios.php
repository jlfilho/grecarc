<div id="content">
    <?php
    echo heading("Cadastrar Usuarios do Sistema ".img('assets/imgs/Add.png'),2,"class='divisor'");
    $attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
    echo form_open('usuarios/salvar_alteracao',$attributes);
        echo "<span class='validacoes'>".validation_errors()."</span>";

            echo form_hidden("idUsuario",$usuarios[0]->idUsuario);

            echo form_label("*Nome Usuário:","nomeUsuario");
            $atributos = array(
                "name" => "nomeUsuario",
                "id" => "nomeUsuario",
                "value" => $usuarios[0]->nomeUsuario,
                "maxlength" => "50",
                "size" => "50",
                "style" => "width:50%"
            );
            echo form_input($atributos);
            echo br(1);

            echo form_label("*Login:","login");
            $atributos = array(
                "name" => "login",
                "id" => "login",
                "value" => $usuarios[0]->login,
                "maxlength" => "20",
                "size" => "20",
                "style" => "width:20%"
                );
            echo form_input($atributos);
            echo br(1);

            echo form_label("*Senha:","senha");
            $atributos = array(
                "name" => "senha",
                "id" => "senha",
                "value" => $usuarios[0]->senha,
                "maxlength" => "20",
                "size" => "20",
                "style" => "width:20%"
            );
            echo form_password($atributos);
            echo br(1);

            echo form_label("*Confirmar Senha:","confsenha");
            $atributos = array(
                "name" => "confsenha",
                "id" => "confsenha",
                "value" => "",
                "maxlength" => "20",
                "size" => "20",
                "style" => "width:20%"
            );
            echo form_password($atributos);
            echo br(1);

            echo form_label("*Perfil:","perfil");
            foreach($perfilUsuarios as $perfilUsuario) {
                $array1[$perfilUsuario->idPerfilUsuario] = $perfilUsuario->nomePerfilUsuario;
            }
            echo form_dropdown('perfilUsuario',$array1,$usuarios[0]->PerfilUsuario_idPerfilUsuario,'class=selectmenu style=width:69%');

            echo form_label("Ativo:","ativo");
            echo form_checkbox('ativo', '1', $usuarios[0]->ativo);

            echo br(2);


            $btn = array(
    			'name' => "btnSubmit",
    			'value' => "Alterar",
    			'type' => "image",
    			'src' => "assets/imgs/Load.png"
    		);
            echo form_submit("btnSubmit","Alterar");
            echo br(2);
            echo    '<a href="javascript:history.back()">Voltar</a>';
    echo form_close();
	//Fim formulário usuário
?>
</div>
