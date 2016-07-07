<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadastro extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
            redirect('home');
        }
    }

    public function  invalidar(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('observacao','Observação','required');
        if($this->form_validation->run() == FALSE){
            $this->pre_validar($this->input->post('idPreCadastro'));
        }else{
            $data['mensagem'] = $this->input->post('observacao');
            $data['email'] = $this->input->post('email');
            $this->enviar_email($data);
            unlink('assets/comp/'.$this->input->post('comprovante'));
            $this->excluir($this->input->post('idPreCadastro'));
            redirect("menu");
        }
    }


    public function  pre_validar($idPreCadastro){
        $data['vinculos'] = $this->db->get('Vinculo')->result();
        $data['setores'] = $this->db->get('Setor')->result();
        $data['tipoDocumentos'] = $this->db->get('TipoDocumento')->result();
        $data['cidades'] = $this->db->get('Cidade')->result();
        $this->db->where('idPreCadastro',$idPreCadastro);
        $data['cliente'] = $this->db->get('PreCadastro')->result();
        $this->load->view('html_header');
        $this->load->view('menu');
        $this->load->view('validar_precadastro',$data);
        $this->load->view('rodape');
        $this->load->view('html_footer');
    }


    public function  validar(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nome','Nome','required');
        $this->form_validation->set_rules('cpf','CPF','required');
        $this->form_validation->set_rules('email','e-mail','required');
        $this->form_validation->set_rules('rua','Rua','required');
        $this->form_validation->set_rules('bairro','Bairro','required');
        $this->form_validation->set_rules('numero','Número','required');
        $this->form_validation->set_rules('cidade','Cidade','required');
        $this->form_validation->set_rules('celular','Celular','required|valid_phone');
        $this->form_validation->set_rules('telefone','Telefone','valid_phone');
        if($this->form_validation->run() == FALSE){
            $this->pre_validar($this->input->post('idPreCadastro'));
        }else{
            $data['nomeCliente'] = mb_strtoupper($this->input->post('nome'));
            $data['idVinculo'] = $this->input->post('vinculo');
            $data['idSetor'] = $this->input->post('setor');
            $data['idTipoDocumento'] = '2';
            $data['numDoc'] = $this->input->post('cpf');
            $data['telefone'] = $this->input->post('telefone');
            $data['celular'] = $this->input->post('celular');
            $data['email'] = mb_strtolower($this->input->post('email'));
            $data['rua'] = mb_strtoupper($this->input->post('rua'));
            $data['numero'] = $this->input->post('numero');
            $data['complemento'] = $this->input->post('complemento');
            $data['bairro'] = mb_strtoupper($this->input->post('bairro'));
            $data['cep'] = $this->input->post('cep');
            $data['idCidade'] = $this->input->post('cidade');
            if($this->db->insert('Cliente',$data)){
                $this->excluir($this->input->post('idPreCadastro'));
                unlink('assets/comp/'.$this->input->post('comprovante'));
                $this->db->where('numDoc',$data['numDoc']);
                $this->db->where('email',$data['email']);
                $cliente = $this->db->get('View1Cliente')->result();
                $this->editar($cliente[0]->idCliente);
            }

        }
    }


    private function excluir($id){
        $this->db->where('idPreCadastro',$id);
        $this->db->delete('PreCadastro');
    }


    private function editar($idCliente){
        $this->db->where('idCliente',$idCliente);
        $data2['clientes'] = $this->db->get('View1Cliente')->result();

        if($data2['clientes'][0]->idVinculo == 1 || $data2['clientes'][0]->idVinculo == 5 ){
            $data2['usuario'] = $data2['clientes'][0]->numDoc;
        }else{
            $arrayUsuario = explode("@",$data2['clientes'][0]->email);
            $data2['usuario'] = $arrayUsuario[0];
        }
        $data2['senha'] = $this->geraSenha(6);
        $this->load->view('html_header');
        $this->load->view('menu');
        $this->load->view('editar_ldap_precadastro', $data2);
        $this->load->view('rodape');
        $this->load->view('html_footer');
    }



    public function adicionar()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('usuario','Usuário','required|min_length[6]|max_length[25]|is_unique[Usuario.login]');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]|max_length[12]');
        $this->form_validation->set_rules('dataExpiracao','Data Expiração','trim|required|valid_date');

        if($this->form_validation->run() == FALSE){
            $this->editar($this->input->post('idCliente'));
        }else{
            $this->load->helper('date');
            $data['idCliente'] = $this->input->post('idCliente');
            $data['usuario'] = mb_strtolower($this->input->post('usuario'));
            $data['senha'] = "{SHA}" . base64_encode( pack( "H*", sha1($this->input->post('senha')) ) );
            //$this->input->post('senha');
            $data['dataExpiracao'] = mdate('%Y-%m-%d',strtotime(str_replace('/', '-',$this->input->post('dataExpiracao'))));
            $data['ativo'] = $this->input->post('ativo');
            $data['ativarPagWeb'] = $this->input->post('ativarPagWeb');

            if($this->db->insert('Ldap',$data)){
                $this->db->where('idCliente',$data['idCliente']);
                $cliente=$this->db->get('ViewLdap')->result();
                $dataldap['uidnumber']= $cliente[0]->uidnumber;
                $dataldap['uid']= $data['usuario'];
                $nome = $this->removerAcento($cliente[0]->nomeCliente);
                $arrayNome = explode(" ",$nome);
                $dataldap['cn']= array_shift($arrayNome);
                $dataldap['givenName']= $dataldap['cn'];
                $snome = implode(" ",$arrayNome);
                $dataldap['sn']= $snome;
                $dataldap['gecos']= $nome;
                $dataldap['mail']= $cliente[0]->email;
                $dataldap['gidnumber']= $this->grupo($cliente[0]->idVinculo);
                $dataldap['homedirectory']= "/home/".$data['usuario'];
                $dataldap['loginshell']= $this->loginShell($cliente[0]->ativarPagWeb);
                $dataldap['objectclass'][0] = "top";
                $dataldap['objectclass'][1] = "person";
                $dataldap['objectclass'][2] = "organizationalPerson";
                $dataldap['objectclass'][3] = "inetOrgPerson";
                $dataldap['objectclass'][4] = "posixAccount";
                $dataldap['objectclass'][5] = "shadowAccount";
                $dataldap['shadowlastchange']= date("U", strtotime("now"));
                $dataldap['shadowmax']= date("U",strtotime(str_replace('/', '-',$this->input->post('dataExpiracao'))));
                $dataldap['shadowmin']= "0";
                $dataldap['shadowwarning']= "30";
                $dataldap['shadowExpire']= date("U",strtotime(str_replace('/', '-',$this->input->post('dataExpiracao'))));
                $dataldap['shadowInactive']= "2";
                $dataldap['userpassword']= $data['senha'];

                if($this->adicionar_ldap($dataldap)){
		    if($data['ativarPagWeb']==1){
                        //echo "</br>Entrou ativar";
                        $grupo =  $this->grupoNome($cliente[0]->idVinculo);
                        $cmd = "sudo /home/grecarc/public_html/tmp/mkhomedir.sh ".$data['usuario']." ".$grupo;
                        //echo "</br>".$cmd;
                        $data['output'] = shell_exec($cmd);
                        echo $data['output'];
                   }  

                    $link = anchor(base_url('redefinirsenha'),'Clique aqui para redefinir sua senha.');
                    $mensagem = '<p>Sua solicitação de cadastro para uso de recursos da rede do ICET foi validada com sucesso.
Utilize o usuário e senha abaixo para acessar a rede.</p></br><p>'.'Usuário: '.$data['usuario'].'</p></br><p>'.'Senha: '.$this->input->post('senha').'</p></br></br>'.'Caso queira
redefinir sua senha clique no link abaixo:</br>';
                    $mensagem.= $link;
                    $datamail['mensagem'] = $mensagem;
                    $datamail['email'] = $cliente[0]->email;
                    $this->enviar_email($datamail);
                    redirect("menu");
                }else{
                    echo "Erro ao inserir no ldap.";
                }
            }else{
                echo "Erro ao inserir no banco de dados.";           }
        }
    }


    private  function geraSenha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
        $lmin = 'abcdefghijklmnopqrstuvwxyz';
        $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '1234567890';
        $simb = '!@#$%*-';
        $retorno = '';
        $caracteres = '';

        $caracteres .= $lmin;
        if ($maiusculas) $caracteres .= $lmai;
        if ($numeros) $caracteres .= $num;
        if ($simbolos) $caracteres .= $simb;

        $len = strlen($caracteres);
        for ($n = 1; $n <= $tamanho; $n++) {
            $rand = mt_rand(1, $len);
            $retorno .= $caracteres[$rand-1];
        }
        return $retorno;
    }



    private function grupo($vinculo){
        switch($vinculo){
            case 1:
                $gidNumber = "998";
                break;
            case 2:
                $gidNumber = "1004";
                break;
            case 3:
                $gidNumber = "1006";
                break;
            case 4:
                $gidNumber = "999";
                break;
            case 5:
                $gidNumber = "1016";
                break;
            default:
                $gidNumber = NULL;
        }

        return $gidNumber;

    }



    private function grupoNome($vinculo){
        switch($vinculo){
            case 1:
                $gidNumber = "alunos";
                break;
            case 2:
                $gidNumber = "professores";
                break;
            case 3:
                $gidNumber = "tecnicos";
                break;
            case 4:
                $gidNumber = "visitante";
                break;
            case 5:
                $gidNumber = "posgraduacao";
                break;
            default:
                $gidNumber = NULL;
        }

        return $gidNumber;

    }




    private function loginShell($pgWeb){
        switch($pgWeb){
            case 0:
                $shell = "/bin/MySecureShell";
                break;
            case 1:
                $shell = "/bin/bash";
                break;
            default:
                $shell = NULL;
        }

        return $shell;

    }

    private function removerAcento($string){
        $string = strtr(utf8_decode($string),
            utf8_decode('ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'),
            'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy');
        return $string;

    }


    private function  adicionar_ldap($info = array())
    {
        $ldaphost = "10.0.0.7";  // your ldap servers
        $ldapport = 389;
        $ldaprdn  = 'cn=admin,dc=icet,dc=ufam,dc=edu,dc=br';     // ldap rdn or dn
        $ldappass = 'i7uf4mCPD';  // associated password
        $ldapaddn  = 'uid='.$info['uid'].',ou=Usuarios,dc=icet,dc=ufam,dc=edu,dc=br';

        $ds = ldap_connect($ldaphost,$ldapport);

        if ($ds)
        {
            ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
            $r = ldap_bind($ds,$ldaprdn,$ldappass);
            if ($r) {
                //print_r($info);
                if($r = ldap_add($ds, $ldapaddn, $info)){
                    echo "Entidade inserida com sucesso.";
                    return TRUE;
                }else{
                    echo "A inserção da Entidade falhou.";
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


    public function enviar_email($data = array())
    {
        $ci = get_instance();
        $ci->load->library('email');
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'cpd.icet.ufam@gmail.com';
        $config['smtp_pass'] = '!C#TUF$M$M$&)N$%!T$';
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";

        $ci->email->initialize($config);

        $ci->email->from('cpd.icet.ufam@gmail.com', 'Sistema Grecarc ICET/UFAM');
        $list = array($data['email']);
        $ci->email->to($list);
        $ci->email->subject('Confirmação de Cadastro Grecarc');
        $ci->email->message($data['mensagem']);
        if($ci->email->send()){
            echo "Email enviado com sucesso.";
        }else{
            echo "Erro ao enviar o e-mail.";
        }

    }


	public function buscar(){
		$this->load->library('table');
		$busca = $this->input->post('busca');	

		$this->db->like('nomeCliente',$busca);
		$this->db->or_like('email',$busca);
		$this->db->order_by("nomeCliente", "asc"); 
        $data['clientes'] = $this->db->get('PreCadastro')->result();

        $this->load->view('html_header');
        $this->load->view('menu');
        $this->load->view('precadastros_pendentes',$data);
        $this->load->view('rodape');
        $this->load->view('html_footer');
	}

    function get_autocomplete(){
        $this->load->model('busca_model');
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $busca = $this->busca_model->get_datapre($q);
            echo json_encode($busca);
        }
    }

}
