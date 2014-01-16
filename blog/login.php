<?php
//establish or resume the current session
session_start();
require('db_connect.php');
include_once('functions.php');

//parse the form if the user submitted data
if( $_POST['did_login'] == true ){
	//extract the values typed into the form
	$username = clean_input($_POST['username']);
	$password = clean_input($_POST['password']);
	//get the hashed version of the password so we can compare it to the DB
	$sha_password = sha1($password);

	//validate - username and password must be longer than 4 chars
	if( strlen($username) >= 4 AND strlen($password) >= 4 ){
		//check to see if a user with this hashed password exists in the DB
		$query_login = "SELECT user_id
						FROM users
						WHERE username = '$username'
						AND password = '$sha_password'
						LIMIT 1";
		//run it
		$result_login = $db->query($query_login);
		//if ONE result is found, we have a match! log them in!
		if( $result_login->num_rows == 1 ){
			setcookie( 'logged_in', true, time() + 60 * 60 * 24 * 14 );
			$_SESSION['logged_in'] = true;
			
			//keep track of WHO is logged in
			$row = $result_login->fetch_assoc();
			setcookie('user_id', $row['user_id'], time() + 60 * 60 * 24 * 14 );
			$_SESSION['user_id'] = $row['user_id'];

			//redirect to the admin panel
			header('Location:admin.php');

		}//end if one user found
		else{
			$status = 'error';
			$message = 'Incorrect username/password combo. Try again.';
		}

	}//end of validation
	else{
		$status = 'error';
		$message = 'Too short! Incorrect username/password combo. Try again.';
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
	//remember WHO is logged in
	$_SESSION['user_id'] = $_COOKIE['user_id'];
	//send them to the admin panel
	header('Location:admin.php');
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