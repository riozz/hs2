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

        public function getStaffInfo($staffid) {
	  $sql = "SELECT id,name,staffid,ccc,location FROM staff where staffid=?";
	  $results = $this->hktp_db->query($sql, array($staffid));
          $staffMetadata = $results -> row();
 	  $data['id'] = $staffMetadata->id;
 	  $data['name'] = $staffMetadata->name;
 	  $data['ccc'] = $staffMetadata->ccc;
 	  $data['location'] = $staffMetadata->location;
 	  $data['staffid'] = $staffMetadata->staffid;
          $this->CI->session->set_userdata($data);
        }
}
