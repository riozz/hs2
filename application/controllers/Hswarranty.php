<?php
  class Hswarranty extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->helper('url_helper');
      $this->load->helper('url');
      $this->load->library('session');
      $this->load->library('staffInfo');
      $this->load->library('form_validation');
    }

    public function index($page = 'index')
    {
        if ( ! file_exists(APPPATH.'views/hswarranty/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view('hswarranty/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
    public function view($page = 'home')
    {
	$this->load->helper('url');
        if ( ! file_exists(APPPATH.'views/hswarranty/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view('hswarranty/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

}

