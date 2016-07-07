<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Precadastro extends CI_Controller {
    public function __construct(){
        parent::__construct();

    }
    
    
    public function index()
    {
        $data['vinculos'] = NULL;
        $this->load->view('html_header');
        $this->load->view('precadastro',$data);
        $this->load->view('html_footer');
    }

    public function dadosPessoais()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome','Nome Completo','required');
        $this->form_validation->set_rules('cpf','CPF','required|valid_cpf||is_unique[Cliente.numDoc]|is_unique[PreCadastro.cpf]');
        $this->form_validation->set_rules('email','e-mail','required|valid_email|matches[confemail]|is_unique[Cliente.email]|is_unique[PreCadastro.email]');
        if($this->form_validation->run() == FALSE){
            $this->index();
        }else {
            $this->dadosPessoais2();
        }
    }


    private function dadosPessoais2(){
        $this->load->library('table');
        $data['vinculos'] = $this->db->get('Vinculo')->result();
        $data['setores'] = $this->db->get('Setor')->result();
        $data['tipoDocumentos'] = $this->db->get('TipoDocumento')->result();
        $data['cidades'] = $this->db->get('Cidade')->result();
        $data['nome'] = mb_strtoupper($this->input->post('nome'));
        $data['cpf'] = preg_replace( '#[^0-9]#', '', $this->input->post('cpf') );
        $data['email'] = mb_strtolower($this->input->post('email'));
        $this->load->view('html_header');
        $this->load->view('precadastro', $data);
        $this->load->view('html_footer');
    }



    public function sucesso_precadastro(){
        $this->load->view('html_header');
        $this->load->view('precadastro_com_sucesso');
        $this->load->view('html_footer');
    }


    public function erro_precadastro(){
        $this->load->view('html_header');
        $this->load->view('precadastro_erro');
        $this->load->view('html_footer');
    }


    public function adicionar()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome','Nome Completo','required');
        $this->form_validation->set_rules('cpf','CPF','required');
        $this->form_validation->set_rules('email','e-mail','required');
        $this->form_validation->set_rules('rua','Rua','required');
        $this->form_validation->set_rules('bairro','Bairro','required');
        $this->form_validation->set_rules('numero','Número','required');
        $this->form_validation->set_rules('cidade','Cidade','required');
        $this->form_validation->set_rules('celular','Celular','required|valid_phone');
        $this->form_validation->set_rules('telefone','Telefone','valid_phone');

        if($this->form_validation->run() == FALSE){
            $this->dadosPessoais2();
        }else{
            $config['upload_path'] = './assets/comp';
            $config['allowed_types'] = 'jpg|png|pdf';
            $config['max_size'] = '2048';
            $config['encrypt_name'] = true;
            $this->load->library('upload',$config);
            if(! $this->upload->do_upload()){
                echo $this->upload->display_errors();
                echo "<a href='javascript:history.go(-1)'>Voltar e corrigir.</a>";
            }else{
                $data['nomeCliente'] = mb_strtoupper($this->input->post('nome'));
                $data['idVinculo'] = $this->input->post('vinculo');
                $data['idSetor'] = $this->input->post('setor');
                $data['cpf'] = preg_replace( '#[^0-9]#', '', $this->input->post('cpf') );
                $data['telefone'] = preg_replace( '#[^0-9]#', '',$this->input->post('telefone') );
                $data['celular'] = preg_replace( '#[^0-9]#', '',$this->input->post('celular') );
                $data['email'] = mb_strtolower($this->input->post('email'));
                $data['rua'] = mb_strtoupper($this->input->post('rua'));
                $data['numero'] = $this->input->post('numero');
                $data['complemento'] = $this->input->post('complemento');
                $data['bairro'] = mb_strtoupper($this->input->post('bairro'));
                $data['cep'] = preg_replace( '#[^0-9]#', '',$this->input->post('cep') );
                $data['idCidade'] = $this->input->post('cidade');
                $arquivo_upado = $this->upload->data();
                $data['comprovante'] = $arquivo_upado['file_name'];
                if($this->db->insert('PreCadastro',$data)) {
                    redirect('precadastro/sucesso_precadastro');
                }else{
                    redirect('precadastro/erro_precadastro');
                }
            }
        }
    }
    
}