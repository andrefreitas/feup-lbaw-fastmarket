
<?php
chdir("../../database");
require_once("store_backoffice.php");
if(isset($_GET["storeId"]) and isset($_GET["productId"]) and strlen($_GET["productId"])>0){


	removeProduct($_GET["productId"]);
	echo json_encode(array("result" => "ok"));
	
}else{
    echo json_encode(array("result" => "missingParams"));
}

?>
