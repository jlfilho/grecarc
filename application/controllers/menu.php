<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {
	public function __construct(){
		parent::__construct();
		if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
			redirect('home');
		}
	}
	
	public function index(){
		if (!date_default_timezone_get('date.timezone'))
		{
			date_default_timezone_set('America/Manaus'); // put here default timezone
		}
		$this->load->library('table');
		$this->db->order_by('dataCadastro','asc');
		$data['clientes'] = $this->db->get('PreCadastro')->result();

		if(count($data['clientes'])>0){
			$this->load->view('html_header');
			$this->load->view('menu');
			$this->load->view('precadastros_pendentes',$data);
			$this->load->view('rodape');
			$this->load->view('html_footer');
		}else{
			$this->load->view('html_header');
			$this->load->view('menu');
			$this->load->view('rodape');
			$this->load->view('html_footer');
		}
	}
	
}