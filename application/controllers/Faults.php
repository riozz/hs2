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
      /*      
      $action = $this->input->post('action');
      $staffnumber = $this->input->post('staffnumber');
      $staffname = $this->input->post('staffname');
      $staffname = $this->input->post('staffteamcode');
      $staffchannel = $this->input->post('staffchannel');
      $c_customername = $this->input->post('customername');
      $c_staffno = $this->input->post('staffno');
      $optcert = $this->input->post('optcert');
      $certno = $this->input->post('certno');
      $c_customercert = $optcert.':'.$certno;
      $c_workinglocation = $this->input->post('c_workinglocation');
      $c_contactnumber = $this->input->post('c_contactnumber');
      $c_ndcontactnumber = $this->input->post('c_ndcontactnumber');
      $c_officetelnumber = $this->input->post('c_officetelnumber');
      $c_contactemail = $this->input->post('c_contactemail');
      $c_ia_flat = $this->input->post('c_ia_flat');
      $c_ia_floor = $this->input->post('c_ia_floor');
      $c_ia_hse = $this->input->post('c_ia_hse');
      $c_ia_bldg = $this->input->post('c_ia_bldg');
      $c_ia_stno = $this->input->post('c_ia_stno');
      $c_ia_street = $this->input->post('c_ia_street');
      $c_ia_district = $this->input->post('c_ia_district');
      $c_ia_area = $this->input->post('c_ia_area');
      $c_ia_additionaladdr = $this->input->post('c_ia_additionaladdress');
      $c_refordernoprefix = $this->input->post('c_refordernoprefix');
      $c_reforderno = $this->input->post('c_reforderno');
      $f_faultto_id = $this->input->post('f_faultto_id');
      $pcd = $this->input->post('f_pcd');
      $lts = $this->input->post('f_lts');
      $f_category = (isset($pcd)?'PCD':'');
      $f_category = $f_category.' '.(isset($lts)?'LTS':'');
      $f_faultsymptom_id = $this->input->post('f_faultsymptom_id');
      $f_itemreplacement = $this->input->post('f_itemreplacement');
      $f_itemtype_id = $this->input->post('f_itemtype_id');
      $f_itemmodel = $this->input->post('f_itemmodel');
      $f_quantities = $this->input->post('f_quantities');
      $f_itemserial = $this->input->post('f_itemserial');
      $f_transferto_id = $this->input->post('f_transferto_id');
      $f_appointment_id = $this->input->post('f_appointment_id'); 
      $f_o_appointment_id = $this->input->post('f_o_appointment_id'); 
      $f_faultdetails = $this->input->post('f_faultdetails'); 
      log_message('debug', 'zzz:oid='.$oid);
      log_message('debug', 'zzz:faultid='.$faultid);
      log_message('debug', 'zzz:staffnumber='.$staffnumber);
      log_message('debug', 'zzz:staffname='.$staffname);
      log_message('debug', 'zzz:customername='.$customername);
      log_message('debug', 'zzz:action='.$action);
      */ 
      $this->form_validation->set_rules('staffnumer','Staff Number','required');
      $this->form_validation->set_rules('customername','Customer Name','required');
      $this->form_validation->set_rules('optcert','Certificate','required');
      $this->form_validation->set_rules('certno','Certificate','required');
      $this->form_validation->set_rules('contactnumber','Contact Number','required');
      $this->form_validation->set_rules('f_faultto_id','Fault Report to','required');
      if ($this->form_validation->run() === FAlSE)
      {
        //$this->faults_model->set_faults();
        //$this->load->view('templates/footer');
	//redirect(base_url()."index.php/hsfault/index/".$orderid."/".$faultid);
	//redirect('http://www.google.com');
	//$this->load->view(base_url().'index.php/hsfault/index/'.$orderid.'/'.$faultid);
	
        $data['staffid'] = $this->session->userdata('s_staffid');
        $data['orderid'] = $orderid;
        $data['faultid'] = $faultid;
        $data['userlogin'] = 1;
	$this->faults_model->set_faults();
	$this->load->view('templates/header', $data);
	$this->load->view('hsfault/index', $data);
	$this->load->view('templates/footer', $data);
	
      } else {
	$this->faults_model->set_faults();
	redirect('http://www.yahoo.com');
        //$this->load->view('templates/header');
      }
    }

}

