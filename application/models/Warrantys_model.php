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

class Warrantys_model extends CI_Model {

 	public function __construct() {
	  $this->load->helper('url');
	  $this->load->database();
	  $this->hktp_db=$this->load->database('HKTP', TRUE);
	  $this->maildb=$this->load->database('maildb', TRUE);
	}

        public function getWarrantyHistory($oid = 'H201702000000') {
	  //return data array
	  $orderid = substr($oid, -6);
	  //$sql="select f.id, f.orders_id, f.forder_id, f.staff_id, s.name, o.customer_id, f.c_name customer_name, f.createddate from square_fault f join ".HKTP.".staff s on f.staff_id = s.staffid join orders o on f.orders_id = o.id where o.id = right(?,6) order by f.updatetime desc";
	  $sql="select sw.id, sw.orders_id, sw.fullorder_id, sw.staff_id, s.name, sw.tc_staff_id, tc.name tcname, sw.com_staff_id, com.name comname, sw.createddate from square_warranty sw join ".HKTP.".staff s on sw.staff_id = s.staffid left join ".HKTP.".staff tc on sw.tc_staff_id = tc.staffid left join ".HKTP.".staff com on sw.com_staff_id = com.staffid where sw.orders_id=right(?,6) order by sw.createddate desc";
	  $results = $this->db->query($sql, array($orderid));
	  //return an array of result
	  return $results->result_array();
        }

        public function getWarrantyInfo($oid, $warrantyid = '0') {
	  $orderid = substr($oid, -6); 
	  log_message('debug', 'zzz[Warrantys_model]34:orderid-warrantyid='.$orderid.'-'.$warrantyid);
          if ($warrantyid > 0) {
	    $sql="SELECT 
		`sw`.`id` warrantyid, 
		`sw`.`staff_id` staffid, 
		staff.name staffname, 
		sw.staff_teamcode staffteamcode, 
		sw.staff_channel staffchannel, 
		`sw`.`orders_id` orderid, 
		`sw`.`fullorder_id` fullorderid, 
		`sw`.`w_category` wcategoryid, 
		swc.category wcategory, 
		`sw`.`w_package` wpackageid, 
		swp.package wpackage, 
		`sw`.`w_offer` woffer, 
		`sw`.`w_smno` wsmno, 
		`sw`.`w_effdate` weffdate, 
		`sw`.`tc_staff_id` tcstaffid, 
		sw.tc_staff_teamcode tcteamcode,
		sw.tc_staff_channel tcchannel,
		sw.tc_staff_telno tctelno,
		`sw`.`tc_appointmentdate` tcdate, 
		`sw`.`tc_appointmenttime` tctime, 
		`sw`.`com_staff_id` comstaffid, 
		sw.com_staff_teamcode comteamcode,
		sw.com_staff_channel comchannel,
		sw.com_staff_telno comtelno,
		`sw`.`com_remark` comremark,
		`sw`.`updatetime`, 
		`sw`.`createdby`, 
		`sw`.`modifiedby`, 
		`sw`.`createddate`, 
		`sw`.`completeddate`,
		tcstaff.name tcname, 
		comstaff.name comname 
		FROM `square_warranty` sw
		join `square_warranty_package` swp on sw.w_package = swp.id 
		join `square_warranty_category` swc on sw.w_category = swc.id 
		join ".HKTP.".staff staff on staff.staffid = sw.staff_id 
		left join ".HKTP.".staff tcstaff on tcstaff.staffid = sw.tc_staff_id 
		left join ".HKTP.".staff comstaff on comstaff.staffid = sw.com_staff_id 
		where sw.id=?";
	    log_message('debug', 'zzz[Warrantys_model]43:'.$sql);
	    $result = $this->db->query($sql, array($warrantyid));
	    $data = $result->row_array();
          } else {
	    $sql = "select
                0 warrantyid,
                0 staffid,
                '' staffname,
                '' staffteamcode,
                '' staffchannel,
                id orderid,
                serial fullorderid,
                0 wcategoryid,
                '' wcategory,
                0 wpackageid,
                '' wpackage,
                '' woffer,
                '' wsmno,
                '' weffdate,
                0 tcstaffid,
                '' tcdate,
                '' tctime,
                0 comstaffid,
                '' comremark,
                '' updatetime,
                '' createdby,
                '' modifiedby,
                '' createddate,
		'' completeddate,
                '' tcname,
                '' tcteamcode,
                '' tctelno,
                '' tcchannel,
                '' comname,
                '' comteamcode,
                '' comtelno,
                '' comchannel
                FROM orders o
		where id=?";

	    log_message('debug', 'zzz[Warrantys_model]53:'.$sql);
	    $result = $this->db->query($sql, array($orderid));
	    $data = $result->row_array();
          }

	  $sql = "select `id`,`category` from square_warranty_category";
	  $result = $this->db->query($sql);
	  $data['tab_category'] = $result->result_array();

	  $sql = "select `id`,`package` from square_warranty_package";
	  $result = $this->db->query($sql);
	  $data['tab_package'] = $result->result_array();

	  //$sql = "select `id`,`date`, timeslot, quota, quotaused from square_fault_appointment where quota-quotaused>0 and `date`>=curdate() order by date";
	  //$result = $this->db->query($sql);
	  //$data['tab_appointment'] = $result->result_array();
	  return $data;
        }

        public function set_warrantys() {
	  //log action
	  //update/insert table
	  //$customername = url_title($this->input->post('customername'), 'underscore' ,TRUE);
	  
          $fullorderid = $this->input->post('orderid');
          $orderid = substr($this->input->post('orderid'),-6);
          $warrantyid = $this->input->post('warrantyid');
          $action = $this->input->post('action');
          $staffid = $this->input->post('staffid');
          $staffname = $this->input->post('staffname');
          $staffteamcode = $this->input->post('staffteamcode');
          $staffchannel = $this->input->post('staffchannel');
	  $wcategoryid = $this->input->post('wcategoryid');
	  $wpackageid = $this->input->post('wpackageid');
	  $woffer = $this->input->post('woffer');
	  $wsmno = $this->input->post('wsmno');
	  $weffdate = $this->input->post('weffdate');
	  $tcstaffid = $this->input->post('tcstaffid');
	  $tcname = $this->input->post('tcname');
	  $tcteamcode = $this->input->post('tcteamcode');
	  $tcchannel = $this->input->post('tcchannel');
	  $tctelno = $this->input->post('tctelno');
	  $tcdate = $this->input->post('tcdate');
	  $tctime = $this->input->post('tctime');
	  $completeddate = $this->input->post('completeddate');
	  $comstaffid = $this->input->post('comstaffid');
	  $comname = $this->input->post('comname');
	  $comteamcode = $this->input->post('comteamcode');
	  $comchannel = $this->input->post('comchannel');
	  $comremark = $this->input->post('comremark');
	  //$createdby = $this->input->post('createdby');
	  //$modifiedby = $this->input->post('modifiedby');
	  //$comtelno = $this->input->post('comtelno');

	  $ret['orderid']=$fullorderid;
	  $ret['warrantyid']=$warrantyid;
	  $ret['msg']='DONE';

	  log_message('debug', 'zzz[Warrantys_model]215(orderid-warrantyid):'.$orderid.'-'.$warrantyid);

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
		'w_category' => $wcategoryid,
		'w_package' => $wpackageid,
	        'w_offer' => $woffer,
		'w_smno' => $wsmno,
		'w_effdate' => $weffdate,
		'tc_staff_id' => $tcstaffid,
		'tc_staff_teamcode' => $tcname,
		'tc_staff_channel' => $tcchannel,
		'tc_staff_telno' => $tctelno,
		'tc_appointmentdate' => $tcdate,
		'tc_appointmenttime' => $tctime,
		'com_staff_id' => $comstaffid,
		'com_staff_teamcode' => $comteamcode,
		'com_staff_channel' => $comchannel,
		//'com_staff_telno' => $comtelno,
		'com_remark' => $comremark,
		'createdby' => $this->session->userdata('s_staffid'), 
		'modifiedby' => $this->session->userdata('s_staffid'), 
		'createddate' => date("Y-m-d H:i:s"),
		'completeddate' => $completeddate
	  );
	  if ($presult) {
 	    if ($warrantyid == 0) {
	      if ($data['staff_id'] != null)  {
	        log_message('debug', 'zzz[Warrantys_model]261/insert:'.json_encode($data));
	        $row = $this->insert_log('warranty','insert',$data,'');
	        if ($row == 1) {
		  $row = $this->email('HS - warranty','ringo.wc.lau@pccw.com','HS - Warranty', json_encode($data));
                  $row = $this->db->insert('square_warranty', $data);
	          if ($row==0) {
	            $ret['msg']="ERR232: database error, Failed to insert warranty, please contact system administrator";
	            return $ret;
	          } 
		  $ret['warrantyid'] = $this->db->insert_id();
	          log_message('debug', 'zzz[Warrantys_model]290:row='.$row);
	          log_message('debug', 'zzz[Warrantys_model]291:actionwarrantyid='.$ret['warrantyid']);
		  $ret['msg']='New Record Added Successfully.';
	        }
  	      }
	    } else {
	      log_message('debug', 'zzz[Warrantys_model]248/update:'.json_encode($data));
	      $row = $this->insert_log('warranty','update',$data,$warrantyid);
	      if ($row == 1) {
	        //$row = $this->email('HS - fault','ringo.wc.lau@pccw.com','HS - Fault', json_encode($data));
	        $this->db->where('id', $warrantyid);
	        $row = $this->db->update('square_warranty', $data);
	        log_message('debug', 'zzz[Warrantys_model]286:row='.$row);
	        if ($row==0) {
	          $ret['msg']="ERR232: database error, Failed to update warranty, please contact system administrator";
	          return $ret;
	        } 
	        log_message('debug', 'zzz[Warrantys_model]287:actionwarrantyid='.$ret['warrantyid']);
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
	    $d = '{warrantyid:'.$other.'},'.json_encode($raw);
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
	  log_message('debug', 'zzz[Warrantys_model]291/insert maildb:'.json_encode($data));
	  return $row;
  	}

}
