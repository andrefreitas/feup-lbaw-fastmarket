<?php
chdir("../../database");
require_once("storeFrontend.php");
if(isset($_GET["productId"]) and isset($_GET["userId"]) ){

	$productId = intval($_GET["productId"]);
	$userId = intval($_GET["userId"]);
	if(!subscriptionExists($userId, $productId))
	    setSubscription($userId, $productId);
    echo json_encode(array("result" => "ok"));
	
}else{
    echo json_encode(array("result" => "missingParams"));
}
?>