<?php
	$database='yogi';
	$username='yogi';
	$password='yogi';
	$server='localhost';
	$connect = mysql_connect( $server, $username, $password )
			or die("Could Not Connect DB".mysql_error());
	mysql_select_db( $database )
			or die("Could Not Select DB".mysql_error());
	ini_set( 'log_errors', true );
	ini_set( 'error_log', '/var/www/hack/phperror.log') ;
?>
