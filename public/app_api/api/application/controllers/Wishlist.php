<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Wishlist extends MY_Controller {
	
	public function __construct()
	{
		// Global
		parent::__construct();

		$this->load->model('model_user');
		$this->load->model('model_wishlist');
		usleep(1500000);
	}
	
	function getWishlist(){
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$userId 	= $this->custom_security->anti_injection($this->input->post('uid'));
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_wishlist->getWishlist($userId);
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['wishlist_id'];
					$rsData[$k]['name'] = $v['product_name'];
					$rsData[$k]['price'] = (double) $v['product_price'];
					$rsData[$k]['image'] = "https://kalisso.com/storage/".$v['product_image'];
					$rsData[$k]['rating'] = (int) $v['product_rating'];
					$rsData[$k]['review'] = (int) $v['product_review'];
					$rsData[$k]['sale'] = (int) $v['product_sale'];
					$rsData[$k]['stock'] = (int) $v['product_stock'];
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
}