<?php 
//load the functions file so all functions are available on this page
include('functions.php');
//parse the form when it is submitted
if( $_POST['did_submit'] == 1 ){
	//extract the data from the inputs and clean it up (sanitize)
	$name = filter_var( $_POST['name'], FILTER_SANITIZE_STRING );
	$email = filter_var( $_POST['email'], FILTER_SANITIZE_EMAIL );
	$phone = filter_var( $_POST['phone'], FILTER_SANITIZE_NUMBER_INT );
	$reason = filter_var( $_POST['reason'], FILTER_SANITIZE_STRING );
	$message = filter_var( $_POST['message'], FILTER_SANITIZE_STRING );

	//Validate!
	$valid = true;

	//check to see if the name field is blank
	if( strlen($name) == 0 ){
		$valid = false;
		$errors['name'] = 'Please fill out your name.';
	}

	//check to see if the email address is invalid
	// ! means "NOT"
	if( !filter_var( $email, FILTER_VALIDATE_EMAIL ) ){
		$valid = false;
		$errors['email'] = 'Please provide a valid email address like bob@mail.com';
	}

	//make a list of the valid reasons
	$allowed_reasons = array( 'Customer Service', 'Hi', 'Website Problem' );
	//if the user's reason is not in the list...
	if( !in_array( $reason, $allowed_reasons ) ){
		$valid = false;
		$errors['reason'] = 'Please choose from the available options';
	}

	//check to see if the message is blank
	if( strlen($message) == 0 ){
		$valid = false;
		$errors['message'] = 'Please fill in the message.';
	}

	//if at the end of all the validation, the $valid var is still true, SEND THE MAIL!
	if( $valid ){

		//prepare to send the mail. set up all 4 parameters of mail()
		$to = 'melissacabral@gmail.com, mcabral@platt.edu';
		$subject = 'Contact form submission from PHP class demo';

		$body = "Sent by: $name \n";
		$body .= "Email: $email \n";
		$body .= "Phone Number: $phone \n";
		$body .= "Reason for contact: $reason \n";
		$body .= "Message: $message";

		$header = "Reply-to: $email \r\n";
		$header .= "Cc: codefest@melissacabral.com";

		//send the mail!
		$mail_sent = mail($to, $subject, $body, $header);

		//handle error/success message
		if( $mail_sent == 1 ){
			$feedback = 'Thank you for contacting me. I\'ll get back to you soon.';
			$css_class = 'success';
		}else{
			$feedback = 'There was a problem sending the message. Try again.';
			$css_class = 'error';
		}
	} //end if still valid
} //end of parser
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Contact Me!</title>
<style type="text/css">
	label,
	input[type=submit]{
		display: block;
		margin: .5em 0 .25em;
	}
	.success{
		background-color: #BAF8AB;
		padding:.5em;
	}
	.error{
		background-color: #F7C1C2;
		padding:.5em;
	}
</style>
</head>

<body>
	<h1>Contact Me</h1>
	<p>Please take a moment to fill out this form to get in touch. I will contact you shortly!</p>

	<?php //if the user sent the form, display some feedback
	if( $_POST['did_submit'] == 1 ){
	?>
	<div class="<?php echo $css_class; ?>">
		<?php echo $feedback; ?>
	</div>
	<?php } ?>

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate>
		<label for="name">Your Name</label>
		<input type="text" name="name" id="name" value="<?php echo $name; ?>" required >
		<?php show_error( $errors, 'name' ); ?>

		<label for="email">Email Address</label>
		<input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
		<?php show_error( $errors, 'email' ); ?>

		<label for="phone">Phone Number (optional)</label>
		<input type="tel" name="phone" id="phone" value="<?php echo $phone; ?>">

		<label for="reason">How can I help you?</label>
		<select name="reason" id="reason">
			<option>CHOOSE AN OPTION</option>
			<option value="Customer Service" <?php 
				if( $reason == 'Customer Service' ){ echo 'selected'; } ?> >I need customer service</option>
			<option value="Hi" <?php 
				if( $reason == 'Hi' ){ echo 'selected'; } ?>>I just want to say Hi</option>
			<option value="Website Problem" <?php 
				if( $reason == 'Website Problem' ){ echo 'selected'; } ?>>I found a problem on your website</option>
		</select>
		<?php show_error( $errors, 'reason' ); ?>

		<label for="message">Message</label>
		<textarea name="message" id="message" required><?php echo $message; ?></textarea>
		<?php show_error( $errors, 'message' ); ?>

		<input type="submit" value="Send Message">
		<input type="hidden" name="did_submit" value="1">

	</form>
</body>
</html>