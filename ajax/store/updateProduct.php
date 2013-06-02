
<?php
chdir("../../database");
require_once("store_backoffice.php");
if(isset($_GET["storeId"]) and isset($_GET["name"]) and strlen($_GET["name"])>0 and
	isset($_GET["productId"]) and strlen($_GET["productId"])>0 and 
	isset($_GET["description"]) and strlen($_GET["description"])>0 and 
	isset($_GET["cost"]) and strlen($_GET["cost"])>0 and
	isset($_GET["category"]) and strlen($_GET["category"])>0 and 
	isset($_GET["stock"]) and strlen($_GET["stock"])>0){

	$categoryId = checkCategory($_GET["category"],$_GET["storeId"]);
	$categoryId = $categoryId[0]["id"];
	if(isset($categoryId) )
	{
		
		function updateProduct($_GET["productId"], $_GET["name"], $_GET["description"], 
								$_GET["cost"], $_GET["stock"], $categoryId);
		
		echo json_encode(array("result" => "ok"));	
	}else{
		echo json_encode(array("result" => "category doest exists"));
	}
	
	
	
}else{
    echo json_encode(array("result" => "missingParams"));
}

?>
