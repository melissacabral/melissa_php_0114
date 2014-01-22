<?php //parse the form!
if( $_POST['did_post'] ){
	//extract and sanitize
	$title = clean_input($_POST['title']);
	$body = clean_input($_POST['body']);
	$category = clean_input($_POST['category']);
	$is_published = clean_input($_POST['is_published']);
	$allow_comments = clean_input($_POST['allow_comments']);

	//validate it!
	$valid = true;

	//check for empty title or body
	if( strlen($title) == 0 OR strlen($body) == 0 ){
		$valid = false;
		$message = 'Please fill in all fields.';
	}

	//convert unchecked checkboxes to 0 instead of null
	if($is_published == ''){
		$is_published = 0;
	}
	if($allow_comments == ''){
		$allow_comments = 0;
	}
	//if everything is valid, GO! add the post to the DB
	if( $valid ){
		//WHO is logged in?
		$user_id = $_SESSION['user_id'];

		$query_insert = "INSERT INTO posts
				(title, body, date, user_id, category_id, is_published, allow_comments)
						VALUES
		('$title', '$body', now(), $user_id, $category, $is_published, $allow_comments )";

		//run it
		$result_insert = $db->query($query_insert);
		//check to see if one row was added
		if( $db->affected_rows == 1 ){
			$message = 'Post successfully saved.';
		}else{
			$message = 'Something went wrong. Your post was not saved.';
		}
	}//end if valid
}  //end of parser?>

<h2>Write Post</h2>

<?php if( isset($message) ){
	echo $message;
} ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] ?>">

	<label for="title">Title:</label>
	<input type="text" name="title" id="title">

	<br>

	<label for="body">Body:</label>
	<textarea name="body" id="body"></textarea>
	<br>

	<label for="category">Category:</label>
	<select name="category">
		<?php //get all the categories in alpha order by name
		$query_cats = "SELECT * FROM categories
						ORDER BY name ASC"; 

		$result_cats = $db->query($query_cats);
		if($result_cats->num_rows >= 1){
			while( $row_cats = $result_cats->fetch_assoc() ){
		?>
		
		<option value="<?php echo $row_cats['category_id'] ?>">
			<?php echo $row_cats['name']; ?>
		</option>
		
		<?php 
			} //end while
		} 	//end if
		?>
	</select>
	<br>

	<label>
		<input type="checkbox" name="is_published" id="is_published" value="1">
		Make this post public
	</label>
	<br>

	<label>
		<input type="checkbox" name="allow_comments" id="allow_comments" value="1">
		Allow people to comment on this post
	</label>
	<br>

	<input type="submit" value="Save Post">
	<input type="hidden" name="did_post" value="1">

</form>