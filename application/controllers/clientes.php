<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clientes extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
            redirect('home');
        }
    }
    
    
    public function index()
    {
        $this->load->library('table');
        $this->db->order_by("nomeCliente", "asc"); 
        $data['clientes'] = $this->db->get('Cliente','25')->result();
        $data['vinculos'] = $this->db->get('Vinculo')->result();
        $data['setores'] = $this->db->get('Setor')->result();
        $data['tipoDocumentos'] = $this->db->get('TipoDocumento')->result();
        $data['cidades'] = $this->db->get('Cidade')->result();
        $this->load->view('html_header');
        $this->load->view('menu');
        $this->load->view('clientes',$data);
		$this->load->view('rodape'); 
        $this->load->view('html_footer');
    }
    
    
    public function adicionar()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome','Nome','required');
        $this->form_validation->set_rules('numDoc','Número Documento','required');
        $this->form_validation->set_rules('email','E-mail','required|valid_email');
        $this->form_validation->set_rules('rua','Rua','required');
        $this->form_validation->set_rules('bairro','Bairro','required');
        $this->form_validation->set_rules('cidade','Cidade','required');
		$this->form_validation->set_rules('celular','Celular','valid_phone');
		$this->form_validation->set_rules('telefone','Telefone','valid_phone');
		if($this->input->post('tdocumento')==2){
        	$this->form_validation->set_rules('numDoc', 'Número Documento', 'valid_cpf');
        }
        if($this->form_validation->run() == FALSE){
            $this->index();
        }else{
            $data['nomeCliente'] = mb_strtoupper($this->input->post('nome'));
            $data['idVinculo'] = $this->input->post('vinculo');
            $data['idSetor'] = $this->input->post('setor');
            $data['idTipoDocumento'] = $this->input->post('tdocumento');
            $data['numDoc'] = $this->input->post('numDoc');
            $data['telefone'] = $this->input->post('telefone');
            $data['celular'] = $this->input->post('celular');
            $data['email'] = mb_strtolower($this->input->post('email'));
            $data['rua'] = mb_strtoupper($this->input->post('rua'));
            $data['numero'] = $this->input->post('numero');
            $data['complemento'] = $this->input->post('complemento');
            $data['bairro'] = mb_strtoupper($this->input->post('bairro'));
            $data['cep'] = $this->input->post('cep');
            $data['idCidade'] = $this->input->post('cidade');
            $this->db->insert('Cliente',$data);    
            redirect('clientes');     
        }
    }


    public function excluir($id){
        $this->db->where('idCliente',$id);
        $this->db->delete('Cliente');
        redirect("clientes");
    }


    public function editar($id){
        $data['vinculos'] = $this->db->get('Vinculo')->result();
        $data['setores'] = $this->db->get('Setor')->result();
        $data['tipoDocumento'] = $this->db->get('TipoDocumento')->result();
        $data['cidades'] = $this->db->get('Cidade')->result();
        
        $this->db->where('idCliente',$id);
        $data['clientes'] = $this->db->get('Cliente')->result();
        $this->load->view('html_header');
        $this->load->view('menu');
        $this->load->view('editar_clientes',$data);
		$this->load->view('rodape'); 
        $this->load->view('html_footer');
    }
    
    
    public function salvar_alteracao(){
        $id = $this->input->post('idCliente');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome','Nome','required');
        $this->form_validation->set_rules('numDoc','Número Documento','required');
        $this->form_validation->set_rules('email','E-mail','valid_email');
        $this->form_validation->set_rules('rua','Rua','required');
        $this->form_validation->set_rules('bairro','Bairro','required');
        $this->form_validation->set_rules('cidade','Cidade','required');
		$this->form_validation->set_rules('celular','Celular','valid_phone');
		$this->form_validation->set_rules('telefone','Telefone','valid_phone');
		if($this->input->post('tdocumento')==2){
        	$this->form_validation->set_rules('numDoc', 'Número Documento', 'valid_cpf');
        }
        
        if($this->form_validation->run() == FALSE){
            $this->editar($id);
        }else{
            $data['nomeCliente'] = mb_strtoupper($this->input->post('nome'));
            $data['idVinculo'] = $this->input->post('vinculo');
            $data['idSetor'] = $this->input->post('setor');
            $data['idTipoDocumento'] = $this->input->post('tdocumento');
            $data['numDoc'] = $this->input->post('numDoc');
            $data['telefone'] = $this->input->post('telefone');
            $data['celular'] = $this->input->post('celular');
            $data['email'] = mb_strtolower($this->input->post('email'));
            $data['rua'] = mb_strtoupper($this->input->post('rua'));
            $data['numero'] = $this->input->post('numero');
            $data['complemento'] = $this->input->post('complemento');
            $data['bairro'] = mb_strtoupper($this->input->post('bairro'));
            $data['cep'] = $this->input->post('cep');
            $data['idCidade'] = $this->input->post('cidade');
            $this->db->where('idCliente',$id);
            $this->db->update('Cliente',$data);         
			redirect("clientes");
        }
    }


    public function recurso($id){
    	$this->load->library('table');
        $data['vinculos'] = $this->db->get('Vinculo')->result();
        $data['setores'] = $this->db->get('Setor')->result();
        $data['tipoDocumento'] = $this->db->get('TipoDocumento')->result();
        $data['cidades'] = $this->db->get('Cidade')->result();
        
        $this->db->where('idCliente',$id);
        $data['recursos'] = $this->db->get('Recurso')->result();
		$data['tipoRecursos'] = $this->db->get('TipoRecurso')->result();
                
        $this->db->where('idCliente',$id);
        $data['clientes'] = $this->db->get('Cliente')->result();
        $this->load->view('html_header');
        $this->load->view('menu');
        $this->load->view('recurso',$data); 
		$this->load->view('rodape');
        $this->load->view('html_footer');
    }


	public function adicionar_recurso($idCliente)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('macRecurso','Mac Address','required');
		$this->form_validation->set_rules('macRecurso','Mac Address','valid_mac');
		$this->form_validation->set_rules('ipRecurso','Ip Lógico','valid_ip');
        
        if($this->form_validation->run() == FALSE){
            $this->recurso($idCliente);
        }else{
        	$this->db->where('idCliente',$idCliente);
        	$rec = $this->db->get('Recurso')->result();
			if(count($rec)<3){//se menor que 3 recurso
            	$data['idTipoRecurso'] = $this->input->post('trecurso');
            	$data['ipRecurso'] = $this->input->post('ipRecurso');
            	$data['macRecurso'] = mb_strtoupper($this->input->post('macRecurso'));
				$data['descricaoRecurso'] = $this->input->post('descricaoRecurso');
				$data['setorRecurso'] = $this->input->post('setorRecurso');
				$data['idCliente'] = $idCliente;
				$data['bloqueado'] = $this->input->post('bloqueado');
            	$this->db->insert('Recurso',$data);    
            	redirect('clientes/recurso/'.$idCliente);
			}else{
				redirect('clientes/recurso/'.$idCliente);
			}	     
        }
    }
	
	public function excluir_recurso($idRecurso,$idCliente){
        $this->db->where('idRecurso',$idRecurso);
        $this->db->delete('Recurso');
        redirect('clientes/recurso/'.$idCliente); 
    }

	public function editar_recurso($idRecurso,$idCliente){
      	$data['tipoDocumentos'] = $this->db->get('TipoDocumento')->result();
        $data['tipoRecursos'] = $this->db->get('TipoRecurso')->result();
		$this->db->where('idCliente',$idCliente);	
        $data['clientes'] = $this->db->get('Cliente')->result();
        $this->db->where('idRecurso',$idRecurso);
        $data['recursos'] = $this->db->get('Recurso')->result();
        $this->load->view('html_header');
        $this->load->view('menu');
        $this->load->view('editar_recurso',$data); 
		$this->load->view('rodape');
        $this->load->view('html_footer');
    }
	
	
	public function salvar_alteracao_recurso(){
        //$id = $this->input->post('idCliente');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('macRecurso','Mac Address','required');
		$this->form_validation->set_rules('macRecurso','Mac Address','valid_mac');
		$this->form_validation->set_rules('ipRecurso','Ip Lógico','valid_ip');
        
        if($this->form_validation->run() == FALSE){
            $this->editar_recurso($this->input->post('idRecurso'),$this->input->post('idCliente'));
        }else{
            $data['idRecurso'] = $this->input->post('idRecurso');
			$data['idTipoRecurso'] = $this->input->post('trecurso');
			$data['ipRecurso'] = $this->input->post('ipRecurso');
            $data['macRecurso'] = mb_strtoupper($this->input->post('macRecurso'));
			$data['descricaoRecurso'] = $this->input->post('descricaoRecurso');
			$data['setorRecurso'] = $this->input->post('setorRecurso');
			$data['idCliente'] = $this->input->post('idCliente');
			$data['bloqueado'] = $this->input->post('bloqueado');
			
			
            $this->db->where('idRecurso',$this->input->post('idRecurso'));
            $this->db->update('Recurso',$data);         
			redirect("clientes/recurso/".$this->input->post('idCliente'));
        }
    }

	public function buscar(){
		$this->load->library('table');
		$busca = $this->input->post('busca');	
        $data['vinculos'] = $this->db->get('Vinculo')->result();
        $data['setores'] = $this->db->get('Setor')->result();
        $data['tipoDocumentos'] = $this->db->get('TipoDocumento')->result();
        $data['cidades'] = $this->db->get('Cidade')->result();
		$this->db->like('nomeCliente',$busca);
		$this->db->or_like('email',$busca);
		$this->db->order_by("nomeCliente", "asc"); 
        $data['clientes'] = $this->db->get('Cliente')->result();		
        $this->load->view('html_header');
        $this->load->view('menu');
        $this->load->view('busca_clientes',$data); 
		$this->load->view('rodape');
        $this->load->view('html_footer');
	}

    function get_autocomplete(){
        $this->load->model('busca_model');
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $busca = $this->busca_model->get_data($q);
            echo json_encode($busca);
        }
    }

}