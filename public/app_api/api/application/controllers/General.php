<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General extends MY_Controller {
	
	public function __construct()
	{
		// Global
		parent::__construct();

		$this->load->model('model_user');
		$this->load->model('model_general');
		$this->load->helper('funcglobal');
		usleep(1500000);
	}
	
	function getRelatedProduct(){
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$userId 	= $this->model_user->decodeSession($sessionId);
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_general->getRelatedProduct();
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['product_id'];
					$rsData[$k]['name'] = $v['product_name'];
					$rsData[$k]['price'] = (double) $v['product_price'];
					$rsData[$k]['image'] = "https://kalisso.com/storage/".$v['product_image'];
					$rsData[$k]['product_sale'] = 	(int) $v['product_sale'];
					$rsData[$k]['rating'] = (double) $v['product_rating'];
					$rsData[$k]['review'] = (int) $v['product_review'];
				}
			}
			$json['status'] = STATUS_OK;
			$json['msg'] = 'Success';
			$json['data'] = $rsData;
		}
		header("Content-Type: application/json");
		echo json_encode($json);
	}

	function getReview(){
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
		$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));

		$userId = $this->model_user->decodeSession($sessionId);
		$productId = $this->custom_security->anti_injection($this->input->post('product_id'));
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_general->getReview($productId, $skip, $limit);
			//echo '<pre>';print_r($rs);echo '</pre>';die;
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['review_id'];
					$rsData[$k]['name'] = $v['review_name'];
					$rsData[$k]['date'] = date('j F Y', strtotime($v['created_at']));
					$rsData[$k]['rating'] = (double) $v['review_rating'];
					$rsData[$k]['review'] = $v['review'];
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