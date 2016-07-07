<?php echo doctype('xhtml1-trans') ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>GRECARC</title>
		<?php
		$meta = array(
	        array('name' => 'robots', 'content' => 'NOINDEX, NOFOLLOW'),
	        array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
    	);
		echo meta($meta);
		echo link_tag('assets/imgs/computer.ico', 'shortcut icon', 'image/ico');
		echo link_tag('assets/css/admin.css');
		echo link_tag('assets/js/jquery-ui-1.11.2.custom/jquery-ui.css');
		?>

		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-ui-1.11.2.custom/external/jquery/jquery.js' ?>"></script>
		<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery-ui-1.11.2.custom/jquery-ui.js' ?>"></script>



	</head>
<body>







