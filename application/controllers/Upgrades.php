<?php
  class Upgrades extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper('url_helper');
      $this->load->helper('url');
      if (!isset($this->upgrades_model)) $this->load->model('upgrades_model');
      if (!isset($this->session)) $this->load->library('session');
      $this->load->helper('form');
      $this->load->library('form_validation');
      //$this->load->helper('form');
      //$this->load->library('staffInfo');
    }

    //get all upgrade regarding the order id
    public function index($oid = "H201702000000", $auid="0")
    {
        log_message('debug', 'zzz[Upgrades]19:index');
        //echo "oid = $oid<br>";
	//$orderid = substr($oid, -6);
        //echo "orderid = $orderid";
	$data['upgrades'] = $this->upgrades_model->getUpgradeHistory($oid);
        $data['title'] = 'Upgrade History';
	$data['auid'] = $auid;
        //$data['faults']['id'] = 0;
	$this->load->view('hsupgrade/v_upgradehistory', $data);
    } 

    // upgrade detail 
    public function view($oid = 0, $uid = "0")
    {
        log_message('debug', 'zzz[Upgrades]33:view');
	//$data['faultsinfo'] = $this->faults_model->getFaultInfo(substr($oid,-6), $fid);
	$data['upgradesinfo'] = $this->upgrades_model->getUpgradeInfo($oid, $uid);
	//if (empty($data['faultsinfo'])) {
	  //$data['faultsinfo']['name'] = "NULL";
	//}
	//$data['faultsinfo']['orderid'] = substr($oid, -6);
	$data['upgradesinfo']['orderid'] = $oid;
	//$data['faultsinfo']['afid'] = $afid;
        $data['title'] = 'Upgrade Info';
        //$data['title'] = $data['faultsinfo']['name'];
	$this->load->view('hsupgrade/v_upgradeinfo', $data);
    } 

    //make change (update/ insert of upgrade)   
    public function change($oid = 0)
    {
      log_message('debug', 'zzz[Upgrades]50:change');
      //$data['title'] = 'Change upgrade';
      $data['fullorder_id'] = $this->input->post('fullorder_id');
      $data['id'] = $this->input->post('id'); //upgradeid
      $data['userlogin'] = 1;
      //$data['action'] = $this->input->post('action');
      $data['staff_id'] = $this->session->userdata('s_staffid');
      log_message('debug', 'zzz[Upgrades]51:orderid-upgradeid='.$data['fullorder_id'].'-'.$data['id']);
      //$this->form_validation->set_rules('certno','Certificate','required');
      //$this->form_validation->set_rules('c_email','Email address','required');
      //$this->form_validation->set_rules('f_faultto_id','Fault Report to','required');
      //$data['staffid'] = $this->session->userdata('s_staffid');
      //$data['orderid'] = $orderid;
      //$data['faultid'] = $faultid;
      //$data['userlogin'] = 1;
      //$staffid = $this->session->userdata('s_staffid');
      //check login or not
      if (strlen($data['staff_id'])>0) {	
        //if ($this->form_validation->run() === true)
        //{
          log_message('debug', 'zzz[Upgrades]64:validation=true');
          //$data['staffid'] = $this->session->userdata('s_staffid');
          //$data['orderid'] = $orderid;
          //$data['faultid'] = $faultid;
          //$data['userlogin'] = 1;
	  $ret = $this->upgrades_model->set_upgrades();
        //} 
	$data['result']=$ret;
	log_message('debug', 'zzz[Upgrades]75:'.json_encode($data));
	$this->load->view('templates/header', $data);
	$this->load->view('hsupgrade/index', $data);
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
      log_message('debug', 'zzz[Upgrades]89:appointmentid='.$id.'-'.$oaid);
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
      $this->load->view('hsfault/v_faultcheckappointment',$data);
    }

    public function get_staffinfo($staff_id = '0', $viewform='v_upgradeAssignment') {
      //$staff_id = $this->input->post('tc_staff_id');
      //$staff_id = "1352731";
      log_message('debug', 'zzz[Upgrades]108:staff_id='.$staff_id);
      log_message('debug', 'zzz[Upgrades]109:viewform='.$viewform);
      //log_message('debug', 'zzz[Warrantys]107:staff_id='.$staff_id);
      $this->load->model("z_staffinfo");
      $ret = $this->z_staffinfo->getStaffInfoById($staff_id);
      log_message('debug', 'zzz[Upgrades]110:result='.json_encode($ret));
      $data = $ret;
      $this->load->view('hsupgrade/'.$viewform, $data);
    }
}

