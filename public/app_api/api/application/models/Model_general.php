<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_general extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	function getRelatedProduct()
	{
		 //$sql	= "SELECT product_id, product_name, product_price, product_image, product_rating, product_review FROM tbl_product ORDER BY RAND() LIMIT 8";

		$sql	= "SELECT id as product_id, name as product_name, price as product_price, image as product_image, rating as product_rating, review as product_review , product_sale FROM products ORDER BY RAND() LIMIT 8";
		$query	= $this->db->query($sql);
		$rs		= $query->result_array();
		
		return $rs;
	}

	function getReview($productId, $skip, $limit)
	{
		$sql	= "SELECT id as review_id, review_name, review_rating, review, created_at FROM tbl_review WHERE product_id=? ORDER BY review_id DESC LIMIT ?, ?";
		$query	= $this->db->query($sql, array($productId, $skip, $limit));
		$rs		= $query->result_array();
		
		return $rs;
	}
}