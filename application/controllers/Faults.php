<?php
  class Faults extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper('url_helper');
      $this->load->helper('url');
      $this->load->model('faults_model');
      $this->load->library('session');
      $this->load->helper('form');
      $this->load->library('form_validation');
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
    public function view($oid = 0, $fid = "0")
    {
	//$orderid = substr($oid, -6);
	$data['faultsinfo'] = $this->faults_model->getFaultInfo(substr($oid,-6), $fid);
	//if (empty($data['faultsinfo'])) {
	  //$data['faultsinfo']['name'] = "NULL";
	//}
	$data['faultsinfo']['orderid'] = substr($oid, -6);
        $data['title'] = 'Fault Info';
        //$data['title'] = $data['faultsinfo']['name'];
	$this->load->view('hsfault/v_faultinfo', $data);
    } 
   
    public function change($oid = 0)
    {
      $data['title'] = 'Change fault';
      $orderid = $this->input->post('orderid');
      $faultid = $this->input->post('faultid');
      log_message('debug', 'zzz[Faults]48:orderid='.$orderid.'/faultid='.$faultid);
      //$this->form_validation->set_rules('staffnumer','Staff Number','required');
      //$this->form_validation->set_rules('customername','Customer Name','required');
      //$this->form_validation->set_rules('optcert','Certificate','required');
      //$this->form_validation->set_rules('certno','Certificate','required');
      $this->form_validation->set_rules('c_contact','Contact Number','required');
      $this->form_validation->set_rules('c_email','Email address','required');
      //$this->form_validation->set_rules('f_faultto_id','Fault Report to','required');
      $data['staffid'] = $this->session->userdata('s_staffid');
      $data['orderid'] = $orderid;
      $data['faultid'] = $faultid;
      $data['userlogin'] = 1;
      //check login or not
      if (strlen($data['staffid'])>0) {	
        if ($this->form_validation->run() === true)
        {
          log_message('debug', 'zzz[Faults]64:validation=true');
          //$data['staffid'] = $this->session->userdata('s_staffid');
          //$data['orderid'] = $orderid;
          //$data['faultid'] = $faultid;
          //$data['userlogin'] = 1;
	  $this->faults_model->set_faults();
        } 
	$this->load->view('templates/header', $data);
	$this->load->view('hsfault/index', $data);
	$this->load->view('templates/footer', $data);
      } else {
	redirect(HS_V1);
      }
    }

}

