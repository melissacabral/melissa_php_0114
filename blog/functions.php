<?php
/**
 * Convert DATETIME dates into Month Day, Year format for readability!
 * @param $dateR DATETIME data
 * @return string - human-readable date
 */
function convert_date($dateR){
	$engMon=array('January','February','March','April','May','June','July','August','September','October','November','December',' ');
	$l_months='January:February:March:April:May:June:July:August:September:October:November:December';
	$dateFormat='F j, Y';
	$months=explode (':', $l_months);
	$months[]='&nbsp;';
	$dfval=strtotime($dateR);
	$dateR=date($dateFormat,$dfval);
	$dateR=str_replace($engMon,$months,$dateR);
	return $dateR;
}


/**
 * Clean data before submitting to DB
 */
function clean_input( $data ){
	global $db;
	return mysqli_real_escape_string( $db, strip_tags(trim( $data )));
}

//no close php