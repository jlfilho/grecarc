<!DOCTYPE HTML>
<!--
	Escape Velocity by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>GRECARC- </title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />

		<?php
			echo link_tag('assets/imgs/computer.ico', 'shortcut icon', 'image/ico');
			echo link_tag('assets/css/assets/css/skel.css');
			echo link_tag('assets/css/style.css');
			echo link_tag('assets/css/style-desktop.css');


		?>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.min.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.dropotron.min.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/skel.min.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/skel-layers.min.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/init.js' ?>"></script>



	</head>
	<body class="homepage">

		<!-- Header -->
			<div id="header-wrapper" class="wrapper">
				<div id="header">
					
					<!-- Logo -->
						<div id="logo">
							<h1>GRECARC</h1>
							<p>Gerenciamento de Recursos Computacionais e Acesso a Rede de Computadores</p>
						</div>
					
					<!-- Nav -->
						<nav id="nav">
							<?php
							$menu[] = anchor(base_url('precadastro'), 'Pre-cadastro');
							$menu[] = anchor(base_url('redefinirsenha'), 'Redefinir Senha');
							$menu[] = anchor(base_url('home'),'Administração');
							echo ul($menu);
							?>

							<!--
							<ul>
								<li class="current">  <a href="index.html">Home</a></li>
								<li><a href="">Pre-cadastro</a></li>
								<li><a href="left-sidebar.html">Redefinir Senha</a></li>
								<li><a href="right-sidebar.html">Administração</a></li>
							</ul>-->
						</nav>

				</div>
			</div>
		<!-- Footer -->
			<div id="footer-wrapper" class="wrapper">				
				<div id="copyright">
					<ul>
						<li>&copy; 2015 - cpd.icet</li><li>Desenvolvido por: liborio_filho</li>
					</ul>
				</div>
			</div>
	</body>
</html>
