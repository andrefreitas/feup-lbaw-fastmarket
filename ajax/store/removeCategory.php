<?php
chdir("../../database");
require_once("store_backoffice.php");
if(isset($_GET["storeId"]) and isset($_GET["category"]) and strlen($_GET["category"])>0){

	$checkExists = checkCategory($_GET["category"],$_GET["storeId"]);
	if(!isset($checkExists[0]["id"]))
	{
		
		echo json_encode(array("result" => "category dont exists"));
	}else
	{
		removeCategory($checkExists[0]["id"]);
		echo json_encode(array("result" => "ok"));
	}
	
}else{
    echo json_encode(array("result" => "missingParams"));
}
?>