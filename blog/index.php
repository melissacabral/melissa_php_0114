<?php //load the database connection
require('db_connect.php'); ?>
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
		$my_query = "SELECT title, body 
					FROM posts
					WHERE is_published = 1
					ORDER BY date DESC
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