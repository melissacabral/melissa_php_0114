<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>POST method example</title>
</head>

<body>
	<h1>Example of the POST Method</h1>
	<form action="post.php" method="post">
		<label for="name">Your Name:</label>
		<input type="text" name="name" id="name" required>

		<label for="breakfast">What did you eat for breakfast?</label>
		<input type="text" name="breakfast" id="breakfast" required>

		<input type="submit" value="Send!">
	</form>

<?php 
//only show the message IF the user submitted the form
	if( isset($_POST['name']) ){ ?>
	<p>Good Morning, <?php echo $_POST['name']; ?>. 
		<?php echo $_POST['breakfast']; ?> sounds delicious.</p>
<?php } ?>
</body>
</html>