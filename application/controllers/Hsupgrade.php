<?php
  class Hsupgrade extends CI_Controller {
    public function __construct() {
      parent::__construct();
      $this->load->helper('url_helper');
      $this->load->helper('url');
      $this->load->library('session');
      $this->load->library('staffInfo');
      $this->load->library('upgradeInfo');
      $this->load->library('form_validation');
      //$this->load->library('');
    }

    public function index($oid = 0, $uid = 0)
    {
      log_message('debug', 'zzz[index.php:16]');
      $page = 'index';
      if ( ! file_exists(APPPATH.'views/hsupgrade/'.$page.'.php'))
      {
              // Whoops, we don't have a page for that!
        show_404();
      }

      if (strlen($oid)>2) $data['fullorder_id'] = $oid;
      else $data['fullorder_id'] = $this->input->post('orderid');
      $data['title'] = ucfirst($page); // Capitalize the first letter
      $data['staff_id'] = $this->input->post('staffid');
      $data['userlogin'] = $this->input->post('login');
      $data['action'] = $this->input->post('actions');
      $data['id'] = $uid; //upgradeid
      if (isset($data['action'])) {
        $this->staffinfo->getStaffInfo($data['staff_id'],$data['fullorder_id']);
      } else {
        $data['staff_id'] = $this->session->userdata('s_staffid');
        $data['fullorder_id'] = $this->session->userdata('s_orderid');
      }

      if (strlen($data['staff_id'])>0) {
        $this->load->view('templates/header', $data);
        $this->load->view('hsupgrade/'.$page, $data);
        $this->load->view('templates/footer', $data);
      } else {
        redirect(HS_V1.'/mainpage.php');
      }
    }

    public function view($page = 'home')
    {
	$this->load->helper('url');
        if ( ! file_exists(APPPATH.'views/hsupgrade/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        $this->load->view('templates/header', $data);
        $this->load->view('hsupgrade/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

}

