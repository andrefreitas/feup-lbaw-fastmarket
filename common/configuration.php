<?php
	$dbName = 'lbaw12503';
	$dbUser = 'lbaw12503';
	$dbPassword = 'nB50vy';
	$dbSchema = 'public';
	$host = 'vdbm.fe.up.pt';
	
	/* Compute Base Path */
	$BASE_PATH = explode("common", dirname(__FILE__) );
	$BASE_PATH = $BASE_PATH[0];
	

	$ROOT_FOLDER = explode($BASE_PATH, "/");
	print_r($BASE_PATH);

	/* Compute Cookie Path */
	$COOKIE_PATH = explode("common", dirname(__FILE__) );
	$COOKIE_PATH = $COOKIE_PATH[0];
	$COOKIE_PATH = rtrim($COOKIE_PATH, "/");
	$COOKIE_PATH = explode("/", $COOKIE_PATH );
	unset($COOKIE_PATH[0]);
	$COOKIE_PATH = implode("/", $COOKIE_PATH);
	$COOKIE_PATH = '/' . $COOKIE_PATH . '/';	
	
	//echo $_SERVER['REQUEST_URI'];
	
?>