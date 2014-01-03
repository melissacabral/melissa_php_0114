<?php

//function to display an error for a form field.
function show_error( $array_name, $key_name ){
	if( isset( $array_name[$key_name] ) ){
		echo  '<span class="error">' . $array_name[$key_name] . '</span>';
	} 
} //end function show_error


//no close php