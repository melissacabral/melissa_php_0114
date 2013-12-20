<?php 
//parse the form when it is submitted
if( $_POST['did_submit'] == 1 ){
	//extract the data from the inputs
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$reason = $_POST['reason'];
	$message = $_POST['message'];

	//TODO: Sanitize and validate!

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

}
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

	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<label for="name">Your Name</label>
		<input type="text" name="name" id="name" required>

		<label for="email">Email Address</label>
		<input type="email" name="email" id="email" required>

		<label for="phone">Phone Number (optional)</label>
		<input type="tel" name="phone" id="phone">

		<label for="reason">How can I help you?</label>
		<select name="reason" id="reason">
			<option value="Customer Service">I need customer service</option>
			<option value="Hi">I just want to say Hi</option>
			<option value="Website Problem">I found a problem on your website</option>
		</select>

		<label for="message">Message</label>
		<textarea name="message" id="message" required></textarea>

		<input type="submit" value="Send Message">
		<input type="hidden" name="did_submit" value="1">

	</form>
</body>
</html>