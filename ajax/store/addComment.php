<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');
chdir("../database");
require_once("storeFrontend.php");
chdir('../ajax/store');

if(isset($_GET["text"]) and isset($_GET["productId"]) and isset($_GET['storeId'])){

	$userId = intval($_SESSION['storesLogin'][$_GET['storeId']]['userId']);
	$productId = intval($_GET["productId"]);
	if(isset($userId))
	{
	    $text = strip_tags($_GET["text"]);
		insertComment($productId, $userId, $text);
		echo json_encode(array("result" => "ok"));
	}else{
		echo json_encode(array("result" => "not logged in"));
	}
}else{
    echo json_encode(array("result" => "missingParams"));
}
?>