<?php
//header('Content-type: application/json');
chdir('../../common');
require_once('init.php');

if(isset($_GET['storeId']) and isset($_GET['productId'])){
    $storeId = intval($_GET['storeId']);
    $productId = intval($_GET['productId']);

    if(!isset($_SESSION["storesLogin"][$storeId]["cart"]) or count($_SESSION["storesLogin"][$storeId]["cart"]) == 0){
        $_SESSION["storesLogin"][$storeId]["cart"] = array();
    }
    array_push($_SESSION["storesLogin"][$storeId]["cart"], array("id" => $productId, "qt" => 1));
	
    echo json_encode(Array("result"=>"ok"));
}else{
	echo json_encode(Array("result"=>"missingParams"));
}

?>