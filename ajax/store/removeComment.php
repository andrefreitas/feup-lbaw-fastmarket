<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');
chdir("../database");
require_once("storeFrontend.php");
chdir('../ajax/store');

if(isset($_GET['storeId']) and isset($_GET['commentId'])){

	
	
	removeComment($_GET['commentId']);
	echo json_encode(array("result" => "ok"));
	
}else{
    echo json_encode(array("result" => "missingParams"));
}
?>