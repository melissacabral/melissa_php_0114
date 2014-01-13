<?php require('db_connect.php'); ?>
<?php echo '<?xml version="1.0" encoding="utf-8" ?>'; ?>
<rss version="2.0">
	<channel>
		<title>My PHP Blog</title>
		<link>http://localhost/melissa_php_0114/blog</link>
		<description>A blog about nothing in particular</description>
		<language>en-us</language>
		<?php //query to get 10 published posts with the author
		$query = "SELECT posts.title, posts.post_id, posts.body, users.email 
				  FROM users, posts
				  WHERE posts.is_published = 1 
				  AND posts.user_id = users.user_id
				  ORDER BY posts.date DESC
				  LIMIT 10";  
		//run it
		$result = $db->query($query);
		//check to make sure a post was found
		if( $result->num_rows >= 1){ 
			while( $row = $result->fetch_assoc() ){ ?>
		<item>
			<title><?php echo htmlentities($row['title']); ?></title>
			<link>http://localhost/melissa_php_0114/blog/index.php?page=single&amp;post_id=<?php echo $row['post_id']; ?></link>
			<guid>http://localhost/melissa_php_0114/blog/index.php?page=single&amp;post_id=<?php echo $row['post_id']; ?></guid>
			<author><?php echo $row['email']; ?></author>
			<description><?php echo htmlentities($row['body']); ?></description>
		</item>
		<?php 
			} //end while
		} //end if posts found ?>
	</channel>
</rss>