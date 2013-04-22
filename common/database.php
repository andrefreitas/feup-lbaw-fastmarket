<?php
	require_once('configuration.php');
    $db = new PDO('pgsql:host='.$host.';dbname='.$db_name,$db_user,$db_password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $db->exec("SET search_path TO ".$db_schema);

?>
