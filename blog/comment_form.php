<section id="commentform">
	<h3>Leave a comment</h3>

	<?php //display the message created by comment_parse.php
	if(isset($message)){
		echo $message;
	} ?>

	<form method="post" action="#commentform">
		<label for="name">Your Name:</label>
		<input type="text" name="name" id="name">
		<br>
		<label for="email">Email Address:</label>
		<input type="email" name="email" id="email">
		<br>
		<label for="url">Website:</label>
		<input type="url" name="url" id="url">
		<br>
		<label for="comment">Your Comment:</label>
		<textarea name="comment" id="comment"></textarea>
		<br>
		<input type="submit" value="Post Comment">
		<input type="hidden" name="did_comment" value="1">
	</form>
</section>