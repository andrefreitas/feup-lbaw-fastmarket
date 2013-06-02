<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');

if(isset($_GET['storeId']) and isset($_GET['productId']) and isset($_GET['quantity'])) {
    $storeId = intval($_GET['storeId']);
    $productId = intval($_GET['productId']);
    $quantity = intval($_GET['quantity']);
    $cart = $_SESSION["storesLogin"][$storeId]["cart"];
     
    function update($elem){
        global $productId;
        global $quantity;
        if($elem["id"] == $productId)
            $elem["qt"] = $quantity;
        return $elem;
    };
    
    $_SESSION["storesLogin"][$storeId]["cart"] = array_map("update", $cart);
	
    echo json_encode(Array("result"=>"ok"));
}else{
	echo json_encode(Array("result"=>"missingParams"));
}

?>