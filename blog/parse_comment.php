<?php 
//if the user posted a comment
if($_POST['did_comment']){
	//extract and sanitize the data
	$name = clean_input($_POST['name']);
	$email = clean_input($_POST['email']);
	$url = clean_input($_POST['url']);
	$comment = clean_input($_POST['comment']);

	//validate!
	$valid = true;

	//check for blank name, email or comment
	if( strlen($name) == 0 OR strlen($email) == 0 OR strlen($comment) == 0 ){
		$valid = false;
		$message = 'Name, Email, and Comment are required.';
	}

	//if the form data is valid, add the row to the comments table!
	if($valid){
		//set up query
		$query_insert = "INSERT INTO comments
						(date, name, email, url, body, post_id)
						VALUES
					(now(), '$name', '$email', '$url', '$comment', $post_id)";
		//run it
		$result_insert = $db->query($query_insert);

		//check to make sure one row was added 
		if( $db->affected_rows == 1 ){
			$message = 'Thank you for posting a comment. It will appear on the site immediately.';
		}else{
			$message = 'Something went wrong. Your comment was NOT posted.';
		}
	} //end if valid
} //end parser

//no close php