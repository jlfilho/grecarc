<div id="content">
    <?php
    echo heading("Cadastrar Usuarios do Sistema ".img('assets/imgs/Add.png'),2,"class='divisor'");
    $attributes = array('class' => 'formcadastros', 'id' => 'formcadastro');
    echo form_open('usuarios/adicionar',$attributes);
        echo "<span class='validacoes'>".validation_errors()."</span>";

            echo form_label("*Nome Usuário:","nomeUsuario");
            $atributos = array(
                "name" => "nomeUsuario",
                "id" => "nomeUsuario",
                "value" => set_value('nomeUsuario'),
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
                "value" => set_value('login'),
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
                "value" => set_value('senha'),
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
                "value" => set_value('confsenha'),
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
            echo form_dropdown('perfilUsuario',$array1,$perfilUsuarios[0]->idPerfilUsuario,'class=selectmenu style=width:69%');

            echo form_label("Ativo:","ativo");
            echo form_checkbox('ativo', '1', FALSE);

            echo br(2);



            $btn = array(
    			'name' => "btnSubmit",
    			'value' => "Adicionar",
    			'type' => "image",
    			'src' => "assets/imgs/Load.png"
    		);
            echo form_submit("btnSubmit","Adicionar");

    echo form_close();

	//Fim formulário usuário

    echo heading("Usuarios Cadastrados ".img('assets/imgs/clit.png'),2,"class='divisor'");


    $array_clientes = array();
    foreach($usuarios as $usuario){
        foreach($perfilUsuarios as $perfilUsuario) {
            if($perfilUsuario->idPerfilUsuario == $usuario->PerfilUsuario_idPerfilUsuario){
                $nomePerfilUsuario = $perfilUsuario->nomePerfilUsuario;
            }
        }

        $array_usuario[] = array(
            anchor(
                "usuarios/excluir/".$usuario->idUsuario,
                img('assets/imgs/xis.png'), 
                array('onclick'=>"return confirm('Confirma a exclusão deste Usuário?');")
                ),
             anchor(
                "usuarios/editar/".$usuario->idUsuario, img('assets/imgs/gear.png'),
                array('onclick'=>"return confirm('Gostaria de alterar dados deste Usuário?');")
             ),
             $usuario->nomeUsuario,
             $nomePerfilUsuario
        );
    }
    $this->table->set_heading('Excluir','Editar','Nome Usuário','Perfil');
    echo "<div class='wraper_table'>";
    echo $this->table->generate($array_usuario);
    echo "</div>";
?>
</div>
