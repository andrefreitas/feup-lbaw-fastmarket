<?php
header('Content-type: application/json');
chdir('../../common');
require_once('init.php');

if(isset($_GET['storeId'])) {
    $storeId = intval($_GET['storeId']);
    $_SESSION["storesLogin"][$storeId]["cart"] = array();
    echo json_encode(Array("result"=>"ok"));
}else{
	echo json_encode(Array("result"=>"missingParams"));
}

?>