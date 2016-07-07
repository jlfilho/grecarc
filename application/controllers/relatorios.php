<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Relatorios extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
            redirect('home');
        }
    }


    function relatorio_recurso_cliente()
    {
        $this->load->helper(array('dompdf', 'file'));
        $this->load->library('table');

        $this->db->select('a.idCliente, a.nomeCliente, c.nomeVinculo, e.nomeTipoDocumento, a.numDoc, d.nomeTipoRecurso, b.macRecurso, b.ipRecurso,b.descricaoRecurso','b.descricaoRecurso');
        $this->db->from('Cliente a');
        $this->db->join('Recurso b', 'b.idCliente = a.idCliente');
        $this->db->join('Vinculo c', 'c.idVinculo = a.idVinculo');
        $this->db->join('TipoRecurso d', 'd.idTipoRecurso = b.idTipoRecurso');
        $this->db->join('TipoDocumento e', 'e.idTipoDocumento = a.idTipoDocumento');
        $this->db->order_by("nomeVinculo", "desc");
        $this->db->order_by("nomeCliente", "asc");
        $this->db->order_by("nomeTipoRecurso", "asc");
        $data['clientes'] = $this->db->get()->result();

        $this->load->view('relatorio_clientes',$data);

    }

    function exportar($vinculo)
    {
        $this->load->library('table');
        $this->db->select('a.idCliente, a.nomeCliente, c.idVinculo, c.nomeVinculo, e.nomeTipoDocumento, a.numDoc,d.nomeTipoRecurso, b.macRecurso, b.descricaoRecurso','b.descricaoRecurso', 'b.bloqueado');
        $this->db->from('Cliente a');
        $this->db->join('Recurso b', 'b.idCliente = a.idCliente');
        $this->db->join('Vinculo c', 'c.idVinculo = a.idVinculo');
        $this->db->join('TipoRecurso d', 'd.idTipoRecurso = b.idTipoRecurso');
        $this->db->join('TipoDocumento e', 'e.idTipoDocumento = a.idTipoDocumento');
        $this->db->order_by("nomeCliente", "asc");
        $this->db->order_by("nomeTipoRecurso", "asc");
        $this->db->like('c.idVinculo',$vinculo);
        $this->db->where('b.bloqueado',FALSE);
        $data['clientes'] = $this->db->get()->result();

        $this->exportar_arquivo($vinculo,$data);
	if($vinculo==1){
        	$data['output'] = shell_exec('/home/grecarc/public_html/tmp/reloadSquidAres.sh');
	}else{
		$data['output'] = shell_exec('/home/grecarc/public_html/tmp/reloadSquidZeus.sh');
	}
        $this->load->view('exportar',$data);

    }

	function pdf_relatorio_clientes()
	{
		$this->load->helper(array('dompdf', 'file'));
		$this->load->library('table');

        $this->db->select('a.idCliente, a.nomeCliente, c.nomeVinculo, e.nomeTipoDocumento, a.numDoc, d.nomeTipoRecurso, b.macRecurso, b.descricaoRecurso','b.descricaoRecurso');
        $this->db->from('Cliente a');
        $this->db->join('Recurso b', 'b.idCliente = a.idCliente');
        $this->db->join('Vinculo c', 'c.idVinculo = a.idVinculo');
        $this->db->join('TipoRecurso d', 'd.idTipoRecurso = b.idTipoRecurso');
        $this->db->join('TipoDocumento e', 'e.idTipoDocumento = a.idTipoDocumento');
        $this->db->order_by("nomeVinculo", "desc");
        $this->db->order_by("nomeCliente", "asc");
        $this->db->order_by("nomeTipoRecurso", "asc");
        $data['clientes'] = $this->db->get()->result();

	
     	//$this->load->view('html_header',$data);
     	$this->load->view('relatorio_clientes',$data);
        //$this->load->view('html_footer',$data);



        //$html= $this->load->view('html_header',$data,true);
        //$html= $this->load->view('relatorio_clientes',$data,true);
        //$html.= $this->load->view('html_footer',$data,true);

		
     	//pdf_create($html, 'report');

     	//or
     	//$data2 = pdf_create($html, '', false);
     	//write_file('/tmp/filename', $data2);
     	//if you want to write it to disk and/or send it as an attachment    
	}


    function exportar_arquivo($vinculo,$data)
    {

        $nome_arquivo = array(
            '1' => './tmp/mac_alunos.txt',
            '2' => './tmp/mac_professores.txt',
            '3' => './tmp/mac_tecnicos.txt',
            '4' => './tmp/mac_visitantes.txt',
            '5' => './tmp/mac_posgraduando.txt'
        );

        $arq = fopen($nome_arquivo[$vinculo],'w');

        $array_clientes = array();

        foreach($data['clientes'] as $cliente){
            $array_clientes[] = array(
                $cliente->macRecurso,
                "\t#".$cliente->nomeTipoRecurso.':'.$cliente->nomeCliente.':'.$cliente->nomeVinculo."\n"
            );
        }

        foreach($array_clientes as $recurso){
            fwrite($arq,$recurso[0].$recurso[1]);
        }

        fclose($arq);

       // $output = shell_exec('/home/grecarc/public_html/tmp/reflashMac.sh');
       // echo "<pre>$output</pre>";
    }
	
    
}
