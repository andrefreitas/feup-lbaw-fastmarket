<?php
header('Content-type: application/json');

chdir('../../common');
require_once('init.php');
chdir('../database');
require_once('plataform.php');
chdir('../ajax/plataform');

if (isset($_GET["search"])){
    $term = $_GET["search"];
    $stores = searchStores($term);
    echo json_encode($stores);
}

else{
    $stores = getStores();
    echo json_encode($stores);
}


?>