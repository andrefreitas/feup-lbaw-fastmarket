<?php
chdir("../../database");
require_once("store_backoffice.php");
if(isset($_GET["storeId"]) and isset($_GET["category"]) and strlen($_GET["category"])>0){

	$checkExists = checkCategory($_GET["category"],$_GET["storeId"]);
	if(!isset($checkExists[0]["id"]))
	{
		addCategory($_GET["category"],$_GET["storeId"],null)
		echo json_encode(array("result" => "ok"));
	}else
	{
		echo json_encode(array("result" => "category name in use"));
	}
	
}else{
    echo json_encode(array("result" => "missingParams"));
}
?>