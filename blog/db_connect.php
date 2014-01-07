<?php //connect to database
//db host, username, password, db name
$db = new mysqli( 'localhost', 'melissa_0114', 'qCVay3f8mjWzQV7a', 'blog_mmc_0114' );

//if there is an error connecting to the DB, stop the page from loading and show a message
if( $db->connect_errno > 0 ){
	die('Unable to connect to the Database.');
}

//do not close PHP