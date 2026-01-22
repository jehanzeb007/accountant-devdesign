<?php defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('getToEntryNumber')) {
    function getToEntryNumber($number, $entrytype_id) {
    	// Get a reference to the controller object
	    $CI = get_instance();
		
		return $CI->functionscore->toEntryNumber($number, $entrytype_id);
    }
}

if(!function_exists('getDateFromSql')) {
    function getDateFromSql($date) {
    	// Get a reference to the controller object
	    $CI = get_instance();
		
		return $CI->functionscore->dateFromSql($date);
    }
}

if(!function_exists('getOSArch')) {
    function getOSArch() {
    	$out = array();
		$out = php_uname("m");
		$arr = explode("_", $out);
		return $arr[1];
    }
}




if(!function_exists('getShowTag')) {
    function getShowTag($tag_id) {
    	// Get a reference to the controller object
	    $CI = get_instance();
		
		return $CI->functionscore->showTag($tag_id);
    }
}

if(!function_exists('getEntryLedgers')) {
    function getEntryLedgers($id) {
    	// Get a reference to the controller object
	    $CI = get_instance();

	    return $CI->functionscore->entryLedgers($id);
    }
}

if(!function_exists('getToCurrency')) {
    function getToCurrency($dc, $amount) {
    	// Get a reference to the controller object
	    $CI = get_instance();

	    return $CI->functionscore->toCurrency($dc, $amount).'__'.$dc;
    }
}

if(!function_exists('getToCurrencyForEntries')) {
    function getToCurrencyForEntries($dc, $amount) {
    	// Get a reference to the controller object
	    $CI = get_instance();

	    return $CI->functionscore->toCurrency($dc, $amount);
    }
}



?>