<?php
header('Content-type: application/json');

chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

if (isset($_GET["search"])){
    $term = $_GET["search"];
    if(isset($_GET["merchantId"])){
        $merchantId = intval($_GET["merchantId"]);
        $stores = searchStores($term, $merchantId);
    } else{
        $stores = searchStores($term);
    }
     
    echo json_encode($stores);
}

else{
    $stores = getStores();
    echo json_encode($stores);
}


?>