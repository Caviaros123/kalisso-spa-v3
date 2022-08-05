<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {
	
	public function __construct()
	{
		// Global
		parent::__construct();

		$this->load->model('model_user');
		$this->load->model('model_home');
		$this->load->helper('funcglobal');
	}

	function category($condition){
		if($condition == 'getCategory'){
			usleep(1000000);
			$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
			$userId 	= $this->model_user->decodeSession($sessionId);
			
			if($userId==0) {
				$json['status'] = STATUS_BAD_REQUEST;
				$json['msg'] = 'Session Expired';
			} else {
				$rsData = array();
				$rs = $this->model_home->getCategory();
				if($rs){
					foreach($rs as $k => $v){
						$rsData[$k]['id'] = (int) $v['category_id'];
						$rsData[$k]['name'] = $v['category_name'];
						$rsData[$k]['image'] = "https://kalisso.com/storage/".$v['category_image'];
					}
				}
				$json['status'] = STATUS_OK;
				$json['msg'] = 'Success';
				$json['data'] = $rsData;
			}
		} else if($condition == 'getCategoryAllProduct'){
			usleep(1500000);
			$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
			$userId 	= $this->model_user->decodeSession($sessionId);
			$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
			$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));
			$categoryId		= $this->custom_security->anti_injection($this->input->post('category_id'));

			//$categoryId = 1; // for now category id is always 1
			
			if($userId==0) {
				$json['status'] = STATUS_BAD_REQUEST;
				$json['msg'] = 'Session Expired';
			} else {
				$rsData = array();
				$rs = $this->model_home->getCategoryAllProduct($categoryId, $skip, $limit);
				if($rs){
					foreach($rs as $k => $v){
						$rsData[$k]['id'] = (int) $v['product_id'];
						$rsData[$k]['name'] = $v['product_name'];
						$rsData[$k]['price'] = (double) $v['product_price'];
						$rsData[$k]['image'] = "https://kalisso.com/storage/".$v['product_image'];
						$rsData[$k]['rating'] = (double) $v['product_rating'];
						$rsData[$k]['review'] = (int) $v['product_review'];
						$rsData[$k]['sale'] = (int) $v['product_sale'];
						$rsData[$k]['location'] = $v['product_location'];
					}
				}
				$json['status'] = STATUS_OK;
				$json['msg'] = 'Success';
				$json['data'] = $rsData;
			}
		} else if($condition == 'getCategoryBanner'){
			usleep(1500000);
			$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
			$userId 	= $this->model_user->decodeSession($sessionId);
			$categoryId	= $this->custom_security->anti_injection($this->input->post('category_id'));

			$categoryId = 1; // for now category id is always 1
			
			if($userId==0) {
				$json['status'] = STATUS_BAD_REQUEST;
				$json['msg'] = 'Session Expired';
			} else {
				$rsData = array();
				$rs = $this->model_home->getCategoryBanner($categoryId);
				if($rs){
					foreach($rs as $k => $v){
						$rsData[$k]['id'] = (int) $v['category_banner_id'];
						$rsData[$k]['image'] = $v['category_banner_image'];
					}
				}
				$json['status'] = STATUS_OK;
				$json['msg'] = 'Success';
				$json['data'] = $rsData;
			}
		} else if($condition == 'getCategoryForYou'){
			usleep(1500000);
			$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
			$userId 	= $this->model_user->decodeSession($sessionId);
			
			if($userId==0) {
				$json['status'] = STATUS_BAD_REQUEST;
				$json['msg'] = 'Session Expired';
			} else {
				$rsData = array();
				$rs = $this->model_home->getCategoryForYou();
				if($rs){
					foreach($rs as $k => $v){
						$rsData[$k]['id'] = (int) $v['category_id'];
						$rsData[$k]['image'] = $v['category_for_you_image'];
					}
				}
				$json['status'] = STATUS_OK;
				$json['msg'] = 'Success';
				$json['data'] = $rsData;
			}
		} else if($condition == 'getCategoryNewProduct'){
			usleep(1500000);
			$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
			$userId 	= $this->model_user->decodeSession($sessionId);
			$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
			$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));
			$categoryId		= $this->custom_security->anti_injection($this->input->post('category_id'));

			//$categoryId = 1; // for now category id is always 1
			
			if($userId==0) {
				$json['status'] = STATUS_BAD_REQUEST;
				$json['msg'] = 'Session Expired';
			} else {
				$rsData = array();
				$rs = $this->model_home->getCategoryNewProduct($categoryId, $skip, $limit);
				if($rs){
					foreach($rs as $k => $v){
						$rsData[$k]['id'] = (int) $v['product_id'];
						$rsData[$k]['name'] = $v['product_name'];
						$rsData[$k]['price'] = (double) $v['product_price'];
						$rsData[$k]['image'] = "https://kalisso.com/storage/".$v['product_image'];
						$rsData[$k]['rating'] = (int) $v['product_rating'];
						$rsData[$k]['review'] = (int) $v['product_review'];
					}
				}
				$json['status'] = STATUS_OK;
				$json['msg'] = 'Success';
				$json['data'] = $rsData;
			}
		} else if($condition == 'getCategoryTrendingProduct'){
			usleep(1500000);
			$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
			$userId 	= $this->model_user->decodeSession($sessionId);
			$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
			$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));
			$categoryId		= $this->custom_security->anti_injection($this->input->post('category_id'));

			//$categoryId = 1; // for now category id is always 1
			
			if($userId==0) {
				$json['status'] = STATUS_BAD_REQUEST;
				$json['msg'] = 'Session Expired';
			} else {
				$rsData = array();
				$rs = $this->model_home->getCategoryTrendingProduct($categoryId, $skip, $limit);
				if($rs){
					foreach($rs as $k => $v){
						$rsData[$k]['id'] = (int) $v['product_id'];
						$rsData[$k]['name'] = $v['product_name'];
						$rsData[$k]['price'] = (double) $v['product_price'];
						$rsData[$k]['image'] = "https://kalisso.com/storage/".$v['product_image'];
						$rsData[$k]['rating'] = (int) $v['product_rating'];
						$rsData[$k]['review'] = (int) $v['product_review'];
					}
				}
				$json['status'] = STATUS_OK;
				$json['msg'] = 'Success';
				$json['data'] = $rsData;
			}
		} else {
			show_404();
		}
		header("Content-Type: application/json");
		echo json_encode($json);
	}

	function search($condition){
		usleep(1500000);
		if($condition == 'getSearch'){
			$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
			$userId 	=  $this->custom_security->anti_injection($this->input->post('uid'));
			
			if($userId==0) {
				$json['status'] = STATUS_BAD_REQUEST;
				$json['msg'] = 'Session Expired';
			} else {
				$rsData = array();
				$rs = $this->model_home->getSearch($userId);
				if($rs){
					foreach($rs as $k => $v){
						$rsData[$k]['id'] = (int) $v['search_id'];
						$rsData[$k]['words'] = $v['search_word'];
					}
				}
				$json['status'] = STATUS_OK;
				$json['msg'] = 'Success';
				$json['data'] = $rsData;
			}
		} else if($condition == 'getSearchProduct'){
			$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
			$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
			$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));
			$search		= $this->custom_security->anti_injection($this->input->post('search'));

			$userId =  $this->model_user->decodeSession($sessionId);
			
			if($userId==0) {
				$json['status'] = STATUS_BAD_REQUEST;
				$json['msg'] = 'Session Expired';
			} else {
				$rsData = array();
				$rs = $this->model_home->getSearchProduct($search, $skip, $limit);
				//echo '<pre>';print_r($rs);echo '</pre>';die;
				if($rs){
					foreach($rs as $k => $v){
						$rsData[$k]['id'] = (int) $v['product_id'];
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
		} else {
			show_404();
		}
		header("Content-Type: application/json");
		echo json_encode($json);
	}
	
	function getCoupon(){
		usleep(1500000);
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$userId 	= $this->model_user->decodeSession($sessionId);
		$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
		$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_home->getCoupon($skip, $limit);
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['coupon_id'];
					$rsData[$k]['name'] = $v['coupon_name'];
					$rsData[$k]['day'] = $v['day'];
					$rsData[$k]['term'] = $v['term'];
				}
			}
			$json['status'] = STATUS_OK;
			$json['msg'] = 'Success';
			$json['data'] = $rsData;
		}
		header("Content-Type: application/json");
		echo json_encode($json);
	}

	function getCouponDetail(){
		usleep(1500000);
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$userId 	= $this->model_user->decodeSession($sessionId);
		$couponId	= $this->custom_security->anti_injection($this->input->post('id'));
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_home->getCouponDetail($couponId);
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['coupon_id'];
					$rsData[$k]['name'] = $v['coupon_name'];
					$rsData[$k]['day'] = $v['day'];
					$rsData[$k]['term'] = $v['term'];
				}
			}
			$json['status'] = STATUS_OK;
			$json['msg'] = 'Success';
			$json['data'] = $rsData[0];
		}
		header("Content-Type: application/json");
		echo json_encode($json);
	}

	function getFlashsale(){
		usleep(1500000);
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
		$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));

		$userId = $this->model_user->decodeSession($sessionId);
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_home->getFlashsale($skip, $limit);
			//echo '<pre>';print_r($rs);echo '</pre>';die;
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['flashsale_id'];
					$rsData[$k]['name'] = $v['product_name'];
					$rsData[$k]['price'] = (double) $v['product_price'];
					$rsData[$k]['image'] = "https://kalisso.com/storage/".$v['product_image'];
					$rsData[$k]['discount'] = (int) $v['discount'];
					$rsData[$k]['countItem'] = (int) $v['count_item'];
					$rsData[$k]['sale'] = (int) $v['sale'];
				}
			}
			$json['status'] = STATUS_OK;
			$json['msg'] = 'Success';
			$json['data'] = $rsData;
		}
		header("Content-Type: application/json");
		echo json_encode($json);
	}

	function getHomeBanner(){
		usleep(1000000);
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$userId 	= $this->model_user->decodeSession($sessionId);
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_home->getHomeBanner();
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['home_banner_id'];
					$rsData[$k]['image'] = $v['home_banner_image'];
				}
			}
			$json['status'] = STATUS_OK;
			$json['msg'] = 'Success';
			$json['data'] = $rsData;
		}
		header("Content-Type: application/json");
		echo json_encode($json);
	}

	function getHomeTrending(){
		usleep(1500000);
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
		$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));

		$userId = $this->model_user->decodeSession($sessionId);
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_home->getHomeTrending($skip, $limit);
			//echo '<pre>';print_r($rs);echo '</pre>';die;
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['home_trending_id'];
					$rsData[$k]['name'] = $v['home_trending_name'];
					$rsData[$k]['image'] = $v['home_trending_image'];
					$rsData[$k]['sale'] = $v['home_trending_sale'];
				}
			}
			$json['status'] = STATUS_OK;
			$json['msg'] = 'Success';
			$json['data'] = $rsData;
		}
		header("Content-Type: application/json");
		echo json_encode($json);
	}

	function getLastSearch(){
		usleep(1500000);
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
		$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));

		$userId =  $this->custom_security->anti_injection($this->input->post('uid'));
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_home->getLastSearch($skip, $limit);
			//echo '<pre>';print_r($rs);echo '</pre>';die;
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['last_search_id'];
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


	function getLastSearchInfinite(){
		usleep(1500000);
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
		$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));

		$userId = $this->custom_security->anti_injection($this->input->post('uid'));
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_home->getLastSearchInfinite($skip, $limit);
			//echo '<pre>';print_r($rs);echo '</pre>';die;
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['last_search_id'];
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

	function getRecomendedProduct(){
		usleep(1500000);
		$sessionId	= $this->custom_security->anti_injection($this->input->post('session_id'));
		$skip		= validateSkip($this->custom_security->anti_injection($this->input->post('skip')));
		$limit		= validateLimit($this->custom_security->anti_injection($this->input->post('limit')));

		$userId = $this->model_user->decodeSession($sessionId);
		//$userId = $this->custom_security->anti_injection($this->input->post('uid'));
		
		if($userId==0) {
			$json['status'] = STATUS_BAD_REQUEST;
			$json['msg'] = 'Session Expired';
		} else {
			$rsData = array();
			$rs = $this->model_home->getRecomendedProduct($skip, $limit);
			//echo '<pre>';print_r($rs);echo '</pre>';die;
			if($rs){
				foreach($rs as $k => $v){
					$rsData[$k]['id'] = (int) $v['product_id'];
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
}