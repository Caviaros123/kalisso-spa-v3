<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends MY_Controller {
	
	public function __construct()
	{
		// Global
		parent::__construct();
	}
	
	public function index()
	{
		echo 'api';
	}
}