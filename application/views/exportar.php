<?php echo doctype('html5'); ?>

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
    echo link_tag('assets/css/rel.css');
    ?>
</head>
<body>

<?php
    echo "<div class='export''>";
    $array_clientes = array();

    foreach($clientes as $cliente){
        $array_clientes[] = array(
            $cliente->macRecurso,
            '#'.$cliente->nomeTipoRecurso.':'.$cliente->nomeCliente.':'.$cliente->nomeVinculo
        );
    }
    $this->table->set_heading('#Mac Address','Tipo:Nome:Vínculo');
    echo $this->table->generate($array_clientes);

    /*
    foreach($array_clientes as $recurso){
        echo $recurso[0]."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;#";
        echo $recurso[1].":";
        echo $recurso[2].":";
        echo $recurso[3];
        echo br(1);
    }
    */
    echo "</div>";
    //echo br(1);	
    echo heading('Debug:',2);
    echo $output;	
?>
</body>
</html>
