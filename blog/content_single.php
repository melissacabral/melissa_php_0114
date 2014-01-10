<?php //which post are we displaying?
$post_id = $_GET['post_id']; 

//attach the comment parser file
include('parse_comment.php');

//make sure the post_id is a number
if(is_numeric($post_id)){
	//write a query to get all the info about THIS post - author, category name, etc..
	$query = "SELECT posts.*, users.username, categories.*
			FROM posts, users, categories
			WHERE posts.is_published = 1
			AND posts.user_id = users.user_id
			AND posts.category_id = categories.category_id
			AND posts.post_id = $post_id
			LIMIT 1";
	//run it
	$result = $db->query($query);
	//check to make sure one post is found
	if($result->num_rows == 1){
		//skip the loop, but extract the data from the one row
		$row = $result->fetch_assoc();
?>
<article>
	<h2><?php echo $row['title']; ?></h2>
	<p><?php echo $row['body']; ?></p>

	<div class="postmeta">Posted on <?php echo $row['date']; ?> 
		in the category <?php echo $row['name']; ?> 
		by <?php echo $row['username']; ?></div>
</article>

		<?php //get all the comments written about this post
		$query_comments = "SELECT *
							FROM comments
							WHERE post_id = $post_id
							ORDER BY date ASC";
		//run it
		$result_comments = $db->query($query_comments);
		$comments_number = $result_comments->num_rows;
		//hide the section if there are NO comments
		if($comments_number > 0){
		 ?>
		<section class="comments">
			<h2><?php echo $comments_number ?> Comments on this post</h2>
			<ol>
			<?php while( $row_comments = $result_comments->fetch_assoc() ){ ?>
				<li class="one-comment">
					<h3><?php echo $row_comments['name']; ?> wrote:</h3>
					<p><?php echo $row_comments['body']; ?></p>
					<time><?php echo convert_date($row_comments['date']); ?></time>
				</li>
			<?php }//end comment loop ?>
			</ol>
		</section>

		<?php
		}else{ //no comments
			echo 'No comments yet on this post.';
		}
		?>
		<?php include('comment_form.php'); ?>
<?php
	}else{
		echo 'Sorry, No post found.';
	} 
}else{ //post_id is NOT a number
	echo 'invalid post_id';
} ?>