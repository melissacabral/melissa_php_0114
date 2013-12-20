<?php
//establish or resume the current session
session_start();

//temporary correct credentials until we learn about Databases
$correct_username = 'melissa';
$correct_password = 'phprules';

//parse the form if the user submitted data
if( $_POST['did_login'] == true ){
	//extract the values typed into the form
	$username = $_POST['username'];
	$password = $_POST['password'];

	//compare the user's credentials with the correct credentials. 
	//if they match, log them in
	if( $username === $correct_username AND $password === $correct_password ){
		//log them in for 2 weeks
		setcookie( 'logged_in', true, time() + 60 * 60 * 24 * 14 );
		$_SESSION['logged_in'] = true;

	}//end if username/password matched
	else{
		$status = error;
		$message = 'Sorry, incorrect login, try again.';
	}
} //end if did_login

//if the user pressed the logout button, get rid of the cookie and session
if( $_GET['action'] == 'logout' ){
	session_destroy();
	unset( $_SESSION['logged_in'] );
	//set all cookies to null
	setcookie( 'logged_in', '' );
}
//if the user returns and the cookie is still valid, automatically log them in
elseif($_COOKIE['logged_in'] == true){
	//re-create the session
	$_SESSION['logged_in'] = true;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Simple Login Form</title>
</head>

<body>

	<?php //if the user is not logged in, show the form
	if( $_SESSION['logged_in'] != true ){
	?>
		<h1>Log in to your account</h1>
		<?php //show the error message if necessary
		if( $status == 'error' ){
			echo $message;
		}
		?>
		<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

			<label for="username">Username</label>
			<input type="text" name="username" id="username" required>

			<label for="password">Password</label>
			<input type="password" name="password" id="password" required>

			<input type="submit" value="Log In">
			<input type="hidden" name="did_login" value="true">
		</form>

	<?php } 
	//if logged in, show the user something secret
	else{ ?>
		<a href="login.php?action=logout">Logout</a>
		<h1>Your Account</h1>
		Secret stuff! put any content here...

	<?php }	?>
</body>
</html>