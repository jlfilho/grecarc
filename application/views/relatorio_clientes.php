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

    $tmpl = array (
    'table_open'          => '<table class="table">',

    'heading_row_start'   => '<tr>',
    'heading_row_end'     => '</tr>',
    'heading_cell_start'  => '<th>',
    'heading_cell_end'    => '</th>',

    'row_start'           => '<tr>',
    'row_end'             => '</tr>',
    'cell_start'          => '<td>',
    'cell_end'            => '</td>',

    'row_alt_start'       => '<tr class="alt">',
    'row_alt_end'         => '</tr>',
    'cell_alt_start'      => '<td>',
    'cell_alt_end'        => '</td>',

    'table_close'         => '</table>'
);

$this->table->set_template($tmpl);
echo heading("Relatório de Recursos por Clientes ",1,"class='cab_table'");

    $array_clientes = array();
    $i=0;
    foreach($clientes as $cliente){
        $array_clientes[] = array(            
             $cliente->nomeCliente,
             $cliente->nomeVinculo,
             $cliente->nomeTipoDocumento,
             $cliente->numDoc,
             $cliente->nomeTipoRecurso,
             $cliente->macRecurso,
             $cliente->ipRecurso,
             $cliente->descricaoRecurso
        );
        $i++;
    }
    $this->table->set_heading('Nome','Vínculo','Documento', 'Número','Tipo Recurso','Mac Address','IP Recurso','Descrição');
    echo $this->table->generate($array_clientes);
?>
</body>
</html>