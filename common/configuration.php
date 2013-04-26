<?php
	$dbName = 'lbaw12503';
	$dbUser = 'lbaw12503';
	$dbPassword = 'nB50vy';
	$dbSchema = 'public';
	$host = 'vdbm.fe.up.pt';
	$root = 'fastmarket';
	$BASE_URL = 'http://gnomo.fe.up.pt/~lbaw12503/fastmarket/';
	$BASE_PATH = '/opt/lbaw/lbaw12503/public_html/fastmarket/';
	$COOKIE_PATH = '/~lbaw12503/fastmarket';
	if($_SERVER['HTTP_HOST'] != 'gnomo.fe.up.pt'){
	    $BASE_URL = 'http://' . $_SERVER['HTTP_HOST'] . '/' . $root;
	    $BASE_PATH = $_SERVER["DOCUMENT_ROOT"] . '/' . $root . '/';
	    $COOKIE_PATH = '/' . $root;
	}
?>