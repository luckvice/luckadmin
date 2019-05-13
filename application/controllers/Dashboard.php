<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dashboard extends CI_Controller {

    public function __Construct() {
        parent::__Construct();
        if(!$this->session->userdata('logado')) {
            redirect(base_url());
        }
        $this->load->model('admin_model');
    }

    public function index() {
        $data = array(
            'formTitle' => 'DashBoard',
            'title' => 'Painel de Controle',
            'totalUsers' => $this->admin_model->get_total_users_list(),
            'totalJogos' => $this->admin_model->get_total_jogos_list(),
        );

        $this->load->view('frame/header_view');
        $this->load->view('frame/sidebar_view');
        $this->load->view('dashboard', $data);
        $this->load->view('frame/footer_view');
    }


}

/* End of file */
