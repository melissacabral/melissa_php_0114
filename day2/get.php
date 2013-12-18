<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>GET method example</title>
</head>

<body>
	<h1>Example of the GET Method</h1>
	<form action="get.php" method="get">
		<label for="name">Your Name:</label>
		<input type="text" name="name" id="name" required>

		<label for="breakfast">What did you eat for breakfast?</label>
		<input type="text" name="breakfast" id="breakfast" required>

		<input type="submit" value="Send!">
	</form>

<?php 
//only show the message IF the user submitted the form
	if( isset($_GET['name']) ){ ?>
	<p>Good Morning, <?php echo $_GET['name']; ?>. 
		<?php echo $_GET['breakfast']; ?> sounds delicious.</p>
<?php } ?>
</body>
</html>