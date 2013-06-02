<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');

if(isset($_GET['storeId'])) {
    $storeId = intval($_GET['storeId']);
    $total = 0;
    if(isset($_SESSION["storesLogin"][$storeId]["cart"])){
        $total = count($_SESSION["storesLogin"][$storeId]["cart"]);
    }
    echo json_encode(Array("result"=>"ok", "total" => $total));
}else{
	echo json_encode(Array("result"=>"missingParams"));
}

?>