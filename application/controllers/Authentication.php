<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Authentication extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        $this->load->model("Auth_model");
    }

    public function index() {
    
        if($this->session->userdata('logado')) {
            redirect(base_url("dashboard"));
        }else {
            $data = array('alert' => false);
            $this->load->view('login',$data);
        }
    }

    private function ajax_checking(){
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
        }
    }

    public function login(){
        $postData = $this->input->post();
        $validate = $this->Auth_model->validate_login($postData);
        if ($validate){
            $newdata = array(
                'email'     => $validate[0]->email,
                'nome'      => $validate[0]->nome,
                'grupo'     => $validate[0]->grupo,
                'user_id'   => $validate[0]->user_id,
                'url_img'   => $validate[0]->url_img,
                'logado'    => TRUE,
              
            );
            $this->session->set_userdata($newdata);
            redirect(base_url("dashboard")); 
        }
        else{
            $data = array('alert' => true);
            $this->load->view('login',$data);
        }
     
    }

    function mudar_senha(){
        $this->ajax_checking();

        $postData = $this->input->post();
        $update = $this->Auth_model->mudar_senha($postData);
        if($update['status'] == 'success')
            $this->session->set_flashdata('success', 'Sua senha foi alterada com sucesso!');

        echo json_encode($update);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }


}

/* End of file */
