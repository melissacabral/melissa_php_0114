<h2>Manage Your Posts</h2>

<?php //get all the posts that were written by the logged in user, newest first 
$user_id = $_SESSION['user_id'];
$query_posts = "SELECT title, date, is_published, post_id
				FROM posts
				WHERE user_id = $user_id
				ORDER BY date DESC"; 
$result_posts = $db->query($query_posts);
if( $result_posts->num_rows >= 1 ){
?>
<ul>
	<?php while( $row_posts = $result_posts->fetch_assoc() ){ ?>
	<li><a href="admin.php?page=edit&amp;post_id=<?php echo $row_posts['post_id'] ?>">
		<?php echo $row_posts['title']; ?> - 
		<?php if($row_posts['is_published'] == 1){
			echo 'Public';
		}else{
			echo 'Private';
		}?>
	</a></li>
	<?php } //end while ?>
</ul>
<?php 
}else{
	echo 'You have not written any posts yet.';
} ?>
