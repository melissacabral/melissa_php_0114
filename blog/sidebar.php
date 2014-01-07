<aside id="sidebar">
	<?php //query to get up to 15 published blog post titles, newest first
	$query_latest = "SELECT title 
					FROM posts
					WHERE is_published = 1
					ORDER BY date DESC
					LIMIT 15";
	//run it
	$result_latest = $db->query($query_latest);

	//check to see if we found some rows in the DB
	if( $result_latest->num_rows >= 1 ){
	 ?>
	<section>
		<h2>Latest Posts</h2>
		<ul>
			<?php //loop through each post in the result set
			while( $row_latest = $result_latest->fetch_assoc() ){ ?>
				<li><?php echo $row_latest['title']; ?></li>
			<?php } //end while 
			//free the result resources
			$result_latest->free();
			?>
		</ul>	
	</section>
	<?php 
	} //end if there are posts to show ?>	

	<?php //query to get up to 15 published blog post titles, newest first
	$query_cats = "SELECT * 
					FROM categories
					ORDER BY name ASC
					LIMIT 15";
	//run it
	$result_cats = $db->query($query_cats);

	//check to see if we found some rows in the DB
	if( $result_cats->num_rows >= 1 ){
	 ?>
	<section>
		<h2>Categories</h2>
		<ul>
			<?php //loop through each post in the result set
			while( $row_cats = $result_cats->fetch_assoc() ){ ?>
				<li><?php echo $row_cats['name']; ?></li>
			<?php } //end while 
			//free the result resources
			$result_cats->free();
			?>
		</ul>	
	</section>
	<?php 
	} //end if there are posts to show ?>

	<section>
		<h2>Links</h2>
		<ul>
			<li>TITLE</li>
			<li>TITLE</li>
			<li>TITLE</li>
		</ul>	
	</section>

</aside>