<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Custom_security {

    public function anti_injection($data)
    {
		$filter_sql = stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES)));
		return $filter_sql;
    }
}

/* End of file Someclass.php */