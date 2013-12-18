<?php 
//set up some variables for later
$status = 'success';
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>My First PHP file</title>

<style type="text/css">
<?php
if( $status == 'success' ){
	echo 'body{ background-color:green; }';
} else {
	echo 'body{ background-color:red; }';
}
?>
</style>
</head>

<body>
	<h1>Quick Example!</h1>
	<?php 
	//this is a comment!
	echo $status; 
	?>
</body>
</html>