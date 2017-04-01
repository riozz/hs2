<?php
  class Faults extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper('url_helper');
      $this->load->helper('url');
      $this->load->model('faults_model');
      $this->load->library('session');
      //$this->load->helper('form');
      //$this->load->library('staffInfo');
      //$this->load->library('faultInfo');
    }

    //get all fault regarding the order id
    public function index($oid = "H201702000000")
    {
        //echo "oid = $oid<br>";
	$orderid = substr($oid, -6);
        //echo "orderid = $orderid";
	$data['faults'] = $this->faults_model->getFaultHistory($orderid);
        $data['title'] = 'Fault History';
        //$data['faults']['id'] = 0;
	$this->load->view('hsfault/v_faulthistory', $data);
    } 

    // fault detail 
    public function view($fid = "0")
    {
        	
	$data['faultsinfo'] = $this->faults_model->getFaultInfo($fid);
	if (empty($data['faultsinfo'])) {
	  $data['faultsinfo']['name'] = "NULL";
	  //show_404();
	}
        $data['title'] = 'Fault Info';
        //$data['title'] = $data['faultsinfo']['name'];
	$this->load->view('hsfault/v_faultinfo', $data);
    } 
   
    public function change($oid = 0)
    {
      $this->load->helper('form');
      $this->load->library('form_validation');
      $data['title'] = 'Change fault';
      $orderid = $this->input->post('orderid');
      $faultid = $this->input->post('faultid');
      $staffnumber = $this->input->post('staffnumber');
      log_message('debug', 'zzz:orderid='.$orderid);
      log_message('debug', 'zzz:oid='.$oid);
      log_message('debug', 'zzz:faultid='.$faultid);
      log_message('debug', 'zzz:staffnumber='.$staffnumber);
      $this->form_validation->set_rules('staffnumer','Staff Number','required');
      $this->form_validation->set_rules('customername','Customer Name','required');
      $this->form_validation->set_rules('optcert','Certificate','required');
      $this->form_validation->set_rules('certno','Certificate','required');
      $this->form_validation->set_rules('contactnumber','Contact Number','required');
      $this->form_validation->set_rules('f_faultto_id','Fault Report to','required');
      if ($this->form_validation->run() == FAlSE)
      {
        //$this->faults_model->set_faults();
        //$this->load->view('templates/footer');
	//redirect(base_url()."index.php/hsfault/index/".$orderid."/".$faultid);
	redirect('http://www.google.com');
      } else {
	redirect('http://www.yahoo.com');
        //$this->load->view('templates/header');
      }
    }

}

