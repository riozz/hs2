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
	  //$sql="select sw.id, sw.orders_id, sw.fullorder_id, sw.staff_id, s.name, sw.tc_staff_id, tc.name tcname, sw.com_staff_id, com.name comname, sw.createddate from square_warranty sw join ".HKTP.".staff s on sw.staff_id = s.staffid join ".HKTP.".staff tc on sw.tc_staff_id = tc.staffid join ".HKTP.".staff com on sw.com_staff_id = com.staffid where sw.orders_id=right(?,6) order by sw.createddate desc";
	  $sql="select su.id, su.orders_id, su.fullorder_id, su.staff_id, s.name, su.tc_staff_id, tc.name tcname, su.com_staff_id, com.name comname, su.createddate from square_upgrade su join ".HKTP.".staff s on su.staff_id = s.staffid join ".HKTP.".staff tc on su.tc_staff_id = tc.staffid join ".HKTP.".staff com on su.com_staff_id = com.staffid where su.orders_id=right(?,6) order by su.createddate desc";
	  $results = $this->db->query($sql, array($orderid));
	  //return an array of result
	  return $results->result_array();
        }

        public function getUpgradeInfo($oid, $upgradeid = '0') {
	  $orderid = substr($oid, -6); 
	  log_message('debug', 'zzz[Upgrades_model]34:orderid-upgradeid='.$orderid.'-'.$upgradeid);
          if ($upgradeid > 0) {
	    $sql="SELECT 
		`su`.`id` upgradeid, 
		`su`.`staff_id` staffid, 
		staff.name staffname, 
		staff.teamcode staffteamcode, 
		staff.channel staffchannel, 
		`su`.`orders_id` orderid, 
		`su`.`fullorder_id` fullorderid, 
		`su`.`u_model` umodelid, 
		sum.model umodel, 
		`su`.`u_quantity` uquantity, 
		`su`.`u_appointmentdate` udate, 
		`su`.`u_appointmenttime` utime, 
		`su`.`u_smno` usmno, 
		`su`.`u_remark` uremark, 
		`su`.`tc_staff_id` tcstaffid,
		`su`.`com_staff_id` comstaffid, 
		`su`.`com_remark` comremark,
		`su`.`updatetime`, 
		`su`.`createdby`, 
		`su`.`modifiedby`, 
		`su`.`createddate`, 
		`su`.`completeddate`,
		tcstaff.name tcname, 
		tcstaff.teamcode tcteamcode, 
		tcstaff.telno tctelno, 
		tcstaff.channel tcchannel, 
		comstaff.name comname, 
		comstaff.teamcode comteamcode, 
		comstaff.telno comtelno, 
		comstaff.channel comchannel
		FROM `square_upgrade` su 
		join `square_upgrade_model` sum on su.u_model = sum.id
		join ".HKTP.".staff staff on staff.staffid = su.staff_id 
		join ".HKTP.".staff tcstaff on tcstaff.staffid = su.tc_staff_id 
		join ".HKTP.".staff comstaff on comstaff.staffid = su.com_staff_id 
		where su.id=?";
	    log_message('debug', 'zzz[Upgrades_model]43:'.$sql);
	    $result = $this->db->query($sql, array($upgradeid));
	    $data = $result->row_array();
          } else {
            $sql="SELECT
                0 upgradeid, 0 staffid,
                '' staffname, '' staffteamcode, '' staffchannel,
                id orderid, serial fullorderid,
                0 umodelid, '' umodel, 0 uquantity,
                '' udate, '' utime,
                '' usmno, '' uremark, 0 tcstaffid,
                0 comstaffid, '' comremark,
                '' `createdby`, '' `modifiedby`, 
		'' `createddate`,'' `completeddate`,
                '' tcname, '' tcteamcode, '' tctelno, '' tcchannel,
                '' comname, '' comteamcode, '' comtelno, '' comchannel
                FROM orders o
                where id=?";

	    log_message('debug', 'zzz[Upgrades_model]53:'.$sql);
	    $result = $this->db->query($sql, array($orderid));
	    $data = $result->row_array();
          }

	  $sql = "select `id`,`model` from square_upgrade_model";
	  $result = $this->db->query($sql);
	  $data['tab_model'] = $result->result_array();

	  //$sql = "select `id`,`package` from square_warranty_package";
	  //$result = $this->db->query($sql);
	  //$data['tab_package'] = $result->result_array();

	  //$sql = "select `id`,`date`, timeslot, quota, quotaused from square_fault_appointment where quota-quotaused>0 and `date`>=curdate() order by date";
	  //$result = $this->db->query($sql);
	  //$data['tab_appointment'] = $result->result_array();
	  return $data;
        }

        public function set_upgrades() {
	  //log action
	  //update/insert table
	  //$customername = url_title($this->input->post('customername'), 'underscore' ,TRUE);
	  
          $fullorderid = $this->input->post('orderid');
          $orderid = substr($this->input->post('orderid'),-6);
          $upgradeid = $this->input->post('upgradeid');
          $action = $this->input->post('action');
          $staffid = $this->input->post('staffid');
          $staffname = $this->input->post('staffname');
          $staffteamcode = $this->input->post('staffteamcode');
          $staffchannel = $this->input->post('staffchannel');
	  $umodelid = $this->input->post('umodelid');
	  $uquantity = $this->input->post('uquantity');
	  $udate = $this->input->post('udate');
	  $utime = $this->input->post('utime');
	  $usmno = $this->input->post('usmno');
	  $uremark = $this->input->post('uremark');
	  $comstaffid = $this->input->post('comstaffid');
	  $comremark = $this->input->post('comremark');
	  $createdby = $this->input->post('createdby');
	  $modifiedby = $this->input->post('modifiedby');
	  $tcname = $this->input->post('tcname');
	  $tcteamcode = $this->input->post('tcteamcode');
	  $tctelno = $this->input->post('tctelno');
	  $tcchannel = $this->input->post('tcchannel');
	  $comname = $this->input->post('comname');
	  $comteamcode = $this->input->post('comteamcode');
	  $comtelno = $this->input->post('comtelno');
	  $comchannel = $this->input->post('comchannel');

	  $ret['orderid']=$fullorderid;
	  $ret['upgradeid']=$upgradeid;
	  $ret['msg']='DONE';

	  log_message('debug', 'zzz[Upgrades_model]215(orderid-upgradeid-appointmentid-o_appointmentid):'.$orderid.'-'.$upgradeid);

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
		'staff_id' => $staffid,
		'staff_teamcode' => $staffteamcode,
                'staff_channel' => $staffchannel,
		'orders_id' => $orderid,
		'fullorder_id' => $fullorderid,
		'u_model' => $umodelid,
		'u_quantity' => $uquantity,
	        'u_appointmentdate' => $udate,
		'u_appointmenttime' => $utime,
		'u_smno' => $usmno,
		'u_remark' => $uremark,
		'tc_staff_teamcode' => $tcname,
		'tc_staff_channel' => $tcchannel,
		'tc_staff_telno' => $tctelno,
		'tc_appointmentdate' => $tcdate,
		'tc_appointmenttime' => $tctime,
		'com_staff_id' => $comstaffid,
		'com_staff_teamcode' => $comteamcode,
		'com_staff_channel' => $comchannel,
		'com_staff_telno' => $comtelno,
		'com_remark' => $comremark,
		'createdby' => $this->session->userdata('s_staffid'), 
		'modifiedby' => $this->session->userdata('s_staffid'), 
		'createddate' => date("Y-m-d")
	  );
	  if ($presult) {
 	    if ($upgradeid == 0) {
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
	      $row = $this->insert_log('upgrade','update',$data,$upgradeid);
	      if ($row == 1) {
	        //$row = $this->email('HS - fault','ringo.wc.lau@pccw.com','HS - Fault', json_encode($data));
	        $this->db->where('id', $upgradeid);
	        $row = $this->db->update('square_upgrade', $data);
	        log_message('debug', 'zzz[Upgrades_model]286:row='.$row);
	        if ($row==0) {
	          $ret['msg']="ERR232: database error, Failed to update upgrade, please contact system administrator";
	          return $ret;
	        } 
	        log_message('debug', 'zzz[Upgrades]287:actionupgradeid='.$ret['upgradeid']);
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
	  log_message('debug', 'zzz[Upgrades_model]291/insert maildb:'.json_encode($data));
	  return $row;
  	}

}
