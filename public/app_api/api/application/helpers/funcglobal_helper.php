<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( ! function_exists('validateSkip')){
	function validateSkip($x) {
		$i = (int) $x;
		if($i>0){
			return $i;
		} else {
			return 0;
		}
	}
}

if( ! function_exists('validateLimit')){
	function validateLimit($x) {
		$i = (int) $x;
		if($i>0){
			return $i;
		} else {
			return 8;
		}
	}
}
?>
