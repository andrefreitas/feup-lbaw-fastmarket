<?php
chdir("../../database");
require_once("storeFrontend.php");
if(isset($_GET["productId"]) and isset($_GET["userId"]) and isset($_GET["score"]) ){

	$productId = intval($_GET["productId"]);
	$userId = intval($_GET["userId"]);
	$score = intval($_GET["score"]);
	evaluateProduct($productId, $userId, $score);
    echo json_encode(array("result" => "ok"));
	
}else{
    echo json_encode(array("result" => "missingParams"));
}
?>