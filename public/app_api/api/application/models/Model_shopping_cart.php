<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_shopping_cart extends CI_Model {

	public function __construct()
	{
		parent::__construct();
	}
	
	function getShoppingCart($uid)
	{
		$sql1	= "SELECT shopping_cart_id, product_name, product_image, product_price, qty FROM tbl_shopping_cart, tbl_product WHERE tbl_shopping_cart.product_id=tbl_product.product_id AND user_id=? ORDER BY shopping_cart_id ASC";

			$sql	= "SELECT id as shopping_cart_id, name as product_name,image as product_image, price as product_price, qty FROM tbl_shopping_cart, products WHERE tbl_shopping_cart.product_id=products.id AND user_id=? ORDER BY shopping_cart_id ASC";

		$query	= $this->db->query($sql, array($uid));
		$rs		= $query->result_array();
		
		return $rs;
	}
}