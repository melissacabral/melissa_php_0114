<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Example of navigation using GET data</title>
</head>

<body>
	<header>
		<h1>Simple Navigation Site!</h1>
		<nav>
			<ul>
				<li><a href="index.php?content=home">Home</a></li>
				<li><a href="index.php?content=about">About</a></li>
				<li><a href="index.php?content=contact">Contact</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<?php
		//logic to get the right chunk of content depending on the link clicked
		switch($_GET['content']){
			case 'about':
				include('content_about.php');
			break;
			case 'contact':
				include('content_contact.php');
			break;
			default:
				include('content_home.php');
		}
		 ?>
	</main>
	<footer>
		footer stuff
	</footer>
</body>
</html>