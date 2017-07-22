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
 * @date 2017-07-21
 */

class WarrantyInfo {
        var $CI;

  	public function __construct($params = array()) {
	  $this->CI =& get_instance();
	  $this->CI->load->helper('url');
	  $this->CI->config->item('base_url');
	  $this->hktp_db=$this->CI->load->database('HKTP', TRUE);
	  //$this->CI->load->library('session');
  	}

        public function getWarrantyHistory($orderid) {
	  //return data array
	  $sql="select o.id, o.serial, sw.staff_id, s.name, sw.tc_staff_id, t.name tcname, sw.createddate from square_warranty sw join orders o on sw.orders_id = o.id join ".HKTP.".staff s on sw.staff_id = s.staffid join ".HKTP.".staff t on sw.tc_staff_id = t.staffid where sw.orders_id=right(?,6) order by sw.createddate desc";
	  /*select o.id, o.serial, sw.staff_id, s.name, sw.tc_staff_id, t.name tcname, sw.createddate
	  from square_warranty sw
	  join orders o on sw.orders_id = o.id
	  join devhktp.staff s on sw.staff_id = s.staffid
	  join devhktp.staff t on sw.tc_staff_id = t.staffid
	  where sw.orders_id=right('H201702001937',6) order by sw.createddate desc;
	  */
	  $results = $this->db->query($sql, array($orderid));
          $warrantyHistoryMetadata = $results -> row();
 	  $data['id'] = $warrantyHistoryMetadata->id;
 	  $data['serial'] = $warrantyHistoryMetadata->serial;
 	  $data['staffid'] = $warrantyHistoryMetadata->staff_id;
 	  $data['name'] = $warrantyHistoryMetadata->name;
 	  $data['tc_staff_id'] = $warrantyHistoryMetadata->tc_staff_id;
 	  $data['tcname'] = $warrantyHistoryMetadata->tcname;
 	  $data['createddate'] = $warrantyHistoryMetadata->createddate;
          //$this->CI->session->set_userdata($data);
        }

        public function getWarrantyInfo($warrantyid) {
	  //return single warranty
	  //$sql ="SELECT `sf`.`id`, `sf`.`staff_id`, staff.name, staff.teamcode, 'no data' channel, o.customer_name, o.staff_id, o.uid, o.workinglocation, o.contactnumber,o.c2number, o.officetel,o.email, o.flat, o.floor, o.hse, o.bldg, o.stno, o.street, o.district, o.area, o.additionaladdr, `sf`.`orders_id`, `sf`.`report_to`,sfrt.desc reporttodesc, `sf`.`category`,sfc.desc categordesc, `sf`.`sympton`,sfs.desc symptondesc, `sf`.`replacement`, `sf`.`type`,sft.desc typedesc, `sf`.`model`, `sf`.`quantity`, `sf`.`serial`, `sf`.`transfer_to`,sftt.desc transfertodesc, `sf`.`appointment_date`, `sf`.`appointment_time`,sfa.desc appointmenttimedesc, `sf`.`details`, `sf`.`updatetime`, `sf`.`createdby`, sf.createddate FROM `square_fault` sf join `square_fault_appointmenttime` sfa on sf.appointment_time = sfa.id join `square_fault_category` sfc on sf.category = sfc.id join `square_fault_reportto` sfrt on sf.report_to = sfrt.id join `square_fault_sympthon` sfs on sf.sympton = sfs.id join `square_fault_type` sft on sf.report_to = sft.id join `square_fault_transferto` sftt on sf.transfer_to = sftt.id join ".HKTP.".staff staff on sf.staff_id = staff.staffid join (select o.id id, c.customer_name customer_name, o.staff_id staff_id, c.uid uid, 'no data' workinglocation, c.contactnumber contactnumber, c.c2number c2number, 'no data' officetel, c.customer_email email, ia.flat flat, ia.floor floor, ia.hse hse, ia.bldg bldg, ia.stno stno, ia.street street, ia.district district, ia.area area, 'no data' additionaladdr from orders o join customers c on o.customer_id = c.customer_id join iatable ia on o.id = ia.order_id) o on sf.orders_id = o.id where sf.id = ?";
	  $sql="SELECT `sw`.`id`, `sw`.`staff_id`, staff.name, staff.teamcode, staff.channel, `sw`.`orders_id`, `sw`.`w_category`, swc.category, `sw`.`w_package`, swp.package, `sw`.`w_offer`, `sw`.`w_smno`, `sw`.`w_effdate`, `sw`.`tc_staff_id`, `sw`.`tc_appointmentdate`, `sw`.`tc_appointmenttime`, `sw`.`com_staff_id`, `sw`.`com_remark`,`sw`.`updatetime`, `sw`.`createdby`, `sw`.`modifiedby`, `sw`.`createddate`, tcstaff.name tcname, tcstaff.teamcode tcteamcode, tcstaff.telno tctelno, tcstaff.channel tcchannel, comstaff.name comname, comstaff.teamcode comteamcode, comstaff.telno comtelno, comstaff.channel comchannel, o.serial FROM `square_warranty` sw join `square_warranty_package` swp on sw.w_package = swp.id join `square_warranty_category` swc on sw.w_category = swc.id join ".HKTP.".staff staff on staff.staffid = sw.staff_id join ".HKTP.".staff tcstaff on tcstaff.staffid = sw.tc_staff_id join ".HKTP.".staff comstaff on comstaff.staffid = sw.com_staff_id join orders o on o.id=sw.orders_id where sw.id=?";
	  $results = $this->db->query($sql, array($warrantyid));
          $warrantyMetadata = $results -> row();
 	  $data['id'] = $warrantyMetadata->id;
 	  $data['staff_id'] = $warrantyMetadata->staff_id;
 	  $data['name'] = $warrantyMetadata->name;
 	  $data['teamcode'] = $warrantyMetadata->teamcode;
 	  $data['channel'] = $warrantyMetadata->channel;
	  $data['category'] = $warrantyMetadata->category;
	  $data['package'] = $warrantyMetadata->package;
	  $data['w_offer'] = $warrantyMetadata->w_offer;
	  $data['w_smno'] = $warrantyMetadata->w_smno;
	  $data['w_effdate'] = $warrantyMetadata->w_effdate;
	  $data['tc_staff_id'] = $warrantyMetadata->tc_staff_id;
	  $data['tc_appointmentdate'] = $warrantyMetadata->tc_appointmentdate;
	  $data['tc_appointmenttime'] = $warrantyMetadata->tc_appointmenttime;
	  $data['com_staff_id'] = $warrantyMetadata->com_staff_id;
	  $data['com_remark'] = $warrantyMetadata->com_remark;
	  $data['updatetime'] = $warrantyMetadata->updatetime;
	  $data['createdby'] = $warrantyMetadata->createdby;
	  $data['modifiedby'] = $warrantyMetadata->modifiedby;
	  $data['createddate'] = $warrantyMetadata->createddate;
	  $data['tcname'] = $warrantyMetadata->tcname;
	  $data['tcteamcode'] = $warrantyMetadata->tcteamcode;
	  $data['tctelno'] = $warrantyMetadata->tctelno;
	  $data['tcchannel']= $warrantyMetadata->tcchannel;
	  $data['comname'] = $warrantyMetadata->comname;
	  $data['comteamcode']= $warrantyMetadata->comteamcode;
	  $data['comtelno'] = $warrantyMetadata->comtelno;
	  $data['comchannel'] = $warrantyMetadata->comchannel;
	  $data['serial'] = $warrantyMetadata->serial;
        }
}
