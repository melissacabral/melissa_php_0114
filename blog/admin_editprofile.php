<?php 
//figure out WHO is logged in
$user_id = $_SESSION['user_id'];

//parse the form IF it was submitted
if($_POST['did_upload']){

	//file uploading stuff begins
	
	$target_path = "uploads/";
	
	//list of image sizes to generate. make sure a column name in your DB matches up with a key for each size
	$sizes = array(
		'thumb_img' => 150,
		'medium_img' => 300 
	);		

		
	// This is the temporary file created by PHP
	$uploadedfile = $_FILES['uploadedfile']['tmp_name'];
	// Capture the original size of the uploaded image
	list($width,$height) = getimagesize($uploadedfile);
	
	//make sure the width and height exist, otherwise, this is not a valid image
	if($width > 0 AND $height > 0){
	
	//what kind of image is it
	$filetype = $_FILES['uploadedfile']['type'];
	
	switch($filetype){
		case 'image/gif':
			// Create an Image from it so we can do the resize
			$src = imagecreatefromgif($uploadedfile);
		break;
		
		case 'image/pjpeg':
		case 'image/jpg':
		case 'image/jpeg': 
			// Create an Image from it so we can do the resize
			$src = imagecreatefromjpeg($uploadedfile);
		break;
	
		case 'image/png':
			// Create an Image from it so we can do the resize
			$required_memory = Round($width * $height * $size['bits']);
			$new_limit=memory_get_usage() + $required_memory;
			ini_set("memory_limit", $new_limit);
			$src = imagecreatefrompng($uploadedfile);
			ini_restore ("memory_limit");
		break;
			
	}
	//for filename
	$randomsha = sha1(microtime());
	
	//do it!  resize images
	foreach($sizes as $size_name => $size_width){
		if($width >=  $size_width){
		$newwidth = $size_width;
		$newheight=($height/$width) * $newwidth;
		}else{
			$newwidth=$width;
			$newheight=$height;
		}
		$tmp=imagecreatetruecolor($newwidth,$newheight);
		imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
		
		$filename = $target_path.$randomsha.'_'.$size_name.'.jpg';
		$didcreate = imagejpeg($tmp,$filename,70);
		imagedestroy($tmp);

		//add it to the DB if it worked
		if($didcreate){
			//DELETE OLD FILE
			//look up the old image name
			$query_oldfile = "SELECT $size_name as size FROM users where user_id = $user_id LIMIT 1";
            $result_oldfile = $db->query($query_oldfile);
            if($result_oldfile->num_rows == 1){
                $row_oldfile = $result_oldfile->fetch_assoc();
                //get filepath of old file
                $old_file = $row_oldfile['size'];
                 //Delete the file from the directory with unlink()
                @unlink($old_file);
            }
			//END DELETE OLD FILE
			//update the existing logged in user with the new image
			$query_update = "UPDATE users
							SET $size_name = '$filename'
							WHERE user_id = $user_id";
			$result_update = $db->query($query_update);			
			if( $db->affected_rows >= 1 ){
				$statusmsg .= 'Image path saved in DB.';
			}else{
				$statusmsg .= 'Image path WAS NOT saved in DB.';
			}//end check if query worked

		}//end update DB
				
	}//end foreach
	
	imagedestroy($src);
	
		
	}else{//width and height not greater than 0
		$didcreate = false;
	}
	
	
	if($didcreate) {
		$statusmsg .=  "The file ".  basename( $_FILES['uploadedfile']['name']). 
		" has been uploaded <br />";
	} else{
		$statusmsg .= "There was an error uploading the file, please try again!<br />";
	}
}//end of parser	
?>

<h2>Edit Your User Pic</h2>

<?php 
//display feedback if it exists
if( isset($statusmsg) ){
	echo $statusmsg;
} ?>
<form enctype="multipart/form-data" method="post" action="admin.php?page=editprofile">
	<label for="uploadedfile">Choose an Image</label>
	<input type="file" name="uploadedfile" id="uploadedfile">

	<input type="submit" value="Change User Pic">
	<input type="hidden" name="did_upload" value="1">
</form>


<h2>Your Current User Pic:</h2>

<?php //get the small version of the logged in user's image
$query_pic = "SELECT thumb_img, username 
			FROM users
			WHERE user_id = $user_id
			LIMIT 1";
$result_pic = $db->query($query_pic);
//check to see if a row was found
if( $result_pic->num_rows == 1 ){
	$row_pic = $result_pic->fetch_assoc();
	//check to see if the user has a user pic
	if( $row_pic['thumb_img'] == '' ){
		echo 'You don\'t have a user pic yet';
	}else{ ?>

		<img src="<?php echo $row_pic['thumb_img']; ?>" 
			alt="<?php echo $row_pic['username']; ?>'s User Pic" class="user-pic">

<?php 
	}//end if user has a user pic

}//end if row found ?>