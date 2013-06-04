<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');

if(isset($_GET['storeId']) and isset($_GET['productId']) and isset($_GET['quantity'])) {
    $storeId = intval($_GET['storeId']);
    $productId = intval($_GET['productId']);
    $quantity = intval($_GET['quantity']);
    $cart = $_SESSION["storesLogin"][$storeId]["cart"];
     
    $delete = false;
    function different($elem){
        global $productId;
        return $elem["id"] != $productId;
    };
    
    function update($elem){
        global $productId;
        global $quantity;
        global $delete;
        if($elem["id"] == $productId)
            $elem["qt"] = $elem["qt"] + $quantity;
            
        // Check if is bellow 0
        if($elem["qt"] <= 0)
            $delete = true;
        return $elem;
    };
    
    $_SESSION["storesLogin"][$storeId]["cart"] = array_map("update", $cart);
    if($delete)
        $_SESSION["storesLogin"][$storeId]["cart"] = array_filter($cart, "different");
	
    echo json_encode(Array("result"=>"ok"));
}else{
	echo json_encode(Array("result"=>"missingParams"));
}

?>