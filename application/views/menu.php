<div id="top"> 
	<span class='saudacao'>
		Seja bem vindo:
		<?php
		echo $this->session->userdata('usuario');
		echo " | ";
		echo anchor(base_url(). 'home/logout', 'Sair', 'title="Efetuar Logout"');
		?>
	</span>
	
	<!--<div id="menu"> 
		
		<?php
			$menu[] = anchor(base_url().'menu', 'Home', 'title="Voltar para a Home"');
			$menu[] = anchor(base_url().'clientes', 'Clientes', 'title="Cadastrar Clientes"');
			$menu[] = anchor(base_url().'clientes/pdf_relatorio_clientes', 'Recursos por Clientes', 'title="Recursos por Clientes"');
			$menu[] = anchor(base_url().'usuarios', 'Usuários', 'title="Administrar Usuários"');
			//echo ul($menu);
		?>
	</div>-->
	
	<div class="menu"> 
		<ul>
			<li> <?php  echo anchor(base_url().'menu', 'Home', 'title="Voltar para a Home"'); ?></li>
			<li> <?php  echo anchor(base_url().'clientes', 'Clientes', 'title="Cadastrar Clientes"'); ?> </li>
			<li><a href="">Relatórios</a> 
				<ul>
					<li> <?php echo anchor(base_url('relatorios/relatorio_recurso_cliente'),'Recursos por Clientes',array('target' => '_blank', 'title' => 'Visualizar Recursos por Clientes')); ?> </li>
					<li> <?php echo anchor(base_url('relatorios/exportar/1'),'Exportar Alunos Graduação',array('target' => '_blank', 'title' => 'Exportar para Squid Mac Address Alunos Graduação')); ?></li>
					<li> <?php echo anchor(base_url('relatorios/exportar/5'),'Exportar Alunos Pós-Graduação',array('target' => '_blank', 'title' => 'Exportar para Squid Mac Address Alunos Pós Graduação')); ?></li>
					<li> <?php echo anchor(base_url('relatorios/exportar/2'),'Exportar Professores',array('target' => '_blank', 'title' => 'Exportar para Squid Mac Address Professores')); ?></li>
					<li> <?php echo anchor(base_url('relatorios/exportar/3'),'Exportar Técnicos',array('target' => '_blank', 'title' => 'Exportar para Squid Mac Address Técnicos')); ?></li>
					<li> <?php echo anchor(base_url('relatorios/exportar/4'),'Exportar Visitantes',array('target' => '_blank', 'title' => 'Exportar para Squid Mac Address Visitantes')); ?></li>

				</ul>
				</li>	
			<li> <?php  echo anchor(base_url().'usuarios', 'Usuários', 'title="Administrar Usuários"'); ?></li>
		</ul>	
		
	</div>
		
   </div>