<?php 
session_start();
require('db_connect.php');
include_once('functions.php');

//security! make sure the person viewing this admin panel is logged in
if( $_SESSION['logged_in'] != true ){
	//redirect to login
	header('Location:login.php');
	//stop loading this page, show an error message instead
	die('You do not have sufficient privileges to access this page.');
}
 ?>
<!doctype html>
<html>
<head>
	<title>Admin Panel</title>
</head>
<body>
	<a href="login.php?action=logout">Log Out!</a>
	<h1>This is the admin panel - only logged in users can see this!</h1>
</body>
</html>