<?php 
//load the database connection
require('db_connect.php');
//get the functions file
include_once('functions.php'); 
?>
<!doctype HTML>
<html>
<head>
	<title>My PHP Blog!</title>
</head>
<body>
	<header>
		<h1>My PHP Blog about nothing in particular</h1>
	</header>
	<main>
		<?php 
		//get up to 2 blog posts that are published, newest first
		$my_query ="SELECT posts.title, posts.body, posts.post_id, posts.date, users.username,  categories.*
					FROM posts, users, categories
					WHERE posts.is_published = 1
					AND users.user_id = posts.user_id
					AND posts.category_id = categories.category_id
					ORDER BY posts.date DESC
					LIMIT 2";
		//run it
		$result = $db->query($my_query);
		
		//check to make sure at least one post is found
		if( $result->num_rows >= 1 ){
			//loop through the results
			while( $row = $result->fetch_assoc() ){
		?>
		<article>
			<h2><?php echo $row['title']; ?></h2>
			<div class="post-meta">
				Posted in <?php echo $row['name']; ?> 
				by <?php echo $row['username']; ?> 
				on <?php echo convert_date($row['date']); ?></div>
			<p><?php echo $row['body']; ?></p>
		</article>
		
		<?php 
			} //end while there are posts to show
			//free the results so we don't hog resources
			$result->free();
		}else{
			echo 'Sorry, no posts found';
		} ?>


	</main>

	<?php include('sidebar.php'); ?>
	
	<footer>
		&copy; 2014 Melissa Cabral
	</footer>
</body>
</html>