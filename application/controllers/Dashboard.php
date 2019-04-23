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
    }

    public function index() {
        $this->load->view('frame/header_view');
        $this->load->view('frame/sidebar_view');
        $this->load->view('dashboard');
        $this->load->view('frame/footer_view');
    }


}

/* End of file */
