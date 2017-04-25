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
    public function index($oid = "H201702000000", $afid="0")
    {
        //echo "oid = $oid<br>";
	$orderid = substr($oid, -6);
        //echo "orderid = $orderid";
	$data['faults'] = $this->faults_model->getFaultHistory($orderid);
        $data['title'] = 'Fault History';
	$data['afid'] = $afid;
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
	//$data['faultsinfo']['afid'] = $afid;
        $data['title'] = 'Fault Info';
        //$data['title'] = $data['faultsinfo']['name'];
	$this->load->view('hsfault/v_faultinfo', $data);
    } 

    //make change (update/ insert of fault)   
    public function change($oid = 0)
    {
      //$data['title'] = 'Change fault';
      $data['orderid'] = $this->input->post('orderid');
      $data['faultid'] = $this->input->post('faultid');
      $data['userlogin'] = 1;
      //$data['action'] = $this->input->post('action');
      $data['staffid'] = $this->session->userdata('s_staffid');
      log_message('debug', 'zzz[Faults]51:orderid-faultid='.$data['orderid'].'-'.$data['faultid']);
      //$this->form_validation->set_rules('certno','Certificate','required');
      //$this->form_validation->set_rules('c_email','Email address','required');
      //$this->form_validation->set_rules('f_faultto_id','Fault Report to','required');
      //$data['staffid'] = $this->session->userdata('s_staffid');
      //$data['orderid'] = $orderid;
      //$data['faultid'] = $faultid;
      //$data['userlogin'] = 1;
      //$staffid = $this->session->userdata('s_staffid');
      //check login or not
      if (strlen($data['staffid'])>0) {	
        //if ($this->form_validation->run() === true)
        //{
          log_message('debug', 'zzz[Faults]64:validation=true');
          //$data['staffid'] = $this->session->userdata('s_staffid');
          //$data['orderid'] = $orderid;
          //$data['faultid'] = $faultid;
          //$data['userlogin'] = 1;
	  $ret = $this->faults_model->set_faults();
        //} 
	$data['result']=$ret;
	log_message('debug', 'zzz[Faults]72:'.json_encode($data));
	$this->load->view('templates/header', $data);
	$this->load->view('hsfault/index', $data);
	$this->load->view('templates/footer', $data);
      } else {
	//can't get login info, redirect to V1
	redirect(HS_V1);
      }
    }

    public function check_appointmentquota($id = 0) {
      $aid = $this->input->get('appointment');
      $id = $aid;
      //log_message('debug', 'zzz[Faults]82:id='.$id);
      $this->load->model("z_mymodel");
      $ret = $this->z_mymodel->check_appointmentquota($id);
      //log_message('debug', 'zzz[Faults]85:ret='.$ret);
      if ($ret>0) $v=true; else $v="Quota Full, please select again";
      $data['ret']=$v;
      $this->load->view('hsfault/v_faultcheckappointment',$data);
    }
}

