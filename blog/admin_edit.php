<?php 
//WHICH post are we editing???
$post_id = $_GET['post_id'];

$user_id = $_SESSION['user_id'];




//parse the form!
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

		$query_update = "UPDATE posts
						SET 
						title = '$title',
						body = '$body',
						category_id = $category,
						is_published = $is_published,
						allow_comments = $allow_comments
						WHERE post_id = $post_id";

		//run it
		$result_update = $db->query($query_update);
		//check to see if one row was added
		if( $db->affected_rows == 1 ){
			$message = 'Post successfully saved.';
		}else{
			$message = 'No changes were made to your post.';
		}
	}//end if valid
}  //end of parser


//pre-fill the form with the existing data from the post, AND make sure that the logged in user is the author
$query = "SELECT * FROM posts
		WHERE post_id = $post_id
		AND user_id = $user_id
		LIMIT 1";
$result = $db->query($query);
if($result->num_rows == 1){
	$row = $result->fetch_assoc();
?>


<h2>Write Post</h2>

<?php if( isset($message) ){
	echo $message;
} ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'] ?>">

	<label for="title">Title:</label>
	<input type="text" name="title" id="title" value="<?php echo $row['title']; ?>">

	<br>

	<label for="body">Body:</label>
	<textarea name="body" id="body"><?php echo $row['body']; ?></textarea>
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
		
		<option value="<?php echo $row_cats['category_id'] ?>"  <?php 
			if( $row['category_id'] == $row_cats['category_id'] ){
				echo 'selected';
			}
		 ?> >
			<?php echo $row_cats['name']; ?>
		</option>
		
		<?php 
			} //end while
		} 	//end if
		?>
	</select>
	<br>

	<label>
		<input type="checkbox" name="is_published" id="is_published" value="1" <?php if($row['is_published'] == 1){
				echo 'checked';
			}
		 ?>>
		Make this post public
	</label>
	<br>

	<label>
	<input type="checkbox" name="allow_comments" id="allow_comments" value="1" <?php if($row['allow_comments'] == 1){
				echo 'checked';
			}
		 ?>>
		Allow people to comment on this post
	</label>
	<br>

	<input type="submit" value="Save Post">
	<input type="hidden" name="did_post" value="1">

</form>

<?php }else{
	echo 'You do not have permission to edit this post.';
} ?>