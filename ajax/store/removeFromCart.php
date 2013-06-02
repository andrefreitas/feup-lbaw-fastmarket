<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');

if(isset($_GET['storeId']) and isset($_GET['productId'])){
    $storeId = intval($_GET['storeId']);
    $productId = intval($_GET['productId']);
    $cart = $_SESSION["storesLogin"][$storeId]["cart"];
     
    function different($elem){
        global $productId;
        return $elem["id"] != $productId;
    };
    
    $_SESSION["storesLogin"][$storeId]["cart"] = array_filter($cart, "different");
	
    echo json_encode(Array("result"=>"ok"));
}else{
	echo json_encode(Array("result"=>"missingParams"));
}

?>