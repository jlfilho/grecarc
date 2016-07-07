<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ldap extends CI_Controller {
    public function __construct(){
        parent::__construct();
        if(!$this->session->userdata('session_id') || !$this->session->userdata('logado')){
            redirect('home');
        }
    }

    public function editar($idCliente){
    	$this->load->library('table');
        $this->load->helper('date');

        $this->db->where('idCliente',$idCliente);
        $data['clientes'] = $this->db->get('ViewLdap')->result();

        if(count($data['clientes'])==1){
            $this->load->view('html_header');
            $this->load->view('menu');
            $this->load->view('editar_ldap', $data);
            $this->load->view('rodape');
            $this->load->view('html_footer');
        }else {
            $this->db->where('idCliente',$idCliente);
            $data['clientes'] = $this->db->get('View1Cliente')->result();
            $this->load->view('html_header');
            $this->load->view('menu');
            $this->load->view('ldap', $data);
            $this->load->view('rodape');
            $this->load->view('html_footer');
        }

    }



	public function adicionar()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('usuario','Usuário','required|min_length[6]|max_length[25]|is_unique[Usuario.login]');
		$this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]|max_length[12]|matches[confsenha]|sha1');
        $this->form_validation->set_rules('confsenha', 'Confirmar Senha', 'trim|required');
		$this->form_validation->set_rules('dataExpiracao','Data Expiração','trim|required|valid_date');
        
        if($this->form_validation->run() == FALSE){
            $this->editar($this->input->post('idCliente'));
        }else{
            $this->load->helper('date');
            $data['idCliente'] = $this->input->post('idCliente');
           	$data['usuario'] = mb_strtolower($this->input->post('usuario'));
           	$data['senha'] = "{SHA}" . base64_encode( pack( "H*", $this->input->post('senha') ) );
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
                   redirect('ldap/editar/'.$this->input->post('idCliente'));
                }else{
                    echo "Erro ao inserir no ldap.";
                }
            }else{
                echo "Erro ao inserir no banco de dados.";
            }
        }
    }


	
	public function alterar(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('usuario','Usuário','required|min_length[6]|max_length[25]|is_unique[Usuario.login]');
        $this->form_validation->set_rules('senha', 'Senha', 'trim|required|min_length[6]|max_length[12]|matches[confsenha]|sha1');
        $this->form_validation->set_rules('confsenha', 'Confirmar Senha', 'trim|required');
        $this->form_validation->set_rules('dataExpiracao','Data Expiração','trim|required|valid_date');

        if($this->form_validation->run() == FALSE){
            $this->editar($this->input->post('idCliente'));
        }else{
            $this->load->helper('date');
            $data['idCliente'] = $this->input->post('idCliente');
            $data['usuario'] = mb_strtolower($this->input->post('usuario'));
            $data['senha'] = "{SHA}" . base64_encode( pack( "H*", $this->input->post('senha') ) );
                //$this->input->post('senha');
            $data['dataExpiracao'] = mdate('%Y-%m-%d',strtotime(str_replace('/', '-',$this->input->post('dataExpiracao'))));
            $data['ativo'] = $this->input->post('ativo');
            $data['ativarPagWeb'] = $this->input->post('ativarPagWeb');
            $this->db->where('idCliente',$this->input->post('idCliente'));
             if($this->db->update('Ldap',$data)){
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
                if($this->atualizar_ldap($dataldap)){
		     if($data['ativarPagWeb']==1){
                        echo "</br>Entrou ativar";
                        $grupo =  $this->grupoNome($cliente[0]->idVinculo);
                        $cmd = "sudo /home/grecarc/public_html/tmp/mkhomedir.sh ".$data['usuario']." ".$grupo;
                        //echo "</br>".$cmd;
                        $data['output'] = shell_exec($cmd);
                        echo $data['output'];
                      }	
                    redirect('ldap/editar/'.$this->input->post('idCliente'));
                }else{
                    echo "Erro ao atualizar no ldap.";
                }
            }else{
                echo "Erro ao atualizar no banco de dados.";
            }

        }
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
        $ldappass = 'xxxxxx';  // associated password
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


    private function  atualizar_ldap($info = array())
    {
        $ldaphost = "10.0.0.7";  // your ldap servers
        $ldapport = 389;
        $ldaprdn  = 'cn=admin,dc=icet,dc=ufam,dc=edu,dc=br';     // ldap rdn or dn
        $ldappass = 'xxxxx';  // associated password
        $ldapaddn  = 'uid='.$info['uid'].',ou=Usuarios,dc=icet,dc=ufam,dc=edu,dc=br';

        $ds = ldap_connect($ldaphost,$ldapport);

        if ($ds)
        {
            ldap_set_option($ds, LDAP_OPT_PROTOCOL_VERSION, 3);
            $r = ldap_bind($ds,$ldaprdn,$ldappass);
            if ($r) {
                //print_r($info);
                if($r = ldap_modify($ds, $ldapaddn, $info)){
                    echo "Entidade atualizada com sucesso.";
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
