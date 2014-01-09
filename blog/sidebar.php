<aside id="sidebar">
	<?php //query to get up to 15 published blog post titles, newest first
	$query_latest = "SELECT title, post_id 
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
				<li>
					<a href="index.php?page=single&amp;post_id=
						<?php echo $row_latest['post_id']; ?>">
					
					<?php echo $row_latest['title']; ?>
					</a>
				</li>
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
			while( $row_cats = $result_cats->fetch_assoc() ){ 
				//Count the number of posts in THIS category
				$this_category = $row_cats['category_id'];
				//query!
				$query_count = "SELECT COUNT(*) AS total
								FROM posts
								WHERE category_id = $this_category";
				//run it
				$result_count = $db->query($query_count);
				//count only returns ONE row, so we can skip the loop and just grab the count
				$row_count = $result_count->fetch_assoc();
				//only show the category if there are posts in it
				if( $row_count['total'] > 0){
				?>
				<li><?php echo $row_cats['name']; ?> 
					(<?php echo $row_count['total']; ?>)</li>
			<?php 
				}//end if the category has posts
			} //end while 
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