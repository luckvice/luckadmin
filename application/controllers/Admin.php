<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('logado')) {
            redirect(base_url());
        }

        if($this->session->userdata('grupo') != 'admin'){
            redirect(base_url());
        }

        $this->load->model('admin_model');
    }
    

    private function ajax_checking(){
        if (!$this->input->is_ajax_request()) {
            redirect(base_url());
        }
    }

    public function user_list(){

        $data = array(
            'formTitle' => 'Gerenciamento de usuários',
            'title' => 'Gerenciamento de usuários',
            'users' => $this->admin_model->get_user_list(),
        );

        $this->load->view('frame/header_view');
        $this->load->view('frame/sidebar_view');
        $this->load->view('admin/user_list', $data);

    }

    function create_usuario(){
        $this->ajax_checking();

        $postData = $this->input->post();
        echo var_dump($postData);
        $insert = $this->admin_model->insert_user($postData);
        if($insert['status'] == 'success')
            $this->session->set_flashdata('success', 'Usuario '.$postData['email'].' Foi criado com sucesso!');

        echo json_encode($insert);
    }

    function update_usuario(){
        $this->ajax_checking();

        $postData = $this->input->post();
        $update = $this->admin_model->update_usuario($postData);
        if($update['status'] == 'success')
            $this->session->set_flashdata('success', 'User '.$postData['email'].' Foi alterado com sucesso!');

        echo json_encode($update);
    }

    function desativar_usuario($email,$id){
        $this->ajax_checking();

        $update = $this->admin_model->desativar_usuario($email,$id);
        if($update['status'] == 'success')
            $this->session->set_flashdata('success', 'Usuario '.$email.' Foi deletado com sucesso');

        echo json_encode($update);
    }

    function reset_senha($email,$id){
        $this->ajax_checking();

        $update = $this->admin_model->reset_senha($email,$id);
        if($update['status'] == 'success')
            $this->session->set_flashdata('success', 'Usuario '.$email.' Senha resetada com sucesso!');

        echo json_encode($update);
    }

    function log_atv(){
        $data = array(
            'formTitle' => 'Log de atividade',
            'title' => 'Log de atividade',
        );
        $this->load->view('frame/header_view');
        $this->load->view('frame/sidebar_view');
        $this->load->view('admin/log_atv', $data);

    }

    function get_log_atv(){
        $this->ajax_checking();
        echo  json_encode( $this->admin_model->get_log_atv() );
    }



}

/* End of file */
