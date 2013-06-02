
<?php
chdir("../../database");
require_once("store_backoffice.php");
if(isset($_GET["id"]) and strlen($_GET["id"])>0){


	forceRemoveProduct($_GET["id"]);
	echo json_encode(array("result" => "ok"));
	
}else{
    echo json_encode(array("result" => "missingParams"));
}

?>
