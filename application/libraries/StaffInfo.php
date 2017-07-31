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
	  $sql = "SELECT id,name,staffid,ccc,location,teamcode,channel FROM staff where staffid=?";
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
          $this->CI->session->set_userdata($data);
        }
}
