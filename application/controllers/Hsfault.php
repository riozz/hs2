<?php
  class Hsfault extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper('url_helper');
      $this->load->helper('url');
      $this->load->library('session');
      $this->load->library('staffInfo');
      $this->load->library('faultInfo');
    }

    //public function index($page = 'index')
    public function index($oid = 0, $fid = 0)
    {
	$page = 'index';
        if ( ! file_exists(APPPATH.'views/hsfault/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter
        //$data['orderid'] = $this->input->post('orderid');
        //$data['staffid'] = $this->input->post('staffid');
        //$data['userlogin'] = $this->input->post('login');
        if (strlen($oid)>2)  $data['orderid'] = $oid;
        else $data['orderid'] = "H201702001917";
        $data['staffid'] = "1352731";
        $data['userlogin'] = "1";
        $data['faultid'] = $fid;
        $this->staffinfo->getStaffInfo($data['staffid']);

        $this->load->view('templates/header', $data);
        $this->load->view('hsfault/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
    public function view($page = 'index')
    {
	$this->load->helper('url');
        if ( ! file_exists(APPPATH.'views/hsfault/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view('hsfault/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

}

