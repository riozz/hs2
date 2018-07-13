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
	  //$sql="select sw.id, sw.orders_id, sw.fullorder_id, sw.staff_id, s.name, sw.tc_staff_id, tc.name tcname, sw.com_staff_id, com.name comname, sw.createddate from square_warranty sw join ".HKTP.".staff s on sw.staff_id = s.staffid left join ".HKTP.".staff tc on sw.tc_staff_id = tc.staffid left join ".HKTP.".staff com on sw.com_staff_id = com.staffid where sw.orders_id=right(?,6) order by sw.createddate desc";
	  $sql="select w.id, w.orders_id, w.fullorder_id, w.staff_id, w.staff_name, w.tc_staff_id, w.tc_staff_name, w.com_staff_id, w.com_staff_name, w.createddate, w.com_date, w.w_effdate, date_add(date_add(w.w_effdate, interval p.months month), interval -1 day) end_date from square_warranty w left join square_warranty_package p on w.w_package = p.id where w.orders_id=right(?,6) order by w.updatetime desc";
	  $results = $this->db->query($sql, array($orderid));
	  //return an array of result
	  return $results->result_array();
        }

        public function getWarrantyInfo($oid, $warrantyid = '0') {
	  $fullorder_id = $oid;
	  $orders_id = substr($oid, -6); 
	  $id = $warrantyid;
	  log_message('debug', 'zzz[Warrantys_model]34:orderid-warrantyid='.$fullorder_id.'-'.$id);
          if ($id > 0) { //warrantyid
	    $sql="SELECT 
		sw.`id`, sw.`staff_id`, sw.staff_name, 
		sw.staff_teamcode, sw.staff_channel, 
		sw.`orders_id`, sw.`fullorder_id`,
		sw.`w_category`, swc.category category_name, 
		sw.`w_package`, swp.package package_name, 
		sw.`w_offer`, sw.`w_smno`, sw.`w_effdate`,
		sw.`tc_staff_id`, sw.tc_staff_name, sw.tc_staff_teamcode, 
		sw.tc_staff_channel, sw.tc_staff_telno,
		sw.`tc_appointmentdate`, sw.`tc_appointmenttime`,
		sw.`tc_appointmentdatetime`,
		sw.`com_staff_id`, sw.com_staff_name, sw.com_staff_teamcode,
		sw.com_staff_channel,  sw.com_staff_telno,
		sw.`com_remark`, sw.`updatetime`, sw.`createdby`, 
		sw.`modifiedby`, sw.`createddate`, sw.`com_date`
		FROM `square_warranty` sw
		left join `square_warranty_package` swp on sw.w_package = swp.id 
		left join `square_warranty_category` swc on sw.w_category = swc.id 
		where sw.id=?";
	    log_message('debug', 'zzz[Warrantys_model]43:'.$sql);
	    //$result = $this->db->query($sql, array($id)); //warrantyid
	    $result = $this->db->query($sql,$id); //warrantyid
	    $data = $result->row_array();
          } else {
	    $sql="SELECT 0 `id`, 0 `staff_id`, '' staff_name, '' staff_teamcode, '' staff_channel, id `orders_id`, serial `fullorder_id`, 0 `w_category`, '' category_name, 0 `w_package`, '' package_name, '' `w_offer`, '' `w_smno`, '' `w_effdate`, 0 `tc_staff_id`, '' tc_staff_name, '' tc_staff_teamcode, '' tc_staff_channel, '' tc_staff_telno, '' `tc_appointmentdate`, '' `tc_appointmenttime`, '' `tc_appointmentdatetime`, 0 `com_staff_id`, '' com_staff_name, '' com_staff_teamcode, '' com_staff_channel,  '' com_staff_telno, '' `com_remark`, '' `updatetime`, '' `createdby`, '' `modifiedby`, '' `createddate`, '' `com_date` FROM orders where id=?";

	    log_message('debug', 'zzz[Warrantys_model]53:'.$sql);
	    $result = $this->db->query($sql, array($orders_id));
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
	  
          $id = $this->input->post('id'); //warrantyid
          $staff_id = $this->input->post('staff_id');
          $staff_name = $this->input->post('staff_name');
          $staff_teamcode = $this->input->post('staff_teamcode');
          $staff_channel = $this->input->post('staff_channel');
          $fullorder_id = $this->input->post('fullorder_id');
          $orders_id = substr($this->input->post('fullorder_id'),-6);
	  $w_category = $this->input->post('w_category'); //id
	  $w_package = $this->input->post('w_package'); //id
	  $w_offer = $this->input->post('w_offer');
	  $w_smno = $this->input->post('w_smno');
	  $w_effdate = $this->input->post('w_effdate');
	  if (strlen($w_effdate) < 3)
	    $w_effdate = null;
	  $tc_staff_id = $this->input->post('tc_staff_id');
	  $tc_staff_name = $this->input->post('tc_staff_name');
	  $tc_staff_teamcode = $this->input->post('tc_staff_teamcode');
	  $tc_staff_channel = $this->input->post('tc_staff_channel');
	  $tc_staff_telno = $this->input->post('tc_staff_telno');
	  //$tc_appointmentdate = $this->input->post('tc_appointmentdate');
	  //$tc_appointmenttime = $this->input->post('tc_appointmenttime');
	  $tc_appointmentdatetime = $this->input->post('tc_appointmentdatetime');
	  if (strlen($tc_appointmentdatetime)<3) 
	    $tc_appointmentdatetime = null;
	  $com_staff_id = $this->input->post('com_staff_id');
	  $com_staff_name = $this->input->post('com_staff_name');
	  $com_staff_teamcode = $this->input->post('com_staff_teamcode');
	  $com_staff_channel = $this->input->post('com_staff_channel');
	  $com_staff_telno = $this->input->post('com_staff_telno');
	  $com_remark = $this->input->post('com_remark');
	  $com_date = $this->input->post('com_date');
	  if (strlen($com_date)<3)
	    $com_date = null;
          $action = $this->input->post('action');
	  //$editedby = $this->session->userdata('s_staffid');
	  //$createdby = $this->input->post('createdby');
	  //$modifiedby = $this->input->post('modifiedby');

	  $ret['fullorder_id']=$fullorder_id;
	  $ret['id']=$id; //warrantyid
	  $ret['msg']='DONE';

	  log_message('debug', 'zzz[Warrantys_model]126(tc_appointmentdatetime):'.$tc_appointmentdatetime);
	  log_message('debug', 'zzz[Warrantys_model]127(orderid-warrantyid):'.$fullorder_id.'-'.$id);

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

	  if ($presult) {
 	    if ($id == 0) { //warrantyid (insert)
	      $data = array (
		'staff_id' => $staff_id,
		'staff_name' => $staff_name,
		'staff_teamcode' => $staff_teamcode,
                'staff_channel' => $staff_channel,
		'orders_id' => $orders_id,
		'fullorder_id' => $fullorder_id,
		'w_category' => $w_category,
		'w_package' => $w_package,
	        'w_offer' => $w_offer,
		'w_smno' => $w_smno,
		'w_effdate' => $w_effdate,
		'tc_staff_id' => $tc_staff_id,
		'tc_staff_name' => $tc_staff_name,
		'tc_staff_teamcode' => $tc_staff_teamcode,
		'tc_staff_channel' => $tc_staff_channel,
		'tc_staff_telno' => $tc_staff_telno,
		//'tc_appointmentdate' => $tc_appointmentdate,
		//'tc_appointmenttime' => $tc_appointmenttime,
		'tc_appointmentdatetime' => $tc_appointmentdatetime,
		'com_staff_id' => $com_staff_id,
		'com_staff_name' => $com_staff_name,
		'com_staff_teamcode' => $com_staff_teamcode,
		'com_staff_channel' => $com_staff_channel,
		'com_staff_telno' => $com_staff_telno,
		'com_remark' => $com_remark,
		'createdby' => $this->session->userdata('s_staffid'), 
		'modifiedby' => $this->session->userdata('s_staffid'), 
		'createddate' => date("Y-m-d H:i:s"),
		'com_date' => $com_date
	      );
	      if ($data['staff_id'] != null)  {
	        log_message('debug', 'zzz[Warrantys_model]261/insert:'.json_encode($data));
	        $row = $this->insert_log('warranty','insert',$data,'');
	        if ($row == 1) {
		  //$row = $this->email('HS - warranty','ringo.wc.lau@pccw.com','HS - Warranty', json_encode($data));
                  $row = $this->db->insert('square_warranty', $data);
	          if ($row==0) {
	            $ret['msg']="ERR232: database error, Failed to insert warranty, please contact system administrator";
	            return $ret;
	          } 
		  $ret['id'] = $this->db->insert_id(); //warrantyid
	          log_message('debug', 'zzz[Warrantys_model]290:row='.$row);
	          log_message('debug', 'zzz[Warrantys_model]291:actionwarrantyid='.$ret['id']);
                  $row = $this->email('HS - Warranty','',$this->emailSubject($data,$ret['id']), $this->emailContent($data,$ret['id']));
		  $ret['msg']='New Record Added Successfully.';
	        }
  	      }
	    } else { //update
	      $data = array (
		'staff_id' => $staff_id,
		'staff_name' => $staff_name,
		'staff_teamcode' => $staff_teamcode,
                'staff_channel' => $staff_channel,
		'orders_id' => $orders_id,
		'fullorder_id' => $fullorder_id,
		'w_category' => $w_category,
		'w_package' => $w_package,
	        'w_offer' => $w_offer,
		'w_smno' => $w_smno,
		'w_effdate' => $w_effdate,
		'tc_staff_id' => $tc_staff_id,
		'tc_staff_name' => $tc_staff_name,
		'tc_staff_teamcode' => $tc_staff_teamcode,
		'tc_staff_channel' => $tc_staff_channel,
		'tc_staff_telno' => $tc_staff_telno,
		'tc_appointmentdatetime' => $tc_appointmentdatetime,
		'com_staff_id' => $com_staff_id,
		'com_staff_name' => $com_staff_name,
		'com_staff_teamcode' => $com_staff_teamcode,
		'com_staff_channel' => $com_staff_channel,
		'com_staff_telno' => $com_staff_telno,
		'com_remark' => $com_remark,
		//'createdby' => $this->session->userdata('s_staffid'), 
		'modifiedby' => $this->session->userdata('s_staffid'), 
		//'createddate' => date("Y-m-d H:i:s"),
		'com_date' => $com_date
	      );
	      log_message('debug', 'zzz[Warrantys_model]248/update:'.json_encode($data));
	      $row = $this->insert_log('warranty','update',$data,$id); //warrantyid
	      if ($row == 1) {
	        //$row = $this->email('HS - fault','ringo.wc.lau@pccw.com','HS - Fault', json_encode($data));
	        $this->db->where('id', $id); //warrantyid
	        $row = $this->db->update('square_warranty', $data);
	        log_message('debug', 'zzz[Warrantys_model]286:row='.$row);
	        if ($row==0) {
	          $ret['msg']="ERR232: database error, Failed to update warranty, please contact system administrator";
	          return $ret;
	        } 
	        log_message('debug', 'zzz[Warrantys_model]287:actionwarrantyid='.$ret['id']); //warrantyid
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
	  $modifiedby = $raw['modifiedby'];
	  //$raw['c_uid'] = 'XXXXXX';
	  //$raw['c_contact'] = 'XXXXXXXX';
	  if (strlen($other)>0) 
	    $d = '{warrantyid:'.$other.'},'.json_encode($raw);
  	  else 
	    $d = json_encode($raw);
	  $data = array (
		'section' => $section,
		'action' => $action,
		'user' => $staffid,
		'modifiedby' => $modifiedby,
		'data' => $d
	  );
          $row = $this->db->insert('square_log', $data);
	  return $row;
	}

        public function emailSubject($data, $id) {
          $warrantyid = $data['fullorder_id']."-".$id;
          $subject = 'New order created (HS-Warranty ';
          $subject = $subject.$warrantyid.')';
          return $subject;
        }

        public function emailContent($data, $id) {
          $warrantyid = $data['fullorder_id']."-".$id;
          $ordertype = "HS-Warranty";
          $content='<b>New order created</b><p>Order type: '.$ordertype.'<br>Order ID: '.$warrantyid.'<br>Created by: '.$data['createdby'].'<br>Created Date: '.$data['createddate'].'<p>Please visit <a href="http://hktpmis.pccw.com/hs/index.php/hswarranty">Home Solution</a> to review the order.<p>This is an automatically generated email.  Please do not reply.';
          return $content;
        }

 	public function email($section, $mailto, $mailsubject, $mailcontent) {
	  $data = array (
		'mail_system' => $section,
		'mail_to' => TCADMINEMAIL,
		'mail_subject' => $mailsubject,
		'mail_content' => $mailcontent,
		'mail_inserttime' => date("Y-m-d H:i:s")
	  );
	  $row = $this->maildb->insert('mailsend', $data);
	  log_message('debug', 'zzz[Warrantys_model]291/insert maildb:'.json_encode($data));
	  return $row;
  	}

}
