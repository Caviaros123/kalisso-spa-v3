<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_home extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}

	function getCategory()
	{
		$sql	= "SELECT id as category_id, name as category_name, cat_img as category_image FROM category WHERE 1 ORDER BY RAND() ASC LIMIT 0, 8";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getCategoryAllProduct( $categoryId,  $skip, $limit)
	{
		$sql	= "SELECT id as product_id, name as product_name, price as product_price, image as product_image, rating as product_rating, review as product_review, product_sale, location as product_location FROM products WHERE category LIKE '%\"$categoryId\"%' ORDER BY RAND() LIMIT $skip,$limit";
		$query	= $this->db->query($sql, array($categoryId, $skip, $limit));
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getCategoryNewProduct($categoryId, $skip, $limit)
	{
		$sql	= "SELECT id as product_id, name as product_name, price as product_price, image as product_image, rating as product_rating, review as product_review FROM products WHERE category LIKE '%\"$categoryId\"%' ORDER BY  created_at DESC LIMIT $skip,$limit";

		$query	= $this->db->query($sql, array($categoryId, $skip, $limit));
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getCategoryTrendingProduct($categoryId, $skip, $limit)
	{
		

		$sql = "SELECT id as product_id, name as product_name, price as product_price, image as product_image, rating as product_rating, review as product_review FROM products WHERE category LIKE '%\"$categoryId\"%' ORDER BY product_sale DESC LIMIT $skip,$limit";

		$query	= $this->db->query($sql, array($categoryId, $skip, $limit));
		$rs		= $query->result_array();

		return $rs;
	}

	function getCategoryBanner($categoryId)
	{
		$sql	= "SELECT category_banner_id, category_banner_image FROM tbl_category_banner WHERE category_id=? ORDER BY category_banner_id ASC";
		$query	= $this->db->query($sql, array($categoryId));
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getCategoryForYou()
	{
		$sql	= "SELECT category_id, category_for_you_image FROM tbl_category_for_you ORDER BY category_for_you_id ASC";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getSearchProduct($search, $skip, $limit)
	{
		$sql1	= "SELECT product_id, product_name, product_price, product_image, product_rating, product_review, product_sale, product_location FROM tbl_product WHERE product_name LIKE '%$search%' ORDER BY product_id ASC LIMIT ?, ?";



		$sql	= "SELECT id as product_id, name as product_name, price as product_price, image as product_image, rating as product_rating, review as product_review, product_sale, location as product_location FROM products WHERE name LIKE '%$search%' ORDER BY product_id ASC LIMIT ?, ?";

		$query	= $this->db->query($sql, array($skip, $limit));
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getSearch($uid)
	{
		$sql	= "SELECT search_id, search_word FROM tbl_search WHERE user_id = ? ORDER BY search_id DESC";
		$query	= $this->db->query($sql, array($uid));
		$rs		= $query->result_array();
		
		return $rs;
	}
	
	function getCoupon($skip, $limit)
	{
		$sql	= "SELECT coupon_id, coupon_name, day, term FROM tbl_coupon WHERE 1 ORDER BY coupon_id ASC LIMIT ?, ?";
		$query	= $this->db->query($sql, array($skip, $limit));
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getCouponDetail($couponId)
	{
		$sql	= "SELECT coupon_id, coupon_name, day, term FROM tbl_coupon WHERE coupon_id = ? ORDER BY coupon_id ASC";
		$query	= $this->db->query($sql, array($couponId));
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getFlashsale($skip, $limit)
	{
		$sql1	= "SELECT flashsale_id, product_name, product_price, product_image, discount, count_item, sale FROM tbl_product, tbl_flashsale WHERE tbl_product.product_id=tbl_flashsale.product_id ORDER BY flashsale_id ASC LIMIT ?, ?";

		$sql	= "SELECT id as flashsale_id, name as product_name, price as product_price, image as product_image, discount, stock as count_item, product_sale as sale FROM products, tbl_flashsale WHERE products.id=tbl_flashsale.product_id ORDER BY flashsale_id ASC LIMIT ?, ?";

		$query	= $this->db->query($sql, array($skip, $limit));
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getOrderList($uid, $status, $skip, $limit)
	{
		$where = '';
		if(isset($status) && !empty($status)){
			$where = "AND order_status = '$status'";
		}

		$sql1	= "SELECT tbl_order.order_id, invoice_number, order_status, total_price, order_date, product_name, product_image FROM tbl_product, tbl_order, tbl_order_detail WHERE tbl_order.order_id=tbl_order_detail.order_id AND tbl_product.product_id=tbl_order_detail.product_id AND user_id=? $where GROUP BY order_id ORDER BY order_id ASC LIMIT ?, ?";
		
		//`orders`(`id`, `user_id`, `billing_email`, `billing_name`, `billing_adress`, `billing_city`, `billing_postalcode`, `billing_phone`, `billing_name_on_card`, `billing_discount`, `billing_discount_code`, `billing_subtotal`, `billing_tax`, `billing_total`, `transaction_id`, `pin_code`, `payment_gateway`, `shipped`, `paymentStatus`, `error`,

		$sql	= "SELECT orders.id, transction_id as invoice_number, paymentStatus as order_status, total_price, created_at as order_date, name as product_name, image as  product_image FROM products, orders, order_product WHERE orders.id=order_product.id AND products.id=order_product.id AND user_id=? $where GROUP BY id ORDER BY id ASC LIMIT ?, ?";

		$query	= $this->db->query($sql, array($uid, $skip, $limit));
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getHomeBanner()
	{
		$sql	= "SELECT home_banner_id, home_banner_image FROM tbl_home_banner WHERE home_banner_active_status = 1 ORDER BY home_banner_id ASC";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getHomeTrending($skip, $limit)
	{
		$sql	= "SELECT home_trending_id, home_trending_name, home_trending_image, home_trending_sale FROM tbl_home_trending WHERE 1 ORDER BY home_trending_id ASC LIMIT ?, ?";
		$query	= $this->db->query($sql, array($skip, $limit));
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getLastSearch($skip, $limit)
	{
		$sql1	= "SELECT last_search_id, product_name, product_price, product_image, product_rating, product_review, product_sale, product_location FROM tbl_product, tbl_last_search WHERE tbl_product.product_id=tbl_last_search.product_id ORDER BY last_search_id DESC LIMIT ?, ?";

		$sql	= "SELECT id as last_search_id, name as product_name, price as product_price, image as product_image,rating as product_rating,review as product_review,  product_sale, location as  product_location FROM products, tbl_last_search WHERE products.id=tbl_last_search.product_id ORDER BY last_search_id DESC LIMIT ?, ?";

		$query	= $this->db->query($sql, array($skip, $limit));
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getLastSearchInfinite($skip, $limit)
	{
		$value = $skip / $limit;
		if($value%2==0){
			$skip = 0;
		} else {
			$skip = 10;
		}

		$sql1	= "SELECT last_search_id, product_name, product_price, product_image, product_rating, product_review, product_sale, product_location FROM tbl_product, tbl_last_search WHERE tbl_product.product_id=tbl_last_search.product_id ORDER BY last_search_id DESC LIMIT ?, ?";

		$sql	= "SELECT id as last_search_id, name as product_name, price as product_price,image as product_image, rating as product_rating, review as product_review, product_sale, location as product_location FROM products, tbl_last_search WHERE products.id=tbl_last_search.product_id ORDER BY last_search_id DESC LIMIT ?, ?";


		$query	= $this->db->query($sql, array($skip, $limit));
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getRecomendedProduct($skip, $limit)
	{
		$sql1	= "SELECT product_id, product_name, product_price, product_image, product_rating, product_review, product_sale, product_location FROM tbl_product WHERE 1 ORDER BY product_id DESC LIMIT ?, ?";

		$sql	= "SELECT id as product_id, name as product_name, price as product_price, image as product_image, rating as product_rating, review as product_review, product_sale, location as product_location FROM products WHERE 1 ORDER BY  product_id DESC LIMIT ?, ?";

		$query	= $this->db->query($sql, array($skip, $limit));
		$rs		= $query->result_array();
		
		return $rs;
	}
}