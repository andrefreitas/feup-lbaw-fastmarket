
<?php
chdir("../../database");
require_once("store_backoffice.php");
if(isset($_GET["storeId"]) and isset($_GET["name"]) and strlen($_GET["name"])>0 and
	isset($_GET["description"]) and strlen($_GET["description"])>0 and 
	isset($_GET["base_cost"]) and strlen($_GET["base_cost"])>0 and
	isset($_GET["stock"]) and strlen($_GET["stock"])>0){

	$categoryId = checkCategory("no category",$_GET["storeId"]);
	$categoryId = $categoryId[0]["id"];
	if(isset($_GET["category"]) and strlen($_GET["category"])>0)
	{
		$checkExists = checkCategory($_GET["category"],$_GET["storeId"]);
		if(isset($checkExists[0]["id"]))
		{
			$categoryId=$checkExists[0]["id"];
		}
		
	}
	
	$imageId = getFileByName("no image");
	$imageId = $imageId[0]["id"];
	
	addProduct($_GET["name"],$_GET["description"],$_GET["base_cost"],$_GET["stock"],$categoryId,$imageId);
	echo json_encode(array("result" => "ok"));
	
}else{
    echo json_encode(array("result" => "missingParams"));
}

?>
