<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//
/**
 * ringo core codeigniter class
 *
 * @package  CodeIgniter
 * @subpackage Libraries
 * @category hktp
 * @author Ringo Lau
 * @link
 * @date 2017-03-01
 */

class Faults_model extends CI_Model {

 	public function __construct() {
	  $this->load->helper('url');
	  $this->load->database();
	  $this->hktp_db=$this->load->database('HKTP', TRUE);
	}

        public function getFaultHistory($orderid = '000000') {
	  //$sql="select f.id, f.orders_id, f.staff_id, s.name, o.customer_id, c.customer_name, f.createddate from square_fault f join devhktp.staff s on f.staff_id = s.staffid join orders o on f.orders_id = o.id join customers c on o.customer_id = c.customer_id where o.id = right(?,6) order by f.createddate desc";
	  $sql="select f.id, f.orders_id, f.staff_id, s.name, o.customer_id, f.c_name customer_name, f.createddate from square_fault f join devhktp.staff s on f.staff_id = s.staffid join orders o on f.orders_id = o.id where o.id = right(?,6) order by f.updatetime desc";
	  $results = $this->db->query($sql, array($orderid));
	  //return an array of result
	  return $results->result_array();
        }

        public function getFaultInfo($orderid, $faultid = '0') {
	  log_message('debug', 'zzz[Faults_model]33:orderid='.$orderid);
	  log_message('debug', 'zzz[Faults_model]34:faultid='.$faultid);
          if ($faultid > 0) {
	    $sql=" SELECT 
		sf.orders_id orderid,
		sf.id faultid, 
		sf.staff_id staffid, 
		staff.name staffname, 
		staff.teamcode staffteamcode, 
		'' staffchannel, 
		sf.c_name c_name, 
		sf.c_uid c_uid, 
		sf.c_workingloc c_workingloc, 
		sf.c_contact c_contact,
		sf.c_2contact c_ndcontact, 
		sf.c_officetel c_officetel,
		sf.c_email c_email, 
		sf.ia_flat ia_flat, 
		sf.ia_floor ia_floor, 
		sf.ia_hse ia_hse, 
		sf.ia_bldg ia_bldg, 
		sf.ia_stno ia_stno, 
		sf.ia_street ia_street, 
		sf.ia_district ia_district, 
		sf.ia_area ia_area, 
		sf.ia_additionaladdr ia_additionaladdr, 
		sf.ia_reforderno ia_reforderno,
		sf.report_to f_reporttoid, 
		sf.category f_category, 
		sf.symptomid f_symptomid, 
		sf.replacement f_replacement, 
		sf.itemtypeid f_itemtypeid, 
		sf.model f_model, 
		sf.quantity f_quantity, 
		sf.serial f_serial, 
		sf.transfertoid f_transfertoid,
		sf.appointmentid f_appointmentid, 
		sf.details f_details, 
		sf.updatetime f_updatetime, 
		sf.createdby f_createdby, 
		sf.createddate f_createddate
		FROM `square_fault` sf
		join devhktp.staff staff on sf.staff_id = staff.staffid
		where sf.id = ?";
	    log_message('debug', 'zzz[Faults_model]43:'.$sql);
	    $result = $this->db->query($sql, array($faultid));
	    $data = $result->row_array();
          } else {
	    $sql = "select
		o.id orderid, 
		0 faultid, 
		0 staffid, 
		'' staffname, 
		'' staffteamcode, 
		'' staffchannel, 
		c.customer_name c_name, 
		c.uid c_uid,
		'' c_workingloc, 
		c.contactnumber c_contact, 
		c.c2number c_ndcontact,
		'' c_officetel, 
		c.customer_email c_email,
		ia.flat ia_flat,
		ia.floor ia_floor,
		ia.hse ia_hse,
		ia.bldg ia_bldg, 
		ia.stno ia_stno, 
		ia.street ia_street, 
		ia.district ia_district, 
		ia.area ia_area,
		'' ia_additionaladdr,
		'' ia_reforderno,
		0 f_reporttoid,
		'' f_category, 
		0 f_symptomid, 
		'' f_replacement, 
		0 f_itemtypeid, 
		'' f_model, 
		'' f_quantity, 
		'' f_serial, 
		0 f_transfertoid,
		0 f_appointmentid, 
		'' f_details, 
		'' f_updatetime, 
		'' f_createdby, 
		'' f_createddate
		from orders o 
		join customers c on o.customer_id = c.customer_id 
		join iatable ia on o.id = ia.order_id where o.id=?";
	    log_message('debug', 'zzz[Faults_model]53:'.$sql);
	    $result = $this->db->query($sql, array($orderid));
	    $data = $result->row_array();
          }

	  $sql = "select `id`,`content` from square_fault_reportto";
	  $result = $this->db->query($sql);
	  $data['reportto'] = $result->result_array();

	  $sql = "select `id`,`content` from square_fault_symptom";
	  $result = $this->db->query($sql);
	  $data['tab_symptom'] = $result->result_array();

	  $sql = "select `id`,`content` from square_fault_itemtype";
	  $result = $this->db->query($sql);
	  $data['tab_itemtype'] = $result->result_array();

	  $sql = "select `id`,`content` from square_fault_transferto";
	  $result = $this->db->query($sql);
	  $data['tab_transferto'] = $result->result_array();

	  $sql = "select `id`,`date`, timeslot, quota, quotaused from square_fault_appointment where quota-quotaused>0 and `date`>=curdate()";
	  $result = $this->db->query($sql);
	  $data['tab_appointment'] = $result->result_array();
          //$data['abc'][1] = 'AAA';
	  //return signal row
	  //return $result->row_array();
	  return $data;
        }

        public function set_faults() {
	  //log action
	  //update/insert table
	  //$customername = url_title($this->input->post('customername'), 'underscore' ,TRUE);
	  
          $orderid = $this->input->post('orderid');
          $faultid = $this->input->post('faultid');
          $action = $this->input->post('action');
          $staffid = $this->input->post('staffid');
          $staffname = $this->input->post('staffname');
          $staffteamcode = $this->input->post('staffteamcode');
          $staffchannel = $this->input->post('staffchannel');
          $c_name = $this->input->post('c_name');
          //$c_staffno = $this->input->post('staffno');
          $c_certtype = $this->input->post('c_certtype');
          $c_certno = $this->input->post('c_certno');
          $c_uid = (strlen(trim($c_certno))>0)?($c_certtype.':'.trim($c_certno)):'';
	  log_message('debug', 'zzz[Faults_model]169/c_certtype='.$c_certtype.'/c_certno='.$c_certno.'/c_uid='.$c_uid);
          $c_workingloc = $this->input->post('c_workingloc');
          $c_contact= $this->input->post('c_contact');
          $c_ndcontact= $this->input->post('c_ndcontact');
          $c_officetel= $this->input->post('c_officetel');
          $c_email = $this->input->post('c_email');
          $ia_flat = $this->input->post('ia_flat');
          $ia_floor = $this->input->post('ia_floor');
          $ia_hse = $this->input->post('ia_hse');
          $ia_bldg = $this->input->post('ia_bldg');
          $ia_stno = $this->input->post('ia_stno');
          $ia_street = $this->input->post('ia_street');
          $ia_district = $this->input->post('ia_district');
          $ia_area = $this->input->post('ia_area');
          $ia_additionaladdr = $this->input->post('ia_additionaladdr');
          $ia_refordernoprefix = $this->input->post('ia_refordernoprefix');
          $ia_reforderno = $this->input->post('ia_reforderno');
          $ia_reforderno = (strlen($ia_reforderno>0))?($ia_refordernoprefix.':'.$ia_reforderno):'';
          $f_faulttoid = $this->input->post('f_faulttoid');
          $pcd = $this->input->post('f_pcd');
          $lts = $this->input->post('f_lts');
          $f_category = (isset($pcd)?'PCD':'');
          $f_category = $f_category.' '.(isset($lts)?'LTS':'');
          $f_symptomid = $this->input->post('f_symptomid');
          $f_replacement = $this->input->post('f_replacement');
          $f_itemtypeid = $this->input->post('f_itemtypeid');
          $f_model = $this->input->post('f_model');
          $f_quantity = $this->input->post('f_quantity');
          $f_serial = $this->input->post('f_serial');
          $f_transfertoid = $this->input->post('f_transfertoid');
          $f_appointmentid = $this->input->post('f_appointmentid');
          $f_o_appointmentid = $this->input->post('f_o_appointmentid');
          $f_details = $this->input->post('f_details');

	  log_message('debug', 'zzz[Faults_model]202-faultid='.$faultid);
	  $data = array (
		'staff_id' => $staffid,
		'staff_teamcode' => $staffteamcode,
                'staff_channel' => $staffchannel,
		'orders_id' => $orderid,
		'report_to' => $f_faulttoid,
		'category' => $f_category, 
		'symptomid' => $f_symptomid, 
		'replacement' => $f_replacement, 
		'itemtypeid' => $f_itemtypeid, 
		'model' => $f_model, 
		'quantity' => $f_quantity, 
		'serial' => $f_serial, 
		'transfertoid' => $f_transfertoid, 
		'appointmentid' => $f_appointmentid, 
		'details' => $f_details, 
		'c_name' => $c_name, 
		'c_uid' => $c_uid, 
		'c_workingloc' => $c_workingloc, 
		'c_contact' => $c_contact, 
		'c_2contact' => $c_ndcontact, 
		'c_officetel' => $c_officetel, 
		'c_email' => $c_email, 
		'ia_flat' => $ia_flat, 
		'ia_floor' => $ia_floor, 
		'ia_hse' => $ia_hse, 
		'ia_bldg' => $ia_bldg, 
		'ia_stno' => $ia_stno, 
		'ia_street' => $ia_street, 
		'ia_district' => $ia_district, 
		'ia_area' => $ia_area, 
		'ia_additionaladdr' => $ia_additionaladdr, 
		'ia_reforderno' => $ia_reforderno, 
		'createdby' => $this->session->userdata('s_staffid'), 
		'createddate' => date("Y-m-d")
	  );
 	  if ($faultid == 0) {
	    if ($data['staff_id'] != null)  {
	      log_message('debug', 'zzz[Faults_model]251/insert:'.json_encode($data));
              $row = $this->db->insert('square_fault', $data);
	      log_message('debug', 'zzz[Faults_model]244:row='.$row);
	      //$this->db-insert('square_fault', $data);
  	    }
	  } else {
	    log_message('debug', 'zzz[Faults_model]248/update:'.json_encode($data));
            //$row = $this->db->insert('square_fault', $data);
	    $row = 0;
	    log_message('debug', 'zzz[Faults_model]251:row='.$row);
	    //$this->db->where('id', $faultid);
	    //$this->db->update('square_fault', $data);
	    //$affectd_rows = $this->db->affected_rows();
	  }
	  return;
        }

}
