<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_script extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

	function insertAddress($id, $title, $recipientName, $phoneNumber, $addressLine1, $addressLine2, $state, $postalCode, $defaultAddress)
	{
		$sql	= "INSERT INTO tbl_address set address_id=?, user_id=1, title=?, recipient_name=?, phone_number=?, address_line1=?, address_line2=?, state=?, postal_code=?, default_address=?";
		$query  = $this->db->query($sql, array($id, $title, $recipientName, $phoneNumber, $addressLine1, $addressLine2, $state, $postalCode, $defaultAddress));
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}

	function insertCoupon($id, $name, $day, $term)
	{
		$sql	= "INSERT INTO tbl_coupon set coupon_id=?, coupon_name=?, day=?, term=?";
		$query  = $this->db->query($sql, array($id, $name, $day, $term));
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}

	function insertReview($id, $name, $date, $rating, $review)
	{
		$sql	= "INSERT INTO tbl_review set review_id=?, review_name=?, review_rating=?, review=?, review_date=?";
		$query  = $this->db->query($sql, array($id, $name, $rating, $review, $date));
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}

	function insertProduct($id, $category_id, $product_name, $product_image, $product_price, $product_rating, $product_review, $product_sale, $product_location)
	{
		$sql	= "INSERT INTO tbl_product set product_id=?, category_id=?, product_name=?, product_image=?, product_price=?, product_rating=?, product_review=?, product_sale=?, product_location=?";
		$query  = $this->db->query($sql, array($id, $category_id, $product_name, $product_image, $product_price, $product_rating, $product_review, $product_sale, $product_location));
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}

	function insertProductNoId($category_id, $product_name, $product_image, $product_price, $product_rating, $product_review, $product_sale, $product_location)
	{
		$sql	= "INSERT INTO tbl_product set category_id=?, product_name=?, product_image=?, product_price=?, product_rating=?, product_review=?, product_sale=?, product_location=?";
		$query  = $this->db->query($sql, array($category_id, $product_name, $product_image, $product_price, $product_rating, $product_review, $product_sale, $product_location));
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}

	function insertFlashsale($id, $discount, $count_item, $sale)
	{
		$sql	= "INSERT INTO tbl_flashsale set product_id=?, discount=?, count_item=?, sale=?";
		$query  = $this->db->query($sql, array($id, $discount, $count_item, $sale));
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}

	function insertLastSearch($product_id)
	{
		$sql	= "INSERT INTO tbl_last_search set user_id=1, product_id=?, last_search_create_date=now()";
		$query  = $this->db->query($sql, array($product_id));
		$last_id  = $this->db->insert_id();
		
		return $last_id;
	}
}