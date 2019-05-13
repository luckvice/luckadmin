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



    /*[Administrar jogos]*/


    public function games_list_admin(){

        $data = array(
            'formTitle'         => 'Gerenciamento de jogos',
            'title'             => 'Gerenciamento de jogos',
            'games'             => $this->admin_model->get_games_list(),
            'categorias'        => $this->admin_model->get_categorias_list(),
            'plataformas'       => $this->admin_model->get_plataformas_list(),
            'desenvolvedoras'   => $this->admin_model->get_desenvolvedor_list(),
            'publishers'        => $this->admin_model->get_publishers_list(),
        );

        $this->load->view('frame/header_view');
        $this->load->view('frame/sidebar_view');
        $this->load->view('admin/games_list_admin', $data);

    }
    /* End [Administrar jogos] */

     /*[Administrar Usuarios]*/
    public function user_list(){

        $data = array(
            'formTitle' => 'Gerenciamento de usuários',
            'title'     => 'Gerenciamento de usuários',
            'users'     => $this->admin_model->get_user_list(),
        );

        $this->load->view('frame/header_view');
        $this->load->view('frame/sidebar_view');
        $this->load->view('admin/user_list', $data);

    }
    function novo_jogo(){
        $this->ajax_checking();

        $postData = $this->input->post();
        echo var_dump($postData);
        $insert = $this->admin_model->insert_jogo($postData);
        if($insert['status'] == 'success')
            $this->session->set_flashdata('success', 'Jogo '.$postData['jogo'].' Foi criado com sucesso!');

        echo json_encode($insert);
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

    
    function desativarGame($jogo,$id){
        $this->ajax_checking();

        $update = $this->admin_model->desativaGame_model($jogo,$id);
        if($update['status'] == 'success')
            $this->session->set_flashdata('success', 'Jogo '.$jogo.' Foi deletado com sucesso');

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
