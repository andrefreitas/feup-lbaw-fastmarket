<?php
	$dbName = 'lbaw12503';
	$dbUser = 'lbaw12503';
	$dbPassword = 'nB50vy';
	$dbSchema = 'public';
	$host = 'vdbm.fe.up.pt';
	
	/* Compute Base Path */
	$BASE_PATH = explode("common", dirname(__FILE__) );
	$BASE_PATH = $BASE_PATH[0];
	
    /* Compute root folder */
	$ROOT_FOLDER = str_replace("\\", "/", $BASE_PATH);
    $ROOT_FOLDER = rtrim($ROOT_FOLDER, "/");
    $ROOT_FOLDER = explode("/", $ROOT_FOLDER);
	$ROOT_FOLDER = end($ROOT_FOLDER);

	/* Compute Cookie Path */
    $COOKIE_PATH = explode($ROOT_FOLDER, $_SERVER['REQUEST_URI']);
	$COOKIE_PATH = $COOKIE_PATH[0] . $ROOT_FOLDER . "/";	
	
?>