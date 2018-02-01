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

class UpgradeInfo {
        var $CI;

  	public function __construct($params = array()) {
	  $this->CI =& get_instance();
	  $this->CI->load->helper('url');
	  $this->CI->config->item('base_url');
	  $this->hktp_db=$this->CI->load->database('HKTP', TRUE);
	  //$this->CI->load->library('session');
  	}

        public function getUpgradeHistory($orderid) {
	  $sql="select o.id, o.serial, su.staff_id, s.name, su.com_staff_id, t.name tcname, su.createddate from square_upgrade su join orders o on su.orders_id = o.id join ".HKTP.".staff s on su.staff_id = s.staffid join ".HKTP.".staff t on su.tc_staff_id = t.staffid where su.orders_id=right(?,6) order by su.createddate desc";
	  //$sql="select o.id, o.serial, o.staff_id, s.name, c.customer_id, c.customer_name, sf.createddate from orders o join customers c on o.customer_id = c.customer_id join ".HKTP.".staff s on o.staff_id = s.staffid join square_fault sf on o.id = sf.orders_id where o.id=right(?,6) order by sf.createddate desc";
	  /*
		select o.id, o.serial, su.staff_id, s.name, su.com_staff_id, t.name, su.createddate
		from square_upgrade su
		join orders o on su.orders_id = o.id
		join devhktp.staff s on su.staff_id = s.staffid
		join devhktp.staff t on su.tc_staff_id = t.staffid
		where su.orders_id=right('H201702001930',6) order by su.createddate desc;
	 */
	  $results = $this->db->query($sql, array($orderid));
          $upgradeHistoryMetadata = $results -> row();
 	  $data['id'] = $upgradeHistoryMetadata->id;
 	  $data['serial'] = $upgradeHistoryMetadata->serial;
 	  $data['staffid'] = $upgradeHistoryMetadata->staff_id;
 	  $data['name'] = $upgradeHistoryMetadata->name;
 	  $data['com_staff_id'] = $upgradeHistoryMetadata->com_staff_id;
 	  $data['tcname'] = $upgradeHistoryMetadata->tcname;
 	  $data['createddate'] = $upgradeHistoryMetadata->createddate;
          //$this->CI->session->set_userdata($data);
        }

        public function getUpgradeInfo($upgradeid) {
	  //$sql ="SELECT `sf`.`id`, `sf`.`staff_id`, staff.name, staff.teamcode, 'no data' channel, o.customer_name, o.staff_id, o.uid, o.workinglocation, o.contactnumber,o.c2number, o.officetel,o.email, o.flat, o.floor, o.hse, o.bldg, o.stno, o.street, o.district, o.area, o.additionaladdr, `sf`.`orders_id`, `sf`.`report_to`,sfrt.desc reporttodesc, `sf`.`category`,sfc.desc categordesc, `sf`.`sympton`,sfs.desc symptondesc, `sf`.`replacement`, `sf`.`type`,sft.desc typedesc, `sf`.`model`, `sf`.`quantity`, `sf`.`serial`, `sf`.`transfer_to`,sftt.desc transfertodesc, `sf`.`appointment_date`, `sf`.`appointment_time`,sfa.desc appointmenttimedesc, `sf`.`details`, `sf`.`updatetime`, `sf`.`createdby`, sf.createddate FROM `square_fault` sf join `square_fault_appointmenttime` sfa on sf.appointment_time = sfa.id join `square_fault_category` sfc on sf.category = sfc.id join `square_fault_reportto` sfrt on sf.report_to = sfrt.id join `square_fault_sympthon` sfs on sf.sympton = sfs.id join `square_fault_type` sft on sf.report_to = sft.id join `square_fault_transferto` sftt on sf.transfer_to = sftt.id join ".HKTP.".staff staff on sf.staff_id = staff.staffid join (select o.id id, c.customer_name customer_name, o.staff_id staff_id, c.uid uid, 'no data' workinglocation, c.contactnumber contactnumber, c.c2number c2number, 'no data' officetel, c.customer_email email, ia.flat flat, ia.floor floor, ia.hse hse, ia.bldg bldg, ia.stno stno, ia.street street, ia.district district, ia.area area, 'no data' additionaladdr from orders o join customers c on o.customer_id = c.customer_id join iatable ia on o.id = ia.order_id) o on sf.orders_id = o.id where sf.id = ?";
	  $sql="SELECT `su`.`id`, `su`.`staff_id`, staff.name, staff.teamcode, staff.channel, `su`.`orders_id`, `su`.`u_model`, sum.model, `su`.`u_quantity`, `su`.`u_appointmentdate`, `su`.`u_appointmenttime`, `su`.`u_smno`, `su`.`u_remark`, `su`.`tc_staff_id`, `su`.`tc_appointmentdate`, `su`.`tc_appointmenttime`, `su`.`com_staff_id`, `su`.`com_remark`,`su`.`updatetime`, `su`.`createdby`, `su`.`modifiedby`, `su`.`createddate`, tcstaff.name tcname, tcstaff.teamcode tcteamcode, tcstaff.telno tctelno, tcstaff.channel tcchannel, comstaff.name comname, comstaff.teamcode comteamcode, comstaff.telno comtelno, comstaff.channel comchannel, o.serial FROM `square_upgrade` su join `square_upgrade_model` sum on su.u_model = sum.id join ".HKTP.".staff staff on staff.staffid = su.staff_id join ".HKTP.".staff tcstaff on tcstaff.staffid = su.tc_staff_id join ".HKTP.".staff comstaff on comstaff.staffid = su.com_staff_id join orders o on o.id = su.orders_id where su.id=?";
	  $results = $this->db->query($sql, array($upgradeid));
          $upgradeMetadata = $results -> row();
          $data['id'] = $upgradeMetadata->id;
          $data['staff_id'] = $upgradeMetadata->staff_id;
          $data['name'] = $upgradeMetadata->name;
          $data['teamcode'] = $upgradeMetadata->teamcode;
          $data['channel'] = $upgradeMetadata->channel;
	  $data['orders_id'] = $upgradeMetadata->orders_id;
          $data['u_model'] = $upgradeMetadata->u_model;
          $data['model'] = $upgradeMetadata->model;
          $data['u_quantity'] = $upgradeMetadata->u_quantity;
          $data['u_appointmentdate'] = $upgradeMetadata->u_appointmentdate;
          $data['u_appointmenttime'] = $upgradeMetadata->u_appointmenttime;
          $data['u_smno'] = $upgradeMetadata->u_smno;
	  $data['u_remark'] = $upgradeMetadata->u_remark;
          $data['tc_staff_id'] = $upgradeMetadata->tc_staff_id;
          $data['tc_appointmentdate'] = $upgradeMetadata->tc_appointmentdate;
          $data['tc_appointmenttime'] = $upgradeMetadata->tc_appointmenttime;
          $data['com_staff_id'] = $upgradeMetadata->com_staff_id;
          $data['com_remark'] = $upgradeMetadata->com_remark;
          $data['updatetime'] = $upgradeMetadata->updatetime;
          $data['createdby'] = $upgradeMetadata->createdby;
          $data['modifiedby'] = $upgradeMetadata->modifiedby;
          $data['createddate'] = $upgradeMetadata->createddate;
          $data['tcname'] = $upgradeMetadata->tcname;
          $data['tcteamcode'] = $upgradeMetadata->tcteamcode;
          $data['tctelno'] = $upgradeMetadata->tctelno;
          $data['tcchannel']= $upgradeMetadata->tcchannel;
          $data['comname'] = $upgradeMetadata->comname;
          $data['comteamcode']= $upgradeMetadata->comteamcode;
          $data['comtelno'] = $upgradeMetadata->comtelno;
          $data['comchannel'] = $upgradeMetadata->comchannel;
          $data['serial'] = $upgradeMetadata->serial;
        }
}
