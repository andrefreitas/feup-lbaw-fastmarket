<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');
chdir("../database");
require_once("storeFrontend.php");
chdir('../ajax/store');

if(isset($_GET["text"]) and isset($_GET["productId"]) and isset($_GET['storeId'])){

	$userId = $_SESSION['storesLogin'][$_GET['storeId']]['userId'];
	if(isset($userId))
	{
		insertComment($_GET["productId"], $userId, $_GET["text"]);
		echo json_encode(array("result" => "ok"));
	}else{
		echo json_encode(array("result" => "not logged in"));
	}
}else{
    echo json_encode(array("result" => "missingParams"));
}
?>