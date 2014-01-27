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
	<link rel="stylesheet" type="text/css" href="admin_style.css">
</head>
<body>
	<header>
		<h1>Blog Admin Panel</h1>
		<nav>
			<ul>
				<li><a href="admin.php">Dashboard</a></li>
				<li><a href="admin.php?page=write">Write Post</a></li>
				<li><a href="admin.php?page=manage">Manage Posts</a></li>
				<li><a href="admin.php?page=comments">Manage Comments</a></li>
				<li><a href="admin.php?page=editprofile">Edit Profile</a></li>
			</ul>
		</nav>
		<ul class="utilities">
			<li><a href="login.php?action=logout" class="warn">Log Out!</a></li>
		</ul>
	</header>

	<main>
		<?php //switch out the content of the page based on $_GET['page']
		switch( $_GET['page'] ){
			case 'write':
				include('admin_write.php');
			break;
			case 'manage':
				include('admin_manage.php');
			break;
			case 'edit':
				include('admin_edit.php');
			break;
			case 'comments':
				include('admin_comments.php');
			break;
			case 'editprofile':
				include('admin_editprofile.php');
			break;
			default:
				include('admin_dashboard.php');
		} ?>
	</main>

	<footer>
		&copy; 2014 Melissa Cabral
	</footer>

</body>
</html>