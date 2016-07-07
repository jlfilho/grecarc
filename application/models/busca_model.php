<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');




class Busca_model extends CI_Model{


    function get_data($q){
        $this->db->select('nomeCliente');
        $this->db->like('nomeCliente', $q);
        $query = $this->db->get('View1Cliente','5');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = stripslashes($row['nomeCliente']); //build an array
            }

            return $row_set;
        }
    }


    function get_datapre($q){
        $this->db->select('nomeCliente');
        $this->db->like('nomeCliente', $q);
        $query = $this->db->get('PreCadastro','5');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = stripslashes($row['nomeCliente']); //build an array
            }

            return $row_set;
        }
    }

}


