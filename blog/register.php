<?php 
session_start();
require('db_connect.php');
include_once('functions.php'); 

//begin registration parser
if( $_POST['did_register'] ){
	//clean all the input data
	$username = clean_input($_POST['username']);
	$email = clean_input($_POST['email']);
	$password = clean_input($_POST['password']);
	$repassword = clean_input($_POST['repassword']);
	$policy = clean_input($_POST['policy']);

	//hashed version of the password for storage
	$sha_password = sha1($password);

	//validate!
	$valid = true;

	//check for username too short or blank
	if( strlen($username) < 4 ){
		$valid = false;
		$message = 'Username is too short. Choose one that is at least 4 characters long. <br />';
	}//end if username too short
	else{
		//username is long enough, so make sure it's not already taken in the DB
		$query_username = "SELECT username
							FROM users
							WHERE username = '$username'
							LIMIT 1";
		$result_username = $db->query($query_username);
		//if one row is found, this username is already taken
		if( $result_username->num_rows == 1 ){
			$valid = false;
			$message .= 'That username is already taken. Try another. <br />';
		}
	}//end username check

	//check for invalid email
	if( ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		$valid = false;
		$message .= 'Please provide a valid email address. <br />';
	}else{
		//email is the right 'pattern', so make sure it's not already taken in the DB
		$query_email = "SELECT email 
						FROM users
						WHERE email = '$email'
						LIMIT 1";
		$result_email = $db->query($query_email);
		//if one row is found, that email is already taken
		if( $result_email->num_rows == 1 ){
			$valid = false;
			$message .= 'That email is already taken. Do you want to log in? <br />';
		}
	}//end email check

	//check for password too short
	if( strlen($password) < 4 ){
		$valid = false;
		$message .= 'Your password is too short. Choose one that is at least 4 characters. <br />';
	}elseif( $password != $repassword ){ //repeat passwords don't match
		$valid = false;
		$message .= 'The passwords provided do not match. <br />';
	} //end password check

	//check for unchecked privacy policy box
	if( $policy != 1 ){
		$valid = false;
		$message .= 'You must agree to the terms of service to proceed. <br />';
	} //end policy check

	//if the form is valid, Add a user to the DB!
	if( $valid ){
		$query_insert = "INSERT INTO users
						( username, password, email, join_date, is_admin )
						VALUES
						( '$username', '$sha_password', '$email', now(), 1 )";
		$result_insert = $db->query($query_insert);
		//check to make sure one row was added
		if( $db->affected_rows == 1 ){
			//it worked, log them in!
			$_SESSION['logged_in'] = true;
			setcookie( 'logged_in', true, time() + 60 * 60 * 24 * 14 );

			//grab their new user_id
			$user_id = $db->insert_id;

			$_SESSION['user_id'] = $user_id;
			setcookie('user_id', $user_id, time() + 60 * 60 * 24 * 14 );

			//redirect to admin panel
			header('Location:admin.php');

		}else{
			$message .= 'Something went wrong during account creation. Try again.';
		}

	}//end add new user

} //end registration parser
?>
<!doctype html>
<html>
<head>
	<title>Register</title>
	<style type="text/css">
	label{
		display:block;
	}
	</style>

</head>
<body>
	<h1>Sign up as a New User</h1>

	<?php 
	if(isset($message)){
		echo $message;
	} ?>

	<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
		<label for="username">Create Username:</label>
		<input type="text" name="username" id="username">
		<span class="hint">Choose a unique username that is more than 4 characters long.</span>

		<label for="email">Email Address:</label>
		<input type="email" name="email" id="email">

		<label for="password">Create a Password:</label>
		<input type="password" name="password" id="password">
		<span class="hint">Password must be at least 4 characters long.</span>

		<label for="repassword">Repeat Password</label>
		<input type="password" name="repassword" id="repassword">
		
		<label for="policy">
		<input type="checkbox" name="policy" id="policy" value="1">
		 I agree to the terms of service and privacy policy</label>

		<input type="submit" value="Register">
		<input type="hidden" name="did_register" value="1">

	</form>
</body>
</html>