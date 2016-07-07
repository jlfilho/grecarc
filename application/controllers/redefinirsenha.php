<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Redefinirsenha extends CI_Controller {
	public function __construct(){
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->view('html_header');
		$this->load->view('redefinirsenha');
		$this->load->view('html_footer');
	}


	public function redefinir()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('usuario','Usuário','callback_valid_user');
		if($this->form_validation->run() == FALSE){
			$this->index();
		}else{
			$this->db->where('usuario',$this->input->post('usuario'));
			$data['cliente'] = $this->db->get('ViewLdap')->result();
			$this->load->view('html_header');
			$this->load->view('confirmaremail',$data);
			$this->load->view('html_footer');
		}
	}


	public function enviar_email()
	{
		$usuario = $this->input->post('usuario');
		$data['link'] = base64_encode($usuario);
		$data['data'] = date('Y-m-d H:i:s', strtotime('+1 day'));
		$data2['email']= $this->input->post('email');;

		$link = anchor(base_url('redefinirsenha/recuperar/'.$data['link']),'Clique aqui para redefinir sua senha.');

		$mensagem = '<p> Recebemos uma solicitação de redefinição de senha para o seu usuário. Caso não tenha sido solicitado por
		você desconsidere este e-mail, caso contrário clique no link abaixo.</br>
		</p> ';
		$mensagem.= $link;

		$ci = get_instance();
		$ci->load->library('email');
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.gmail.com';
		$config['smtp_port'] = '465';
		$config['smtp_user'] = 'cpd.icet.ufam@gmail.com';
		$config['smtp_pass'] = 'xxxxx';//substituir pela senha do e-mail
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";

		$ci->email->initialize($config);

		$ci->email->from('cpd.icet.ufam@gmail.com', 'Sistema Grecarc ICET/UFAM');
		$list = array($data2['email']);
		$ci->email->to($list);
		$ci->email->subject('Redefinição de senha Grecarc');
		$ci->email->message($mensagem);
		if($ci->email->send()){
			$this->db->insert('Codigos',$data);
			$this->load->view('html_header');
			$this->load->view('emailenviado',$data2);
			$this->load->view('html_footer');
		}else{
			$this->load->view('html_header');
			$this->load->view('emailfalhou');
			$this->load->view('html_footer');
			//echo $this->email->print_debugger();
		}

	}


	public function recuperar($link){
		$this->load->helper('date');
		$agora = mdate('%Y-%m-%d %H:%i:%s',strtotime("now"));
		$this->db->where('link',$link);
		$this->db->where('data >',$agora);
		$codigo = $this->db->get('Codigos')->result();


		if(count($codigo) > 0){
			$data['usuario'] = base64_decode($link);
			$data['link'] = $link;
			$this->load->view('html_header');
			$this->load->view('recuperar',$data);
			$this->load->view('html_footer');
		}else{
			$this->load->view('html_header');
			$this->load->view('redefinicaoexpirou');
			$this->load->view('html_footer');
		}

	}

	public function salvar_alteracao(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('senha1', 'Senha', 'trim|required|min_length[6]|max_length[12]|matches[confsenha]|sha1');
		$this->form_validation->set_rules('confsenha', 'Confirmar Senha', 'trim|required');
		$usuario = $this->input->post('usuario');
		$data['senha'] = "{SHA}" . base64_encode( pack( "H*", sha1( $this->input->post('senha1') ) ) );
		//sha1($this->input->post('senha1'));
		if($this->form_validation->run() == FALSE){
			$this->recuperar($this->input->post('link'));
		}else{

			$this->db->where('usuario',$usuario);
			$this->db->update('Ldap',$data);

			if($this->db->update('Ldap',$data)){
				$this->db->where('usuario',$usuario);
				$cliente=$this->db->get('ViewLdap')->result();

				$dataldap['uidnumber']= $cliente[0]->uidnumber;
				$dataldap['uid']= $cliente[0]->usuario;
				$dataldap['shadowlastchange']= date("U", strtotime("now"));
				$dataldap['userpassword']= $data['senha'];

				if($this->atualizar_ldap($dataldap)){
					$this->db->where('link',$this->input->post('link'));
					$this->db->delete('Codigos');
					$this->load->view('html_header');
					$this->load->view('alteradocomsucesso');
					$this->load->view('html_footer');
				}else{
					echo "Erro ao atualizar no ldap.";
				}
			}else{
				echo "Erro ao atualizar no banco de dados.";
			}
		}
	}



	function valid_user()
	{
		$this->db->where('usuario',$this->input->post('usuario'));
		$data['cliente'] = $this->db->get('ViewLdap')->result();
		if(count($data['cliente'])==1) {
			return TRUE;
		}else{
			$this->form_validation->set_message('valid_user', 'O usuário informado não existe na base de dados!');
			return FALSE;
		}
	}


	private function  atualizar_ldap($info = array())
	{
		$ldaphost = "10.0.0.7";  // your ldap servers
		$ldapport = 389;
		$ldaprdn  = 'cn=admin,dc=icet,dc=ufam,dc=edu,dc=br';     // ldap rdn or dn
		$ldappass = 'xxx';  // associated password
		$ldapaddn  = 'uid='.$info['uid'].',ou=Usuarios,dc=icet,dc=ufam,dc=edu,dc=br';

		$ds = ldap_connect($ldaphost,$ldapport);

		if ($ds)
		{
			ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
			$r = ldap_bind($ds,$ldaprdn,$ldappass);
			if ($r) {
				//print_r($info);
				if($r = ldap_modify($ds, $ldapaddn, $info)){
					//echo "Entidade atualizada com sucesso.";
					return TRUE;
				}else{
					echo "A atualizaçaõ da Entidade falhou.";
					return FALSE;
				}
			} else {
				echo "LDAP bind falhou.";
				return FALSE;
			}
			ldap_close($ds);
		} else {
			echo "Não foi possível conectar o servidor Ldap.";
			return FALSE;
		}
	}


	
}


