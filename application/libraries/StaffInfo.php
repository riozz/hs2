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

class StaffInfo {
        var $CI;

  	public function __construct($params = array()) {
	  $this->CI =& get_instance();
	  $this->CI->load->helper('url');
	  $this->CI->config->item('base_url');
	  $this->hktp_db=$this->CI->load->database('HKTP', TRUE);
	  $this->CI->load->library('session');
  	}

        public function getStaffInfo($staffid, $orderid) {
	  //$systemid = 1; //Home solution
	  $systemid = SYSID;
	  //$sql = "SELECT id,name,staffid,ccc,location,teamcode,channel FROM staff where staffid=?";
	  //$sql="SELECT s.id,s.name,s.staffid,s.ccc,s.location,s.teamcode,s.channel, sr.right_id FROM staff s left join system_right sr on s.id=sr.staff_sysid where s.staffid=? and sr.system_id=$systemid";
	  $sql="SELECT s.id,s.name,s.staffid,s.ccc,s.location,s.teamcode,s.channel FROM staff s where s.staffid=?";
	  $results = $this->hktp_db->query($sql, array($staffid));
          $staffMetadata = $results -> row();
 	  $data['s_id'] = $staffMetadata->id;
 	  $data['s_name'] = $staffMetadata->name;
 	  $data['s_ccc'] = $staffMetadata->ccc;
 	  $data['s_location'] = $staffMetadata->location;
 	  $data['s_staffid'] = $staffMetadata->staffid;
 	  $data['s_teamcode'] = $staffMetadata->teamcode;
 	  $data['s_channel'] = $staffMetadata->channel;
 	  $data['s_orderid'] = $orderid;
	  //$data['s_rightid'] = $staffMetadata->right_id;
	  $sql ="select sr.right_id from staff s join system_right sr on s.id=sr.staff_sysid where s.staffid=? and sr.system_id=$systemid";
	  $result = $this->hktp_db->query($sql, $staffid);
	  $data['s_rightid'] = $result->result_array();
          $this->CI->session->set_userdata($data);
        }

        public function _getStaffInfo($staffid, $orderid) {
	  //$systemid = 1; //Home solution
	  $systemid = SYSID;
	  //$sql = "SELECT id,name,staffid,ccc,location,teamcode,channel FROM staff where staffid=?";
	  $sql="SELECT s.id,s.name,s.staffid,s.ccc,s.location,s.teamcode,s.channel, sr.right_id FROM staff s left join system_right sr on s.id=sr.staff_sysid where s.staffid=? and sr.system_id=$systemid";
	  $results = $this->hktp_db->query($sql, array($staffid));
	  foreach ($results->result_array() as $row)
	  {
 	    $data['s_id'] = $row['id'];
 	    $data['s_name'] = $row['name'];
 	    $data['s_ccc'] = $row['ccc'];
 	    $data['s_location'] = $row['location'];
 	    $data['s_staffid'] = $row['staffid'];
 	    $data['s_teamcode'] = $row['teamcode'];
 	    $data['s_channel'] = $row['channel'];
 	    $data['s_orderid'] = $orderid;
	    $data['s_rightid'] = $row['right_id'];
 	  } 
          $this->CI->session->set_userdata($data);
        }
}
