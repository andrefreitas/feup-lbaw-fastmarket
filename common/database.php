<?php
	require_once(dirname(__FILE__) . '/configuration.php');
	
    $db = new PDO('pgsql:host=' . $host . ';dbname=' . $dbName, $dbUser, $dbPassword);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->exec("SET search_path TO " . $dbSchema);
    
    /*
     * Does a generic query
     */
    function query($sql, $vars=array()){
    	global $db;
    	$result = $db->prepare($sql);
    	$result->execute($vars);
    	return $result->fetchAll();
    }

?>