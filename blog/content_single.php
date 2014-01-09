<?php //which post are we displaying?
$post_id = $_GET['post_id']; 

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
<section class="comments">
	<h2>Comments on this post</h2>

	<ol>
		<li class="one-comment">
			<h3>NAME wrote:</h3>
			<p>BODY</p>
			<time>DATE</time>
		</li>
	</ol>
</section>
<?php
	}else{
		echo 'Sorry, No post found.';
	} 
}else{ //post_id is NOT a number
	echo 'invalid post_id';
} ?>