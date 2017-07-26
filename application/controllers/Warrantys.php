<?php
  class Warrantys extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper('url_helper');
      $this->load->helper('url');
      $this->load->model('warrantys_model');
      $this->load->library('session');
      $this->load->helper('form');
      $this->load->library('form_validation');
      //$this->load->helper('form');
      //$this->load->library('staffInfo');
      //$this->load->library('warrantyInfo');
    }

    //get all warranty regarding the order id
    public function index($oid = "H201702000000", $awid="0")
    {
        //echo "oid = $oid<br>";
	//$orderid = substr($oid, -6);
        //echo "orderid = $orderid";
	$data['warrantys'] = $this->warrantys_model->getWarrantyHistory($oid);
        $data['title'] = 'Warranty History';
	$data['awid'] = $awid;
        //$data['warrantys']['id'] = 0;
	$this->load->view('hswarranty/v_warrantyhistory', $data);
    } 

    // warranty detail 
    public function view($oid = 0, $wid = "0")
    {
	//$data['warrantysinfo'] = $this->warrantys_model->getFaultInfo(substr($oid,-6), $fid);
	$data['warrantysinfo'] = $this->warrantys_model->getWarrantyInfo($oid, $wid);
	//if (empty($data['warrantysinfo'])) {
	  //$data['warrantysinfo']['name'] = "NULL";
	//}
	//$data['warrantysinfo']['orderid'] = substr($oid, -6);
	$data['warrantysinfo']['orderid'] = $oid;
	//$data['warrantysinfo']['afid'] = $afid;
        $data['title'] = 'Warranty Info';
        //$data['title'] = $data['warrantysinfo']['name'];
	$this->load->view('hswarranty/v_warrantyinfo', $data);
    } 

    //make change (update/ insert of warranty)   
    public function change($oid = 0)
    {
      //$data['title'] = 'Change warranty';
      $data['orderid'] = $this->input->post('orderid');
      $data['warrantyid'] = $this->input->post('warrantyid');
      $data['userlogin'] = 1;
      //$data['action'] = $this->input->post('action');
      $data['staffid'] = $this->session->userdata('s_staffid');
      log_message('debug', 'zzz[Warrantys]51:orderid-warrantyid='.$data['orderid'].'-'.$data['warrantyid']);
      //$this->form_validation->set_rules('certno','Certificate','required');
      //$this->form_validation->set_rules('c_email','Email address','required');
      //$this->form_validation->set_rules('f_warrantyto_id','Fault Report to','required');
      //$data['staffid'] = $this->session->userdata('s_staffid');
      //$data['orderid'] = $orderid;
      //$data['warrantyid'] = $warrantyid;
      //$data['userlogin'] = 1;
      //$staffid = $this->session->userdata('s_staffid');
      //check login or not
      if (strlen($data['staffid'])>0) {	
        //if ($this->form_validation->run() === true)
        //{
          log_message('debug', 'zzz[Warrantys]64:validation=true');
          //$data['staffid'] = $this->session->userdata('s_staffid');
          //$data['orderid'] = $orderid;
          //$data['warrantyid'] = $warrantyid;
          //$data['userlogin'] = 1;
	  $ret = $this->warrantys_model->set_warrantys();
        //} 
	$data['result']=$ret;
	log_message('debug', 'zzz[Warrantys]72:'.json_encode($data));
	$this->load->view('templates/header', $data);
	$this->load->view('hswarranty/index', $data);
	$this->load->view('templates/footer', $data);
      } else {
	//can't get login info, redirect to V1
	redirect(HS_V1);
      }
    }

    public function check_appointmentquota($id = 0) {
      //$aid = $this->input->get('appointment');
      $aid = $this->input->post('appointment');
      $oaid = $this->input->post('o_appointment');
      $id = $aid;
      log_message('debug', 'zzz[Warrantys]89:appointmentid='.$id.'-'.$oaid);
      //won't check if selection is same as before
      if ($id === $oaid) {
	$v = true;
      } else {
        $this->load->model("z_mymodel");
        $ret = $this->z_mymodel->check_appointmentquota($id);
        //log_message('debug', 'zzz[Faults]85:ret='.$ret);
        if ($ret>0) $v=true; else $v="Quota Full, please select again";
      }
      $data['ret']=$v;
      $this->load->view('hswarranty/v_warrantycheckappointment',$data);
    }
}

