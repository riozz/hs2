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

class FaultInfo {
        var $CI;

  	public function __construct($params = array()) {
	  $this->CI =& get_instance();
	  $this->CI->load->helper('url');
	  $this->CI->config->item('base_url');
	  $this->hktp_db=$this->CI->load->database('HKTP', TRUE);
	  //$this->CI->load->library('session');
  	}

        public function getFaultHistory($orderid) {
	  $sql="select o.id, o.serial, o.staff_id, s.name, c.customer_id, c.customer_name, sf.createddate from orders o join customers c on o.customer_id = c.customer_id join ".HKTP.".staff s on o.staff_id = s.staffid join square_fault sf on o.id = sf.orders_id where o.id=right(?,6) order by sf.createddate desc";
	  //$sql = "SELECT id,name,staffid,ccc,location FROM staff where staffid=?";
	  $results = $this->db->query($sql, array($orderid));
          $faultHistoryMetadata = $results -> row();
 	  $data['id'] = $faultHistoryMetadata->id;
 	  $data['serial'] = $faultHistoryMetadata->serial;
 	  $data['staffid'] = $faultHistoryMetadata->staffid;
 	  $data['name'] = $faultHistoryMetadata->name;
 	  $data['customer_id'] = $faultHistoryMetadata->customer_id;
 	  $data['customer_name'] = $faultHistoryMetadata->customer_name;
 	  $data['createddate'] = $faultHistoryMetadata->createddate;
          //$this->CI->session->set_userdata($data);
        }

        public function getFaultInfo($faultid) {
	  $sql ="SELECT `sf`.`id`, `sf`.`staff_id`, staff.name, staff.teamcode, 'no data' channel, o.customer_name, o.staff_id, o.uid, o.workinglocation, o.contactnumber,o.c2number, o.officetel,o.email, o.flat, o.floor, o.hse, o.bldg, o.stno, o.street, o.district, o.area, o.additionaladdr, `sf`.`orders_id`, `sf`.`report_to`,sfrt.desc reporttodesc, `sf`.`category`,sfc.desc categordesc, `sf`.`sympton`,sfs.desc symptondesc, `sf`.`replacement`, `sf`.`type`,sft.desc typedesc, `sf`.`model`, `sf`.`quantity`, `sf`.`serial`, `sf`.`transfer_to`,sftt.desc transfertodesc, `sf`.`appointment_date`, `sf`.`appointment_time`,sfa.desc appointmenttimedesc, `sf`.`details`, `sf`.`updatetime`, `sf`.`createdby`, sf.createddate FROM `square_fault` sf join `square_fault_appointmenttime` sfa on sf.appointment_time = sfa.id join `square_fault_category` sfc on sf.category = sfc.id join `square_fault_reportto` sfrt on sf.report_to = sfrt.id join `square_fault_sympthon` sfs on sf.sympton = sfs.id join `square_fault_type` sft on sf.report_to = sft.id join `square_fault_transferto` sftt on sf.transfer_to = sftt.id join ".HKTP.".staff staff on sf.staff_id = staff.staffid join (select o.id id, c.customer_name customer_name, o.staff_id staff_id, c.uid uid, 'no data' workinglocation, c.contactnumber contactnumber, c.c2number c2number, 'no data' officetel, c.customer_email email, ia.flat flat, ia.floor floor, ia.hse hse, ia.bldg bldg, ia.stno stno, ia.street street, ia.district district, ia.area area, 'no data' additionaladdr from orders o join customers c on o.customer_id = c.customer_id join iatable ia on o.id = ia.order_id) o on sf.orders_id = o.id where sf.id = ?";
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
        }
}
