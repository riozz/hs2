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
	  $this->maildb=$this->load->database('maildb', TRUE);
	}

        public function getFaultHistory($oid = 'H201702000000') {
	  //$sql="select f.id, f.orders_id, f.staff_id, s.name, o.customer_id, c.customer_name, f.createddate from square_fault f join devhktp.staff s on f.staff_id = s.staffid join orders o on f.orders_id = o.id join customers c on o.customer_id = c.customer_id where o.id = right(?,6) order by f.createddate desc";
	  $orderid = substr($oid, -6);
	  $sql="select f.id, f.orders_id, f.forder_id, f.staff_id, s.name, o.customer_id, f.c_name customer_name, f.createddate from square_fault f join ".HKTP.".staff s on f.staff_id = s.staffid join orders o on f.orders_id = o.id where o.id = right(?,6) order by f.updatetime desc";
	  $results = $this->db->query($sql, array($orderid));
	  //return an array of result
	  return $results->result_array();
        }

        public function getFaultInfo($oid, $faultid = '0') {
	  $orderid = substr($oid, -6); 
	  log_message('debug', 'zzz[Faults_model]34:orderid-faultid='.$orderid.'-'.$faultid);
          if ($faultid > 0) {
	    $sql=" SELECT 
		sf.orders_id orderid,
		sf.forder_id forderid,
		sf.id faultid, 
		sf.staff_id staffid, 
		staff.name staffname, 
		sf.staff_teamcode staffteamcode, 
		sf.staff_channel staffchannel, 
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
		sf.appointmentdatetime,
		a.`date` appointmentdate,
		a.`timeslot` appointmenttimeslot,
		sf.details f_details, 
		sf.resolve_details,
		sf.updatetime f_updatetime, 
		sf.createdby f_createdby, 
		sf.createddate f_createddate
		FROM `square_fault` sf
		join ".HKTP.".staff staff on sf.staff_id = staff.staffid
		left join square_fault_appointment a on sf.appointmentid = a.id
		where sf.id = ?";
	    log_message('debug', 'zzz[Faults_model]43:'.$sql);
	    $result = $this->db->query($sql, array($faultid));
	    $data = $result->row_array();
          } else {
	    $sql = "select
		o.id orderid, 
		o.serial forderid,
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
		'' appointmentdatetime, 
		'' f_details, 
		'' resolve_details, 
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

	  $sql = "select `id`,`date`, timeslot, quota, quotaused from square_fault_appointment where quota-quotaused>0 and `date`>=curdate() order by date";
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
	  
          $forderid = $this->input->post('orderid');
          $orderid = substr($this->input->post('orderid'),-6);
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
	  //log_message('debug', 'zzz[Faults_model]169/c_certtype='.$c_certtype.'/c_certno='.$c_certno.'/c_uid='.$c_uid);
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
	  //$f_cat1 = $this->input->post('f_cat1');
	  //$f_cat2 = $this->input->post('f_cat2');
	  //$f_cat3 = $this->input->post('f_cat3');
	  //$f_cat4 = $this->input->post('f_cat4');
	  //$f_cat5 = $this->input->post('f_cat5');
	  //$f_cat[] = $this->input->post('f_cat');
	  //for ($i=0; $i<sizeof($f_cat); $i++) {
	    //$f_category = (isset($f_cat[$i])?'CAT'.$i:'');
  	  //}
	  $f_category = substr(implode(',',$this->input->post('f_cat')), 0);
	  log_message('debug', 'zzz[Faults_model]209:$f_category='.$f_category);
          //$f_category = (isset($f_cat1)?'CAT1':'');
          //$f_category = $f_category.' '.(isset($f_cat2)?'CAT2':'');
          //$f_category = $f_category.' '.(isset($f_cat3)?'CAT3':'');
          //$f_category = $f_category.' '.(isset($f_cat4)?'CAT4':'');
          //$f_category = $f_category.' '.(isset($f_cat5)?'CAT5':'');
          $f_symptomid = $this->input->post('f_symptomid');
	  $f_replacement = 0;
          $f_replacement = $this->input->post('f_replacement');
          $f_itemtypeid = $this->input->post('f_itemtypeid');
          $f_model = $this->input->post('f_model');
          $f_quantity = $this->input->post('f_quantity');
          $f_serial = $this->input->post('f_serial');
          $f_transfertoid = $this->input->post('f_transfertoid');
          $f_appointmentid = $this->input->post('appointment');
          $f_o_appointmentid = $this->input->post('f_o_appointmentid');
          $appointmentdatetime = $this->input->post('appointmentdatetime');
          $f_details = $this->input->post('f_details');
          $resolve_details = $this->input->post('resolve_details');

	  $ret['orderid']=$forderid;
	  $ret['faultid']=$faultid;
	  $ret['msg']='DONE';

	  log_message('debug', 'zzz[Faults_model]215(orderid-faultid-appointmentid-o_appointmentid):'.$orderid.'-'.$faultid.'-'.$f_appointmentid.'-'.$f_o_appointmentid);

	  //check appointment quota	
	  /*
	  $appointmentquota = 0;
	  $sql = "select quotaused+1<=quota c from square_fault_appointment where id=?";
	  log_message('debug', 'zzz[Faults_model]220:check quota'.$sql);
	  $results = $this->db->query($sql, array($f_appointmentid));
	  if ($results->num_rows() > 0) {
	    $row = $results->row_array();
	    $appointmentquota = $row['c'];
	  } 

	  if ($appointmentquota>0) {
	    if ($f_appointmentid-$f_o_appointmentid!=0) {
	      //quotaused ++
	      log_message('debug', 'zzz[Faults_model]218:quotaused++'.$orderid.'-'.$faultid.'-'.$f_appointmentid);
	      $sql = "update square_fault_appointment set quotaused=quotaused+1 where id=".$f_appointmentid;
	      $presult = $this->db->query($sql);
	      //$this->db->set('quotaused', 'quotaused+1');
	      //$this->db->where('id', $f_appointmentid);
	      //$presult = $this->db->update('square_fault_appointment');
	      if (!$presult) {
	        $ret['msg']="ERR236: database error, Failed to modify quota table, please contact system administrator";
	        return $ret;
	      } 
  
	      if ($presult) {
	        if ($f_o_appointmentid>0) {
	          // quotaused -- for old quota
	          log_message('debug', 'zzz[Faults_model]216:quotaused--'.$orderid.'-'.$faultid.'-'.$f_o_appointmentid);
	          $this->db->set('quotaused', 'quotaused-1');
	          $this->db->where('id', $f_o_appointmentid);
	          $presult = $this->db->update('square_fault_appointment');
	          if (!$presult) {
	            $ret['msg']="ERR248: database error, Failed to modify quota table, please contact system administrator";
	            return $ret;
	          } 
	        }
	      }
	    } else {
	      $presult = true;
	    }
	  } else {
	    $ret['msg']="ERR257: Quota Full";
	    return $ret;
	  }
	 */
	 //bypass quota check, no need to check
	 $presult = true;

	  $data = array (
		'staff_id' => $staffid,
		'staff_teamcode' => $staffteamcode,
                'staff_channel' => $staffchannel,
		'orders_id' => $orderid,
		'forder_id' => $forderid,
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
		'appointmentdatetime' => $appointmentdatetime, 
		'details' => $f_details, 
		'resolve_details' => $resolve_details, 
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
	  if ($presult) {
 	    if ($faultid == 0) {
	      if ($data['staff_id'] != null)  {
	        log_message('debug', 'zzz[Faults_model]261/insert:'.json_encode($data));
	        $row = $this->insert_log('fault','insert',$data,'');
	        if ($row == 1) {
		  $row = $this->email('HS - fault','ringo.wc.lau@pccw.com','HS - Fault', json_encode($data));
                  $row = $this->db->insert('square_fault', $data);
	          if ($row==0) {
	            $ret['msg']="ERR232: database error, Failed to insert fault, please contact system administrator";
	            return $ret;
	          } 
		  $ret['faultid'] = $this->db->insert_id();
	          log_message('debug', 'zzz[Faults_model]290:row='.$row);
	          log_message('debug', 'zzz[Faults_model]291:actionfaultid='.$ret['faultid']);
		  $ret['msg']='New Record Added Successfully.';
	        }
  	      }
	    } else {
	      log_message('debug', 'zzz[Faults_model]248/update:'.json_encode($data));
	      $row = $this->insert_log('fault','update',$data,$faultid);
	      if ($row == 1) {
	        //$row = $this->email('HS - fault','ringo.wc.lau@pccw.com','HS - Fault', json_encode($data));
	        $this->db->where('id', $faultid);
	        $row = $this->db->update('square_fault', $data);
	        log_message('debug', 'zzz[Faults_model]286:row='.$row);
	        if ($row==0) {
	          $ret['msg']="ERR232: database error, Failed to update fault, please contact system administrator";
	          return $ret;
	        } 
	        log_message('debug', 'zzz[Faults_model]287:actionfaultid='.$ret['faultid']);
		$ret['msg']='Record Updated Successfully.';
	      }
	    }
	    $ret['line']='309';
	    return $ret;
          } else {
	    $ret['line']='312';
	    return $ret;
	  }
	}

        public function insert_log($section, $action, $raw, $other) {
	  $staffid = $raw['staff_id'];
	  $raw['c_uid'] = 'XXXXXX';
	  $raw['c_contact'] = 'XXXXXXXX';
	  if (strlen($other)>0) 
	    $d = '{faultid:'.$other.'},'.json_encode($raw);
  	  else 
	    $d = json_encode($raw);
	  $data = array (
		'section' => $section,
		'action' => $action,
		'user' => $staffid,
		'data' => $d
	  );
          $row = $this->db->insert('square_log', $data);
	  return $row;
	}

 	public function email($section, $mailto, $mailsubject, $mailcontent) {
	  $data = array (
		'mail_system' => $section,
		'mail_to' => $mailto,
		'mail_subject' => $mailsubject,
		'mail_content' => $mailcontent,
		'mail_inserttime' => date("Y-m-d H:i:s")
	  );
	  $row = $this->maildb->insert('mailsend', $data);
	  log_message('debug', 'zzz[Faults_model]291/insert maildb:'.json_encode($data));
	  return $row;
  	}

}
