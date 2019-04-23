<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Auth_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function validate_login($postData){
        $this->db->select('*');
        $this->db->where('email', $postData['email']);
        $this->db->where('senha', md5($postData['senha']));
        $this->db->where('status', 1);
        $this->db->from('usuario');
        $query=$this->db->get();
        if ($query->num_rows() == 0)
            return false;
        else
            return $query->result();
    }

    function mudar_senha($postData){
        $this->load->model('admin_model');
        $validate = false;

        $oldData = $this->admin_model->get_user_by_id($this->session->userdata('user_id'));

        if($oldData[0]['senha'] == md5($postData['senhaAtual']))
            $validate = true;

        if($validate){
            $data = array(
                'senha' => md5($postData['novaSenha']),
            );
            $this->db->where('user_id', $this->session->userdata('user_id'));
            $this->db->update('usuario', $data);

            $module = "Mudar senha";
            $activity = "Setando a senha";
            $this->admin_model->insert_log($activity, $module);
            return array('status' => 'success', 'message' => '');
        }else{
            return array('status' => 'invalid', 'message' => '');
        }

    }
}

/* End of file  */
