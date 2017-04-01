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
	  $sql="select f.id, f.orders_id, f.staff_id, s.name, o.customer_id, c.customer_name, f.createddate from square_fault f join devhktp.staff s on f.staff_id = s.staffid join orders o on f.orders_id = o.id join customers c on o.customer_id = c.customer_id where o.id = right(?,6) order by f.createddate desc";
	  $results = $this->db->query($sql, array($orderid));
	  //return an array of result
	  return $results->result_array();
        }

        public function getFaultInfo($faultid = '0') {
	  $sql ="SELECT `sf`.`id` faultid, `sf`.`staff_id` sfstaffid, staff.name, staff.teamcode, 'no data' channel, o.customer_name, o.staff_id ostaffid, o.uid, o.workinglocation, o.contactnumber,o.c2number, o.officetel,o.email, o.flat, o.floor, o.hse, o.bldg, o.stno, o.street, o.district, o.area, o.additionaladdr, `sf`.`orders_id` orderid, `sf`.`report_to`,sfrt.content reporttodesc, `sf`.`category`, `sf`.`symptomid`, `sf`.`replacement`, `sf`.`itemtypeid`, `sf`.`model`, `sf`.`quantity`, `sf`.`serial`, `sf`.`transfertoid`, `sf`.`appointment_date`, `sf`.`appointmenttimeid`, `sf`.`details`, `sf`.`updatetime`, `sf`.`createdby`, sf.createddate FROM `square_fault` sf join `square_fault_reportto` sfrt on sf.report_to = sfrt.id join devhktp.staff staff on sf.staff_id = staff.staffid join (select o.id id, c.customer_name customer_name, o.staff_id staff_id, c.uid uid, 'no data' workinglocation, c.contactnumber contactnumber, c.c2number c2number, 'no data' officetel, c.customer_email email, ia.flat flat, ia.floor floor, ia.hse hse, ia.bldg bldg, ia.stno stno, ia.street street, ia.district district, ia.area area, 'no data' additionaladdr from orders o join customers c on o.customer_id = c.customer_id join iatable ia on o.id = ia.order_id) o on sf.orders_id = o.id where sf.id = ?";
	  $result = $this->db->query($sql, array($faultid));
	  $data = $result->row_array();

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

	  $sql = "select `id`,`content` from square_fault_appointmenttime";
	  $result = $this->db->query($sql);
	  $data['tab_appointmenttime'] = $result->result_array();
          //$data['abc'][1] = 'AAA';
	  //return signal row
	  //return $result->row_array();
	  return $data;
        }

        public function set_faults() {
	  //log action
	  //update/insert table
	  //$customername = url_title($this->input->post('customername'), 'underscore' ,TRUE);
	  $staffnumber = $this->input->post('staffnumber');
	  $staffname = $this->input->post('staffname');
	  $staffteamcode = $this->input->post('staffteamcode');
	  $staffchannel = $this->input->post('channel');
	  $c_customername = $this->input->post('customername');
	  $c_staffno = $this->input->post('staffno');
	  $c_optcert = $this->input->post('optcert'); //cert type
	  $c_certno = $this->input->post('certno'); 
	  $workinglocation = $this->input->post('workinglocation'); 
	  $contactnumber = $this->input->post('contactnumber'); 
	  $ndcontactnumber = $this->input->post('2ndcontactnumber'); 
	  $officetelnumber = $this->input->post('officetelnumber'); 
	  $contactemail = $this->input->post('contactemail'); 
	  $ia_flat = $this->input->post('ia_flat');
	  $ia_floor = $this->input->post('ia_floor');
	  $ia_hse = $this->input->post('ia_hse');
	  $ia_bldg = $this->input->post('ia_bldg');
	  $ia_stno = $this->input->post('ia_stno');
	  $ia_street = $this->input->post('ia_street');
	  $ia_district = $this->input->post('ia_district');
	  $ia_area = $this->input->post('ia_area');
	  $ia_additionaladdress = $this->input->post('additionaladdress');
	  //part 3
	  $refordernoprefix = $this->input->post('refordernoprefix');
	  $reforderno = $this->input->post('reforderno');
	  $pcd = $this->input->post('pcd');
	  $lts = $this->input->post('lts');
	  $faultsymthom_id = $this->input->post('faultsymthom');
	  $itemreplacement = $this->input->post('itemreplacement');
	  $itemtype = $this->input->post('itemtype');
	  $itemmodel = $this->input->post('itemmodel');
	  $quantities = $this->input->post('quantities');
	  $itemserial = $this->input->post('itemserial');
	  $transferto_id = $this->input->post('transferto');
	  $appointmentdate = $this->input->post('appointmentdate');
	  $appointmenttime = $this->input->post('appointmenttime');
	  $faultdetails = $this->input->post('faultdetails');
          //hidden
	  $faultid = $this->input->post('faultid');	
	  $orderid = $this->input->post('orderid');	
	  $action = $this->input->post('action');	
	  $data = array(
		'staff_id' => $staffnumber,
		'staff_teamcode' => $staffteamcode,
		'staff_channel' => $channel,
		'order_id' => $orderid
	  );	
 	  if ($faultid == 0) {
	    $this->db-insert('square_fault', $data);
	  } else {
	    $this->db->where('id', $faultid);
	    $this->db->update('square_fault', $data);
	    $affectd_rows = $this->db->affected_rows();
	  }
	   
        }

        public function xgetFaultInfo($faultid) {
	  $sql ="SELECT `sf`.`id`, `sf`.`staff_id`, staff.name, staff.teamcode, 'no data' channel, o.customer_name, o.staff_id, o.uid, o.workinglocation, o.contactnumber,o.c2number, o.officetel,o.email, o.flat, o.floor, o.hse, o.bldg, o.stno, o.street, o.district, o.area, o.additionaladdr, `sf`.`orders_id`, `sf`.`report_to`,sfrt.desc reporttodesc, `sf`.`category`,sfc.desc categordesc, `sf`.`sympton`,sfs.desc symptondesc, `sf`.`replacement`, `sf`.`type`,sft.desc typedesc, `sf`.`model`, `sf`.`quantity`, `sf`.`serial`, `sf`.`transfer_to`,sftt.desc transfertodesc, `sf`.`appointment_date`, `sf`.`appointment_time`,sfa.desc appointmenttimedesc, `sf`.`details`, `sf`.`updatetime`, `sf`.`createdby`, sf.createddate FROM `square_fault` sf join `square_fault_appointmenttime` sfa on sf.appointment_time = sfa.id join `square_fault_category` sfc on sf.category = sfc.id join `square_fault_reportto` sfrt on sf.report_to = sfrt.id join `square_fault_sympthon` sfs on sf.sympton = sfs.id join `square_fault_type` sft on sf.report_to = sft.id join `square_fault_transferto` sftt on sf.transfer_to = sftt.id join devhktp.staff staff on sf.staff_id = staff.staffid join (select o.id id, c.customer_name customer_name, o.staff_id staff_id, c.uid uid, 'no data' workinglocation, c.contactnumber contactnumber, c.c2number c2number, 'no data' officetel, c.customer_email email, ia.flat flat, ia.floor floor, ia.hse hse, ia.bldg bldg, ia.stno stno, ia.street street, ia.district district, ia.area area, 'no data' additionaladdr from orders o join customers c on o.customer_id = c.customer_id join iatable ia on o.id = ia.order_id) o on sf.orders_id = o.id where sf.id = ?";
	  $results = $this->db->query($sql, array($faultid));
          $faultMetadata = $results -> row();
 	  $data['id'] = $faultMetadata->id;
 	  $data['staff_id'] = $faultMetadata->staff_id;
 	  $data['name'] = $faultMetadata->name;
 	  $data['teamcode'] = $faultMetadata->teamcode;
 	  $data['channel'] = $faultMetadata->channel;
 	  $data['customer_name'] = $faultMetadata->customer_name;
 	  $data['staff_id'] = $faultMetadata->staff_id;
 	  $data['uid'] = $faultMetadata->uid;
 	  $data['workinglocation'] = $faultMetadata->workinglocation;
 	  $data['contactnumber'] = $faultMetadata->contactnumber;
 	  $data['c2number'] = $faultMetadata->c2number;
 	  $data['officetel'] = $faultMetadata->officetel;
 	  $data['email'] = $faultMetadata->email;
 	  $data['flat'] = $faultMetadata->flat;
 	  $data['floor'] = $faultMetadata->floor;
 	  $data['hse'] = $faultMetadata->hse;
 	  $data['bldg'] = $faultMetadata->bldg;
 	  $data['stno'] = $faultMetadata->stno;
 	  $data['street'] = $faultMetadata->street;
 	  $data['district'] = $faultMetadata->district;
 	  $data['area'] = $faultMetadata->area;
 	  $data['addionaladdr'] = $faultMetadata->additionaladdr;
 	  $data['orders_id'] = $faultMetadata->order_id;
 	  $data['report_to'] = $faultMetadata->report_to;
 	  $data['reporttodesc'] = $faultMetadata->reporttodesc;
 	  $data['category'] = $faultMetadata->category;
 	  $data['categorydesc'] = $faultMetadata->categorydesc;
 	  $data['sympton'] = $faultMetadata->sympton;
 	  $data['symptondesc'] = $faultMetadata->symptondesc;
 	  $data['replacement'] = $faultMetadata->replacement;
 	  $data['type'] = $faultMetadata->typ3;
 	  $data['typedesc'] = $faultMetadata->typedesc;
 	  $data['model'] = $faultMetadata->model;
 	  $data['quantity'] = $faultMetadata->quantity;
 	  $data['serial'] = $faultMetadata->serial;
 	  $data['transfer_to'] = $faultMetadata->transfer_to;
 	  $data['transfertodesc'] = $faultMetadata->transfertodesc;
 	  $data['appointment_date'] = $faultMetadata->appointment_date;
 	  $data['appointment_time'] = $faultMetadata->appointment_time;
 	  $data['appointmenttimedesc'] = $faultMetadata->appointmenttimedesc;
 	  $data['details'] = $faultMetadata->details;
 	  $data['createdby'] = $faultMetadata->createdby;
 	  $data['createddate'] = $faultMetadata->createddate;
	  return $data;
        }
}
