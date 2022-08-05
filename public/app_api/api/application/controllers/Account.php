<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {
	
	public function __construct()
	{
		// Global
		parent::__construct();

		$this->load->model('model_user');
		$this->load->model('model_account');
		$this->load->helper('funcglobal');
		usleep(1500000);
	}
	
	function getAddress(){
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		// $userId 	= $this->model_user->decodeSession($sessionId);
		$userId 	= $this->custom_security->anti_injection($this->input->post('uid'));
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_account->getAddress($userId);
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['id'];
					$rsData[$k]['title'] = $v['title'];
					$rsData[$k]['recipientName'] = $v['recipient_name'];
					$rsData[$k]['phoneNumber'] = $v['phone_number'];
					$rsData[$k]['addressLine1'] = $v['address_line1'];
					$rsData[$k]['addressLine2'] = $v['address_line2'];
					$rsData[$k]['country'] = $v['country'];
					$rsData[$k]['state'] = $v['state'];
					$rsData[$k]['postalCode'] = $v['postal_code'];
					$rsData[$k]['defaultAddress'] = (bool) $v['default_address'];
				}
			}
			$json['status'] = STATUS_OK;
			$json['msg'] = 'Success';
			$json['data'] = $rsData;
		}
		header("Content-Type: application/json");
		echo json_encode($json);
	}

	function getLastSeen(){
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
		$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));

		$userId = $this->custom_security->anti_injection($this->input->post('uid'));
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_account->getLastSeen($userId, $skip, $limit);
			//echo '<pre>';print_r($rs);echo '</pre>';die;
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['last_seen_id'];
					$rsData[$k]['name'] = $v['product_name'];
					$rsData[$k]['price'] = (double) $v['product_price'];
					$rsData[$k]['image'] = "https://kalisso.com/storage/".$v['product_image'];
					$rsData[$k]['rating'] = (int) $v['product_rating'];
					$rsData[$k]['review'] = (int) $v['product_review'];
					$rsData[$k]['sale'] = (int) $v['product_sale'];
					$rsData[$k]['location'] = $v['product_location'];
				}
			}
			$json['status'] = STATUS_OK;
			$json['msg'] = 'Success';
			$json['data'] = $rsData;
		}
		header("Content-Type: application/json");
		echo json_encode($json);
	}

	function getOrderList(){
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$status		= $this->custom_security->anti_injection($this->input->post('status'));
		$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
		$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));

		$userId = $this->custom_security->anti_injection($this->input->post('uid'));
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_account->getOrderList($userId, $status, $skip, $limit);
			//echo '<pre>';print_r($rs);echo '</pre>';die;
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['order_id'];
					$rsData[$k]['invoice'] = $v['invoice_number'];
					$rsData[$k]['date'] = date('j F Y', strtotime($v['order_date']));
					$rsData[$k]['status'] = $v['order_status'];
					$rsData[$k]['name'] = $v['product_name'];
					$rsData[$k]['image'] = $v['product_image'];
					$rsData[$k]['payment'] = (double) $v['total_price'];
				}
			}
			$json['status'] = STATUS_OK;
			$json['msg'] = 'Success';
			$json['data'] = $rsData;
		}
		header("Content-Type: application/json");
		echo json_encode($json);
	}
}