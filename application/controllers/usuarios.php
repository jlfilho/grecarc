<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
            redirect('home');
        }
    }
    
    
    public function index()
    {
        $this->load->library('table');
        $this->db->order_by("nomeUsuario", "asc");
        $data['usuarios'] = $this->db->get('Usuario')->result();
        $data['perfilUsuarios'] = $this->db->get('PerfilUsuario')->result();
        $this->load->view('html_header');
        $this->load->view('menu');
        $this->load->view('usuarios',$data);
		$this->load->view('rodape'); 
        $this->load->view('html_footer');
    }


    public function adicionar()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nomeUsuario','Nome Usuario','required');
        $this->form_validation->set_rules('login','Login','required');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]|max_length[12]|matches[confsenha]|sha1');
        $this->form_validation->set_rules('confsenha', 'Confirmar Senha', 'trim|required');
        if($this->form_validation->run() == FALSE){
            $this->index();
        }else{
            $data['nomeUsuario'] = mb_strtoupper($this->input->post('nomeUsuario'));
            $data['login'] = $this->input->post('login');
            $data['senha'] = $this->input->post('senha');
            $data['ativo'] = $this->input->post('ativo');
            $data['PerfilUsuario_idPerfilUsuario'] = $this->input->post('perfilUsuario');
            $this->db->insert('Usuario',$data);
            redirect('usuarios');
        }
    }


    public function excluir($id){
        $this->db->where('idUsuario',$id);
        $this->db->delete('Usuario');
        redirect("usuarios");
    }


    public function editar($id){
        $data['perfilUsuarios'] = $this->db->get('PerfilUsuario')->result();
        $this->db->where('idUsuario',$id);
        $data['usuarios'] = $this->db->get('Usuario')->result();

        $this->load->view('html_header');
        $this->load->view('menu');
        $this->load->view('editar_usuarios',$data);
        $this->load->view('rodape');
        $this->load->view('html_footer');
    }


    public function salvar_alteracao(){
        $id = $this->input->post('idUsuario');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nomeUsuario','Nome Usuario','required');
        $this->form_validation->set_rules('login','Login','required');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]|max_length[12]|matches[confsenha]|sha1');
        $this->form_validation->set_rules('confsenha', 'Confirmar Senha', 'trim|required');

        if($this->form_validation->run() == FALSE){
            $this->editar($id);
        }else{
            $data['nomeUsuario'] = mb_strtoupper($this->input->post('nomeUsuario'));
            $data['login'] = $this->input->post('login');
            $data['senha'] = $this->input->post('senha');
            $data['ativo'] = $this->input->post('ativo');
            $data['PerfilUsuario_idPerfilUsuario'] = $this->input->post('perfilUsuario');
            $this->db->where('idUsuario',$id);
            $this->db->update('Usuario',$data);
            redirect("usuarios");
        }
    }


}