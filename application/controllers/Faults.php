<?php
  class Faults extends CI_Controller {

    public function __construct() {
      parent::__construct();
      $this->load->helper('url_helper');
      $this->load->helper('url');
      $this->load->model('faults_model');
      //$this->load->library('session');
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
	$this->load->view('hsfault/v_faulthistory', $data);
    } 

    
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
   
    /**    
    public function view($faultid = 0)
    {
	$data['faultinfo'] = $this->faultmodel->getFaultInfo($faultid);
        $data['title'] = 'Fault Info';
        $this->load->view('hsfault/v_faultinfo', $data);
    }
	*/

}

