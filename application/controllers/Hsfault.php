<?php
  class Hsfault extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper('url_helper');
      $this->load->helper('url');
      $this->load->library('session');
      $this->load->library('staffInfo');
      $this->load->library('faultInfo');
      $this->load->library('session');
    }

    public function index($oid = 0, $fid = 0)
    {
	$page = 'index';
        if ( ! file_exists(APPPATH.'views/hsfault/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        if (strlen($oid)>2)  $data['orderid'] = $oid;
        else $data['orderid'] = $this->input->post('orderid');
        $data['title'] = ucfirst($page); // Capitalize the first letter
        $data['staffid'] = $this->input->post('staffid');
        $data['userlogin'] = $this->input->post('login');
        $data['action'] = $this->input->post('actions');
        $data['faultid'] = $fid;
	if (isset($data['action'])) {
          $this->staffinfo->getStaffInfo($data['staffid'],$data['orderid']);
	} else {
	  $data['staffid'] = $this->session->userdata('s_staffid');
	  $data['orderid'] = $this->session->userdata('s_orderid');
        } 
	/*else {
          $sessiondata = array(
		  'staffid' => $data['staffid'],
		  'orderid' => $data['orderid']
	  );
	  $this->session->set_userdata($sessiondata);
	} */
        // for testing
  	/*		
        $data['orderid'] = "H201702001907";
        $data['staffid'] = "1352731";
        $data['userlogin'] = "1";
        $data['faultid'] = $fid;
	*/	
        // end of  for testing
	

        $this->load->view('templates/header', $data);
        $this->load->view('hsfault/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }

    public function index2($oid = 0, $fid = 0)
    {
	$page = 'index2';
        if ( ! file_exists(APPPATH.'views/hsfault/'.$page.'.php'))
        {
                // Whoops, we don't have a page for that!
                show_404();
        }

        $data['staffid'] = $this->session->userdata('s_staffid');
	if (isset($data['action'])) {
          $this->staffinfo->getStaffInfo($data['staffid'],$data['orderid']);
	} else {
	  $data['staffid'] = $this->session->userdata('s_staffid');
	  $data['orderid'] = $this->session->userdata('s_orderid');
        } 
        // for testing
  	/*		
        $data['orderid'] = "H201702001907";
        $data['staffid'] = "1352731";
        $data['userlogin'] = "1";
        $data['faultid'] = $fid;
	*/	
        // end of  for testing
	
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
 
    /* 
    public function change()
    {
      $this->load->helper('form');
      $this->load->library('form_validation');      
      $data['title'] = 'Change fault';
      $this->form_validation->set_rules('staffnumer','Staff Number','requred');
      $this->form_validation->set_rules('customername','Customer Name','requred');
      $this->form_validation->set_rules('optcert','Certificate','requred');
      $this->form_validation->set_rules('certno','Certificate','requred');
      $this->form_validation->set_rules('contactnumber','Contact Number','requred');
      $this->form_validation->set_rules('f_faultto_id','Fault Report to',' Number','requred');
      if ($this->form_validation->run() != FAlSE) 
      {
	$this->faults_model->set_faults();
      }
    }
	*/

}

