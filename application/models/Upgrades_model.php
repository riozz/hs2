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

class Upgrades_model extends CI_Model {

 	public function __construct() {
	  $this->load->helper('url');
	  $this->load->database();
	  $this->hktp_db=$this->load->database('HKTP', TRUE);
	  $this->maildb=$this->load->database('maildb', TRUE);
	}

        public function getUpgradeHistory($oid = 'H201702000000') {
	  //return data array
	  $orderid = substr($oid, -6);
	  //$sql="select su.id, su.orders_id, su.fullorder_id, su.staff_id, s.name, su.tc_staff_id, tc.name tcname, su.com_staff_id, com.name comname, su.createddate from square_upgrade su join ".HKTP.".staff s on su.staff_id = s.staffid join ".HKTP.".staff tc on su.tc_staff_id = tc.staffid join ".HKTP.".staff com on su.com_staff_id = com.staffid where su.orders_id=right(?,6) order by su.createddate desc";
	$sql="select su.id, su.orders_id, su.fullorder_id, su.staff_id, su.staff_name, su.tc_staff_id, su.tc_staff_name, su.com_staff_id, com_staff_name, su.createddate from square_upgrade su where su.orders_id=right(?,6) order by su.createddate desc";
	  $results = $this->db->query($sql, array($orderid));
	  //return an array of result
	  return $results->result_array();
        }

        public function getUpgradeInfo($oid, $upgradeid = '0') {
	  $orderid = substr($oid, -6); 
	  log_message('debug', 'zzz[Upgrades_model]34:orderid-upgradeid='.$orderid.'-'.$upgradeid);
          if ($upgradeid > 0) {
	    $sql="SELECT `su`.`id`, `su`.`staff_id`, `su`.staff_name, `su`.staff_teamcode, `su`.staff_channel, `su`.`orders_id`, `su`.`fullorder_id`, `su`.`u_model`, sum.model modelname, `su`.`u_quantity`, `su`.`u_appointmentdate`, `su`.`u_appointmenttime`, `su`.`u_appointmentdatetime`, `su`.`u_smno`, `su`.`u_remark`, `su`.`tc_staff_id`, `su`.`tc_staff_name`, `su`.`tc_staff_teamcode`, `su`.`tc_staff_channel`, `su`.`tc_staff_telno`, `su`.`tc_appointmentdate`, `su`.`tc_appointmenttime`, `su`.`tc_appointmentdatetime`, `su`.`com_staff_id`, `su`.`com_staff_name`, `su`.`com_staff_teamcode`,`su`.`com_staff_channel`,`su`.`com_staff_telno`, `su`.`com_remark`, `su`.`updatetime`, `su`.`createdby`, `su`.`modifiedby`, `su`.`createddate`, `su`.`com_date`
		FROM `square_upgrade` su 
		left join `square_upgrade_model` sum on su.u_model = sum.id
		where su.id=?";
	    log_message('debug', 'zzz[Upgrades_model]43:'.$sql);
	    $result = $this->db->query($sql, array($upgradeid));
	    $data = $result->row_array();
          } else {
	    $sql="SELECT 0 id, 0 staff_id, '' staff_name, '' staff_teamcode, '' staff_channel, id `orders_id`, serial fullorder_id , 0 `u_model`, '' modelname, 0 `u_quantity`, '' `u_appointmentdate`, '' `u_appointmenttime`, '' `u_appointmentdatetime`, '' `u_smno`, '' `u_remark`, 0 `tc_staff_id`, '' `tc_staff_name`, '' `tc_staff_teamcode`, '' `tc_staff_channel`, '' `tc_staff_telno`, '' `tc_appointmentdate`, '' `tc_appointmenttime`, '' `tc_appointmentdatetime`, 0 `com_staff_id`, '' `com_staff_name`, '' `com_staff_teamcode`,'' `com_staff_channel`,'' `com_staff_telno`, '' `com_remark`, '' `updatetime`, '' `createdby`, '' `modifiedby`, '' `createddate`, '' `com_date` FROM orders o where id=?";

	    log_message('debug', 'zzz[Upgrades_model]53:'.$sql);
	    $result = $this->db->query($sql, array($orderid));
	    $data = $result->row_array();
          }

	  $sql = "select `id`,`model` from square_upgrade_model";
	  $result = $this->db->query($sql);
	  $data['tab_model'] = $result->result_array();

	  return $data;
        }

        public function set_upgrades() {
	  //log action
	  //update/insert table
	  //$customername = url_title($this->input->post('customername'), 'underscore' ,TRUE);
	  
          $id = $this->input->post('id'); //upgrade id
          $staff_id = $this->input->post('staff_id');
          $staff_name = $this->input->post('staff_name');
          $staff_teamcode = $this->input->post('staff_teamcode');
          $staff_channel = $this->input->post('staff_channel');
          $fullorder_id = $this->input->post('fullorder_id');
          $orders_id = substr($this->input->post('fullorder_id'),-6);
	  $u_model = $this->input->post('u_model');
	  $u_quantity = $this->input->post('u_quantity');
	  $u_appointmentdate = $this->input->post('u_appointmentdate');
	  $u_appointmenttime = $this->input->post('u_appointmenttime');
	  $u_appointmentdatetime = $this->input->post('u_appointmentdatetime');
	  $u_smno = $this->input->post('u_smno');
	  $u_remark = $this->input->post('u_remark');
	  $tc_staff_id = $this->input->post('tc_staff_id');
	  $tc_staff_name = $this->input->post('tc_staff_name');
	  $tc_staff_teamcode = $this->input->post('tc_staff_teamcode');
	  $tc_staff_channel = $this->input->post('tc_staff_channel');
	  $tc_staff_telno = $this->input->post('tc_staff_telno');
	  $tc_appointmentdate = $this->input->post('tc_appointmentdate');
	  $tc_appointmenttime= $this->input->post('tc_appointmenttime');
	  $tc_appointmentdatetime= $this->input->post('tc_appointmentdatetime');
	  $com_staff_id = $this->input->post('com_staff_id');
	  $com_staff_name = $this->input->post('com_staff_name');
	  $com_staff_teamcode = $this->input->post('com_staff_teamcode');
	  $com_staff_telno = $this->input->post('com_staff_telno');
	  $com_staff_channel = $this->input->post('com_staff_channel');
	  $com_remark = $this->input->post('com_remark');
	  //$createdby = $this->input->post('createdby');
	  //$modifiedby = $this->input->post('modifiedby');
	  $com_date = $this->input->post('com_date');
          $action = $this->input->post('action');

	  $ret['fullorder_id']=$fullorder_id;
	  $ret['id']=$id; //upgrade id
	  $ret['msg']='DONE';

	  log_message('debug', 'zzz[Upgrades_model]215(orderid-upgradeid):'.$orders_id.'-'.$id);

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
	//bypass quota checking, no need to check
	$presult = true;

	  $data = array (
		'staff_id' => $staff_id,
		'staff_name' => $staff_name,
		'staff_teamcode' => $staff_teamcode,
                'staff_channel' => $staff_channel,
		'orders_id' => $orders_id,
		'fullorder_id' => $fullorder_id,
		'u_model' => $u_model,
		'u_quantity' => $u_quantity,
	        'u_appointmentdate' => $u_appointmentdate,
		'u_appointmenttime' => $u_appointmenttime,
		'u_appointmentdatetime' => $u_appointmentdatetime,
		'u_smno' => $u_smno,
		'u_remark' => $u_remark,
		'tc_staff_id' => $tc_staff_id,
		'tc_staff_name' => $tc_staff_name,
		'tc_staff_teamcode' => $tc_staff_teamcode,
		'tc_staff_channel' => $tc_staff_channel,
		'tc_staff_telno' => $tc_staff_telno,
		'tc_appointmentdate' => $tc_appointmentdate,
		'tc_appointmenttime' => $tc_appointmenttime,
		'tc_appointmentdatetime' => $tc_appointmentdatetime,
		'com_staff_id' => $com_staff_id,
		'com_staff_name' => $com_staff_name,
		'com_staff_teamcode' => $com_staff_teamcode,
		'com_staff_channel' => $com_staff_channel,
		'com_staff_telno' => $com_staff_telno,
		'com_remark' => $com_remark,
		'com_date' => $com_date,
		'createdby' => $this->session->userdata('s_staffid'), 
		'modifiedby' => $this->session->userdata('s_staffid'), 
		'createddate' => date("Y-m-d H:i:s")
	  );
	  if ($presult) {
 	    if ($id == 0) { //upgradeid
	      if ($data['staff_id'] != null)  {
	        log_message('debug', 'zzz[Upgrades_model]261/insert:'.json_encode($data));
	        $row = $this->insert_log('upgrade','insert',$data,'');
	        if ($row == 1) {
		  $row = $this->email('HS - upgrade','ringo.wc.lau@pccw.com','HS - Upgrade', json_encode($data));
                  $row = $this->db->insert('square_upgrade', $data);
	          if ($row==0) {
	            $ret['msg']="ERR232: database error, Failed to insert upgrade, please contact system administrator";
	            return $ret;
	          } 
		  $ret['upgradeid'] = $this->db->insert_id();
	          log_message('debug', 'zzz[Upgrades_model]290:row='.$row);
	          log_message('debug', 'zzz[Upgrades_model]291:actionupgradeid='.$ret['upgradeid']);
		  $ret['msg']='New Record Added Successfully.';
	        }
  	      }
	    } else {
	      log_message('debug', 'zzz[Upgrades_model]248/update:'.json_encode($data));
	      $row = $this->insert_log('upgrade','update',$data,$id);
	      if ($row == 1) {
	        //$row = $this->email('HS - fault','ringo.wc.lau@pccw.com','HS - Fault', json_encode($data));
	        $this->db->where('id', $id);
	        $row = $this->db->update('square_upgrade', $data);
	        log_message('debug', 'zzz[Upgrades_model]286:row='.$row);
	        if ($row==0) {
	          $ret['msg']="ERR232: database error, Failed to update upgrade, please contact system administrator";
	          return $ret;
	        } 
	        log_message('debug', 'zzz[Upgrades]287:actionupgradeid='.$ret['id']);
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
	  //$raw['c_uid'] = 'XXXXXX';
	  //$raw['c_contact'] = 'XXXXXXXX';
	  if (strlen($other)>0) 
	    $d = '{upgradeid:'.$other.'},'.json_encode($raw);
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
	  log_message('debug', 'zzz[Upgrades_model]291/insert maildb:'.json_encode($data));
	  return $row;
  	}

}
