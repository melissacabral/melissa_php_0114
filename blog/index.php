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
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="alternate" type="application/rss+xml" href="rss.php">
</head>
<body>
	<header>
		<h1>My PHP Blog about nothing in particular</h1>
	</header>
	<main>
		<?php //switch out the correct chunk of content
		$page = $_GET['page'];
		switch($page){
			case 'blog':
				include('content_blog.php');
			break;
			case 'single':
				include('content_single.php');
			break;
			default:
				include('content_home.php');
		}
		 ?>
	</main>

	<?php include('sidebar.php'); ?>
	
	<footer>
		&copy; 2014 Melissa Cabral
	</footer>
</body>
</html>