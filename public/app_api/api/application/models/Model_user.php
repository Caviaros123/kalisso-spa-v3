<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_user extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	function decodeSession($sessionId){
		$sql	= "SELECT user_id FROM tbl_session WHERE session_id=?";	
		$query	= $this->db->query($sql, array($sessionId));
		$rs		= $query->result_array(); 
		
		$uid=0;
		if($rs){
			$uid = $rs[0]['user_id'];
		}
		
		return $uid;
	}
}