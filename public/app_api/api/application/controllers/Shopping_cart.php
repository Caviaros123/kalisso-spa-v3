<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shopping_cart extends MY_Controller {
	
	public function __construct()
	{
		// Global
		parent::__construct();

		$this->load->model('model_user');
		$this->load->model('model_shopping_cart');
		usleep(1000000);
	}
	
	function getShoppingCart(){
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$userId 	= $this->custom_security->anti_injection($this->input->post('uid'));
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_shopping_cart->getShoppingCart($userId);
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['shopping_cart_id'];
					$rsData[$k]['name'] = $v['product_name'];
					$rsData[$k]['image'] = "https://kalisso.com/storage/".$v['product_image'];
					$rsData[$k]['price'] = (double) $v['product_price'];
					$rsData[$k]['qty'] = (int) $v['qty'];
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